<div class="form">
  <?php $form=$this->beginWidget('CActiveForm', array(
   'id'=>'libros-form',
   'enableAjaxValidation'=>false,
   'htmlOptions' => array('enctype'=>'multipart/form-data', 'class'=>'form-inline', "onLoad"=>"document.formulario.campo.focus()"),
   )); ?>

   <p class="note">Campos con <span class="required">*</span> son obligatorios.</p>

   <?php echo $form->errorSummary($model); ?>
   <?php // echo $form->errorSummary(array_merge(array($model),$validateItems)); ?>

   <div class="form">
    <div class="row">
      <div class="form-group col-md-6">
        <?php echo $form->labelEx($model,'TITULO',array('class'=>'col-sm-2 control-label')); ?>
        <?php echo $form->textField($model,'TITULO',array('class'=>'form-control')); ?>
        <?php echo $form->error($model,'TITULO'); ?>
      </div>
      <div class="form-group col-md-6">
        <?php echo $form->labelEx($model,'NARRADOR',array('class'=>'col-sm-2 control-label')); ?>
        <?php
          // Si se quiere mas de un valor, colocar codigo similar a esto: \$(\"#s_autor\").val(s_autor.value+item[0]+';');
        $this->widget('CAutoComplete', array(
          'name' => 'NARRADOR',
          'url'=> array('libros/listarNarradores'),
          'minChars'=>2,
          'delay'=>500,
          'matchCase'=>true,
          'methodChain'=>".result(function(event,item){
            \$(\"#NARRADOR\").val(item[0]);
            \$(\"#Libros_NARRADOR\").val(item[0]);
          })",
        'htmlOptions'=>array(
          'onkeyup'=>'Asignate(this)',
          'class'=>'form-control',
          ),
        ));
        ?>
        <?php echo $form->hiddenField($model,'NARRADOR',array('class'=>'form-control')); ?>
        <?php echo $form->error($model,'NARRADOR'); ?>
      </div>
    </div>

    <div class="row">
      <div class="form-group col-md-6">
        <?php echo $form->labelEx($model,'ID_CATEGORIA',array('class'=>'col-sm-2 control-label')); ?>
        <?php echo $form->dropDownList($model,'ID_CATEGORIA', CHtml::listData(Categorias::model()->findAll(), 'ID_CATEGORIA', 'CATEGORIA'),array('class'=>'form-control')); ?>
        <?php echo $form->error($model,'ID_CATEGORIA'); ?>
      </div>

      <div class="form-group col-md-6">
        <?php echo $form->labelEx($model,'ID_IDIOMA',array('class'=>'col-sm-2 control-label')); ?>
        <?php echo $form->dropDownList($model,'ID_IDIOMA', CHtml::listData(Idiomas::model()->findAll(), 'ID_IDIOMA', 'IDIOMA'),array('class'=>'form-control')); ?>
        <?php echo $form->error($model,'ID_IDIOMA'); ?>
      </div>
    </div>

    <div class=" form-inline row">
      <div class="col-md-6">
        <?php echo $form->labelEx($model,'ANO',array('class'=>'col-sm-2 control-label')); ?>
        <?php echo $form->textField($model,'ANO',array('size'=>15,'maxlength'=>15, 'class'=>'form-control')); ?>
        <?php echo $form->error($model,'ANO'); ?>
      </div>
      <div class="col-md-6">
        <?php echo $form->labelEx($model,'EDITORIAL',array('class'=>'col-sm-2 control-label')); ?>
        <?php echo $form->textField($model,'EDITORIAL',array('size'=>15, 'class'=>'form-control')); ?>
        <?php echo $form->error($model,'EDITORIAL'); ?>
      </div>
    </div>

    <div class=" form-inline row">
      <div class="col-md-6">
        <?php echo $form->labelEx($model,'DESCRIPCION',array('class'=>'col-sm-2 control-label')); ?>
        <?php echo $form->textArea($model,'DESCRIPCION',array("class"=>"form-control", 'rows'=>1, 'cols'=>30)); ?>
        <?php echo $form->error($model,'DESCRIPCION'); ?>
      </div>
    </div>
    <!-- Checkbox para verificar si el libro tiene partes -->
    <br>
    <div class=" form-inline row">
      <div class="col-md-6">
        <?php echo $form->labelEx($model,'Partes?',array('class'=>'col-sm-2 control-label')); ?>
        <?php echo CHtml::CheckBox(
                'checkbox_1',
                false,
                array(
                  'value'=>'on',
                  'onclick'=>'alertaChecked()',
                  'data-target'=>'#partes_libros',
                )
              ); 
        ?>
        <label> Pinchar si el libro tiene 2 o más partes</label>
      </div>
    </div>
    <!-- Agregar partes de los libros -->
    <div id="partes_libros" class="collapse"></div>
    <!-- end partes libros -->

    <br>
    <div class="form-inline row" id="subir_libro">
      <div class="form-group">
        <div class="col-md-6">
          <?php echo $form->labelEx($model,'Libro',array('class'=>'col-sm-2 control-labe  l')); ?>
          <div class="form-control">
            <?php echo CHtml::activeFileField($model,'audio'); ?>
          </div>
          <?php echo $form->error($model,'audio'); ?>
        </div>
      </div>
    </div>




