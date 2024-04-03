<?php
/* @var $this LibrosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Libros',
);

$this->menu=array(
	array('label'=>'Crear Libros', 'url'=>array('create')),
	array('label'=>'Administrar Libros', 'url'=>array('admin')),
);
?>

<h1>Libros</h1>

<?php 
$this->widget('ext.EColumnListView', array(
	
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'columns'=> 3,

	'pager'=>array(
        'header'         => '',
        'firstPageLabel' => '&lt;&lt;',
        'prevPageLabel'  => '&lt;atrás',
        'nextPageLabel'  => 'adelante&gt;',
        'lastPageLabel'  => '&gt;&gt;',
    ),
));


?>

    <script type="text/javascript">

          function reproduceSonido (event,id) {
            var chCode = ('charCode' in event) ? event.charCode : event.keyCode;

            if (chCode == 13) {
                document.getElementById('audiolibro'+id).play();
            }
        }

    </script>
