<?php
	echo CHtml::activeLabelEx(Libros::model(),'Autores');
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

	$this->widget('ext.emultiselect.EMultiSelect',array('sortable'=>false/true, 'searchable'=>true));
	$dataA = CHtml::listData(Autores::model()->findAll(), 'ID_AUTOR', 'AUTOR');
    echo CHtml::dropDownList('autores','',$dataA,array('multiple'=>'multiple','key'=>'genero', 'class'=>'multiselect col-md-6 form-control','style'=>'width:50%; height:20%;'));
?>

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
        
        $('#nueve').html(data.div2);
      }
    }",
    ))
  ?>;
  // $('#nueve').load();
  return false; 
}
</script>