</div> <!-- end container-->


<br>
<div class="form-group">

  <?php 
  $dataA = CHtml::listData(Autores::model()->findAll(), 'ID_AUTOR', 'AUTOR');
  $dataE = CHtml::listData(Etiquetas::model()->findAll(), 'ID_ETIQUETA', 'ETIQUETA');
  $dataG = CHtml::listData(Genero::model()->findAll(), 'ID_GENERO', 'GENERO');

  $this->widget('ext.emultiselect.EMultiSelect',array('sortable'=>false/true, 'searchable'=>true));

  echo $form->labelEx($model,'Autores');
  echo '<br>';
  echo CHtml::link('Crear Autor', "",
    array(
     'style'=>'cursor: pointer; text-decoration: underline;',
     'onclick'=>"{addAutor(); $('#dialogAutor').dialog('open');}"
     ));
  /* Link para abrir el JuiDialog y crear un autor */
  $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
   'id'=>'dialogAutor',
   'options'=>array(
     'title'=>'Crear Autor',
     'autoOpen'=>false,
     'modal'=>true,
     ),
   ));

  echo '<div class="dialog"></div>';
  $this->endWidget();


  /** DualList de Autores **/
  echo '<div class="nueve" id="nueve">';
//      echo $this->renderPartial('test', array('model'=>$model));

  $dataA = CHtml::listData(Autores::model()->findAll(), 'ID_AUTOR', 'AUTOR');
  echo $form->dropDownList($model,'autores',$dataA,array('multiple'=>'multiple','key'=>'genero', 'class'=>'multiselect col-md-6 form-control','style'=>'width:50%; height:20%;'));

  echo '</div>';
  echo "<br>";
  echo $form->labelEx($model,'Etiquetas');
  echo "<br>";
  /* Link para abrir el JuiDialog y crear un etiquetas */
  echo CHtml::link('Crear Etiqueta', "",
   array(
     'style'=>'cursor: pointer; text-decoration: underline;',
     'onclick'=>"{addEtiqueta(); $('#dialogEtiqueta').dialog('open');}"
     ));

  $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
   'id'=>'dialogEtiqueta',
   'options'=>array(
     'title'=>'Crear Etiqueta',
     'autoOpen'=>false,
     'modal'=>true,
     ),
   ));
  echo '<div class="dialog"></div>';
  $this->endWidget();

  /** DualList de Etiquetas **/
  echo $form->dropDownList($model,'etiquetas',$dataE,array('multiple'=>'multiple','key'=>'genero', 'class'=>'multiselect  col-md-6 form-control','style'=>'width:50%; height:20%;'));
  echo "<br>";
  echo $form->labelEx($model,'Géneros');
  echo "<br>";
  /* Link para abrir el JuiDialog y crear un genero */
  echo CHtml::link('Crear Géneros', "",
   array(
     'style'=>'cursor: pointer; text-decoration: underline;',
     'onclick'=>"{addGenero(); $('#dialogGenero').dialog('open');}"
     ));

  $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
   'id'=>'dialogGenero',
   'options'=>array(
     'title'=>'Crear Género',
     'autoOpen'=>false,
     'modal'=>true,
     ),
   ));
  echo '<div class="dialog"></div>';
  $this->endWidget();
  /** DualList de Género **/
  echo $form->dropDownList($model,'genero',$dataG,array('multiple'=>'multiple','key'=>'genero', 'class'=>'multiselect col-md-6 form-control','style'=>'width:50%; height:20%;'));
  ?>

</div>

<div class="form-group">
  <div class="col-sm-8">
    <?php echo CHtml::submitButton($model->isNewRecord ? ' Crear ' : ' Guardar ',array('class'=>'btn btn-default')); ?>
  </div>
</div>
<?php $this->endWidget(); ?>

</div><!-- form -->


