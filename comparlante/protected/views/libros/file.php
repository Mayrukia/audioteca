<?php 
			$asd = CHtml::listData(Autores::model()->findAll(), 'ID_AUTOR', 'AUTOR');
        	$asd2 = CHtml::dropDownList('autores','',$dataA,array('multiple'=>'multiple','key'=>'genero', 'class'=>'multiselect col-md-6 form-control','style'=>'width:50%; height:20%;'));

?>