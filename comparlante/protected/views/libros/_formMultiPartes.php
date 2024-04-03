


<!-- botón que crea más formularios -->
<div>
 <button type="button" class="btn btn-info" onclick="agregarParte()">Agregar parte</button>
</div>
 <!-- parte de creación de formularios -->
  <form id="formulario_parte" class="form-inline">
    <div class="form-group">
      <label for="exampleInputName2">Número parte</label>
      <input type="text" class="form-control" id="number" placeholder="Jane Doe">
    </div>
    <div class="form-group">
      <label>Archivo</label>
      <input type="file" id="book" name="book">
    </div>
      
    
    <button type="button" id="guardar" class="btn btn-default">Guardar</button>
    <button type="button" id="eliminar" onclick="eliminarParte(this)" class="btn btn-default">Eliminar</button>
  
<div class="messages"></div><br /><br />
<div class="showImage"></div>

  </form>
<div id="test"> </div>
  <a href=<?php echo '"'.CController::createUrl('libros/view',array('id'=>$model->ID_LIBRO)).'"' ?>>
    <div class="btn btn-lg btn-success">
      Guardar
    </div>
  </a>
 

<script type="text/javascript">
  var count=1;
  function agregarParte(){
        var clon = document.getElementById('formulario_parte').cloneNode(true);
        clon.id='formulario_parte_'+count;
        count++;
        document.getElementById('test').parentNode.insertBefore(clon,document.getElementById('test'));
    }

    function eliminarParte(boton){
        var parrafoAEliminar = document.getElementById(boton.id).parentNode;
        parrafoAEliminar.parentNode.removeChild(parrafoAEliminar);
        // document.getElementById('ej-rmCh').removeChild(parrafoAEliminar);
    }

</script>

  <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    //queremos que esta variable sea global
    var fileExtension = "";
    //función que observa los cambios del campo file y obtiene información
    $(':file').change(function()
    {
        //obtenemos un array con los datos del archivo
        var file = $("#book")[0].files[0];
        //obtenemos el nombre del archivo
        var fileName = file.name;
        //obtenemos la extensión del archivo
        fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
        //obtenemos el tamaño del archivo
        var fileSize = file.size;
        //obtenemos el tipo de archivo image/png ejemplo
        var fileType = file.type;
        //mensaje con la información del archivo
        showMessage("<span class='info'>Archivo para subir: "+fileName+", peso total: "+fileSize+" bytes.</span>");
    });
 
    //al enviar el formulario
    //$(':button').click(function(){ 
    $(':button').click(function(){ 
        //información del formulario
        var formData = new FormData($("#formulario_parte")[0]);
        var number = $("#number").val();
        //var formData = new FormData(document.getElementById(boton.id)[0]);
        var message = "";
        //hacemos la petición ajax  
        $.ajax({
          //url: 'upload.php',  
          url: <?php echo "'".CController::createUrl('libros/upload')."'";?>,
          type: 'GET',
          // Form data
          //datos del formulario
          data: {'number': number},
          // data: {'id': 'asd'},
          //necesario para subir archivos via ajax
          cache: false,
          contentType: false,
          processData: false,
          //mientras enviamos el archivo
          beforeSend: function(){
              message = $("<span class='before'>Subiendo la imagen, por favor espere...</span>");
              showMessage(message)        
          },
          //una vez finalizado correctamente
          success: function(data){
              message = $("<span class='success'>La imagen ha subido correctamente.</span>");
              showMessage(message);
              if(isImage(fileExtension))
              {
                  $(".showImage").html("<img src='files/"+data+"' />");
              }
          },
          //si ha ocurrido un error
          error: function(){
              message = $("<span class='error'>Ha ocurrido un error.</span>");
              showMessage(message);
          }
        });
    });
})
 
//como la utilizamos demasiadas veces, creamos una función para 
//evitar repetición de código
function showMessage(message){
    $(".messages").html("").show();
    $(".messages").html(message);
}
 
//comprobamos si el archivo a subir es una imagen
//para visualizarla una vez haya subido
function isImage(extension)
{
    switch(extension.toLowerCase()) 
    {
        case 'jpg': case 'gif': case 'png': case 'jpeg':
            return true;
        break;
        default:
            return false;
        break;
    }
}
</script>