<script type="text/javascript">
function addAutor()
{
  <?php 
  echo CHtml::ajax(array(
    'url'=>array('autores/create'),
    'data'=> "js:$(this).serialize()",
    'type'=>'post',
    'dataType'=>'json',
    'success'=>"function(data)
    {
      if (data.status == 'failure')
      {
        $('#dialogAutor div.dialog').html(data.div);
        $('#Autores_AUTOR').focus();
        $('#dialogAutor div.dialog form').submit(addAutor);
      }
      else
      {
        $('#dialogAutor div.dialog').html(data.div);
        setTimeout(\"$('#dialogAutor').dialog('close') \",1000);
        /*$(#nueve).load('test.php+'#nueve');*/
        /*setInterval(function(){\"$(#nueve).load('test.php)\";}, 3);*/
        /*setTimeout(\"$(#nueve).load('test.php)\", 3);*/
        /*jQuery(\"$(#nueve).append()\");*/
        /*(#nueve).append(jQuery.load('".Yii::app()->createUrl("libros/updateAutores")."'));*/
        /* \"$(#nueve).append(\"$(#nueve).load('".Yii::app()->createUrl("libros/updateAutores")."')\")\";*/
        /*$('#nueve').load('test.php');*/
        
        /*CHtml::ajax(array('updateAutores',array('libros/updateAutores'),array('#nueve')))*/
        
        /*$('#nueve').html(data.div2);*/
        /*document.getElementById('nueve').refresh(true);*/
        /*update();*/
      }
    }",
    ))
?>;
  // $('#nueve').load();
  return false; 
}
function update()
{
  //new Ajax.Request('test.php',{method: "get", onSuccess: function(trans){$("nueve").innerHTML = trans.responseText;}});
  <?php 
  echo CHtml::ajax(array(
    'url'=>array('libros/updateAutores'), 
    'type'=>'post',
    'update'=>'#nueve',
    ));
  ?>
}
function addAutor2()
{
  <?php 
  /*
  echo CHtml::ajax(array(
    'url'=>array('autores/create'),
    'data'=> "js:$(this).serialize()",
    'type'=>'post',
    'dataType'=>'json',
    'success'=>"function(data)
    {
      if (data.status == 'failure')
      {
        $('#dialogAutor div.dialog').html(data.div);
        $('#dialogAutor div.dialog form').submit(addAutor);
      }
      else
      {
        $('#dialogAutor div.dialog').html(data.div);
        setTimeout(\"$('#dialogAutor').dialog('close') \",500);
      }
    }",
    ))

     echo CHtml::ajax(array(
    'url'=>array('autores/create'),
    'data'=> "js:$(this).serialize()",
    'type'=>'post',
    'dataType'=>'json',
    'success'=>"function(data)
    {
      if (data.status == 'failure')
      {
        $('#dialogAutor div.dialog').html(data.div);
        $('#dialogAutor div.dialog form').submit(addAutor);
      }
      else
      {
        $('#dialogAutor div.dialog').html(data.div);
        setTimeout(\"$('#dialogAutor').dialog('close') \",1000);
      }
    }",
    ))
  */
?>;
return false; 
}

function addEtiqueta()
{
  <?php 
  echo CHtml::ajax(array(
    'url'=>array('etiquetas/create'),
    'data'=> "js:$(this).serialize()",
    'type'=>'post',
    'dataType'=>'json',
    'success'=>"function(data)
    {
      if (data.status == 'failure')
      {
        $('#dialogEtiqueta div.dialog').html(data.div);
        $('#dialogEtiqueta div.dialog form').submit(addEtiqueta);
      }
      else
      {
        $('#dialogEtiqueta div.dialog').html(data.div);
        setTimeout(\"$('#dialogEtiqueta').dialog('close') \",1000);
        ".
        CHtml::ajax(array(
          'url'=>array('libros/updateAutores'),
          'data'=> "js:$(this).serialize()",
          'type'=>'post',
          'dataType'=>'json',
          'success'=>"function(data)
          {
            $('#nueve').html(data.div);
          }",
          ))
        ."
      }
    }",
    ))
  ?>;
  return false; 
}

function addGenero()
{
  <?php 
  echo CHtml::ajax(array(
    'url'=>array('genero/create'),
    'data'=> "js:$(this).serialize()",
    'type'=>'post',
    'dataType'=>'json',
    'success'=>"function(data)
    {
      if (data.status == 'failure')
      {
        $('#dialogGenero div.dialog').html(data.div);
        $('#dialogGenero div.dialog form').submit(addGenero);
      }
      else
      {
        $('#dialogGenero div.dialog').html(data.div);
        setTimeout(\"$('#dialogGenero').dialog('close') \",1000);
      }

    }",
    ))
  ?>;
  return false; 
}
</script>

<script type="text/javascript">
/* Asigna al narrador, esto se utiliza para cuando no hay narrador previo. */
function Asignate(target)
{
  var choose = target.value;
  document.getElementById('Libros_NARRADOR').value = choose;
}
</script>

<script type="text/javascript">
//Codigo para agregar más partes a un libro 

function alertaChecked(){ 

  //detecto si el checkbox está seleccionado.
  if(document.getElementById("checkbox_1").checked){
    document.getElementById("subir_libro").style.display="none";
  }
  else{
    document.getElementById("subir_libro").style.display="inline";
  }

} 


</script>