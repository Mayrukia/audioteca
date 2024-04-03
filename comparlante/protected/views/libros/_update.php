<?php
/* @var $this LibrosController */
/* @var $model Libros */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'libros-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype'=>'multipart/form-data', 'class'=>'form-inline'),
)); ?>

	<p class="note">Campos con <span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>

    <div class="form">
        <div class="row">
            <div class="form-group col-md-6">
                <?php echo $form->labelEx($model,'TITULO',array('class'=>'col-sm-2 control-label')); ?>
                <?php echo $form->textField($model,'TITULO',array('size'=>60,'class'=>'form-control')); ?>
                <?php echo $form->error($model,'TITULO'); ?>
            </div>
            <div class="form-group col-md-6">
                <?php echo $form->labelEx($model,'NARRADOR',array('class'=>'col-sm-2 control-label')); ?>
                <?php
                    $this->widget('CAutoComplete', array(
                        'name' => 'NARRADOR',
                        'value'=> $model->NARRADOR,
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
                <?php echo $form->hiddenField($model,'NARRADOR',array('class'=>'form-control','value'=> $model->NARRADOR)); ?>
                <?php echo $form->error($model,'NARRADOR'); ?>
                <?php echo $form->hiddenField($model,'URL_AUDIO',array('class'=>'form-control','value'=> $model->URL_AUDIO)); ?>
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
                <?php echo $form->labelEx($model,'DESCRIPCION',array('class'=>'col-sm-2 control-label')); ?>
                <?php echo $form->textArea($model,'DESCRIPCION',array("class"=>"form-control", 'rows'=>1, 'cols'=>50)); ?>
                <?php echo $form->error($model,'DESCRIPCION'); ?>
            </div>
        </div>

        <br>
        <div class="form-inline row">
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
    </div>

    <br>
    <div class="form-group">
    	<?php 
			$dataA = CHtml::listData(Autores::model()->findAll(), 'ID_AUTOR', 'AUTOR');
			$dataE = CHtml::listData(Etiquetas::model()->findAll(), 'ID_ETIQUETA', 'ETIQUETA');
			$dataG = CHtml::listData(Genero::model()->findAll(), 'ID_GENERO', 'GENERO');

			$this->widget('ext.emultiselect.EMultiSelect',array('sortable'=>false/true, 'searchable'=>true));
	       
            /** Autores **/
      		echo $form->labelEx($model,'Autores');
            echo '<br>';
            /* Link para abrir el JuiDialog y crear un autor */
            echo CHtml::link('Crear Autor', "",
    			array(
        			'style'=>'cursor: pointer; text-decoration: underline;',
        			'onclick'=>"{addAutor(); $('#dialogAutor').dialog('open');}"
        		));
			
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

            /** Se obtienen los valores por defecto y los coloca por default en la lista **/
            $arrayAD      = array();
            $selectedAttr = array('selected'=>'selected');
            foreach ($arrayA as $key => $value) 
                foreach ($arrayA[$key] as $key => $value) 
                    if($key == 'ID_AUTOR')
                        $arrayAD[$value] = $selectedAttr;

			/** DualList de Etiquetas **/
			echo $form->dropDownList($model,'autores',$dataA,array('multiple'=>'multiple','key'=>'genero', 'class'=>'multiselect col-md-6 form-control','style'=>'width:50%; height:20%;','options'=>$arrayAD)); // '1'=>array('selected'=>true),
            echo "<br>";
            
            /** Label de Etiquetas **/
			echo $form->labelEx($model,'Etiquetas');
            echo "<br>";
			
            /* Link para abrir el JuiDialog y crear un autor */
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

            /** Se obtienen los valores por defecto y los coloca por default en la lista **/
            $arrayED      = array();
            $selectedAttr = array('selected'=>'selected');
            foreach ($arrayE as $key => $value) 
                foreach ($arrayE[$key] as $key => $value) 
                    if($key == 'ID_ETIQUETA')
                        $arrayED[$value] = $selectedAttr;

            /** DualList de Etiquetas **/
			echo $form->dropDownList($model,'etiquetas',$dataE,array('multiple'=>'multiple','key'=>'genero', 'class'=>'multiselect col-md-6 form-control','style'=>'width:50%; height:20%;','options'=>$arrayED)); // '1'=>array('selected'=>true),
            echo "<br>";

            /** Label de Género **/
			echo $form->labelEx($model,'Géneros');
            echo "<br>";

			/* Link para abrir el JuiDialog y crear un autor */
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

            /** Se obtienen los valores por defecto y los coloca por default en la lista **/
            $arrayGD      = array();
            $selectedAttr = array('selected'=>'selected');
            foreach ($arrayG as $key => $value) 
                foreach ($arrayG[$key] as $key => $value) 
                    if($key == 'ID_GENERO')
                      $arrayGD[$value] = $selectedAttr;

			/** DualList de Género **/
			echo $form->dropDownList($model,'genero',$dataG,array('multiple'=>'multiple','key'=>'genero', 'class'=>'multiselect col-md-6 form-control','style'=>'width:50%; height:20%;','options'=>$arrayGD)); // '1'=>array('selected'=>true),
  		?>
	</div>

	<div class="form-group">
        <div class="col-sm-8">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar',array('class'=>'btn btn-default')); ?>
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
                    $('#dialogAutor div.dialog form').submit(addAutor);
                }
                else
                {
                    $('#dialogAutor div.dialog').html(data.div);
                    setTimeout(\"$('#dialogAutor').dialog('close') \",1000);
                }
            }",
        ))
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