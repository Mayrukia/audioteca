<?php
/* @var $this SiteController */

//$this->pageTitle=Yii::app()->name;
$this->pageTitle='comParlante';
$baseUrl = Yii::app()->theme->baseUrl; 
?>


<div id="homeContent" align="center">

    <table class="table table-responsive">
        <tr>
            <td>
                <div   align="center" >
                    <?php  echo CHtml::link('<img src='.'"'. Yii::app()->baseUrl.'/images/iconos/agregar.png" alt="agregar libros"  width="23%" />', array('libros/create'));   ?>
                    <div class="dashIconText "><?php echo CHtml::link('<h4>Crear Libros</h4>',array('libros/create')); ?></div>
                </div>
            </td>
            <td>
                <div   align="center" >
                    <?php  echo CHtml::link('<img src='.'"'. Yii::app()->baseUrl.'/images/iconos/biblioteca.png" alt="agregar libros"  width="23%" />', array('libros/admin'));   ?>
                    <div class="dashIconText "><?php echo CHtml::link('<h4>Biblioteca Libros</h4>',array('libros/admin')); ?></div>
                </div>
            </td>
        </tr>
    </table>
</div>
