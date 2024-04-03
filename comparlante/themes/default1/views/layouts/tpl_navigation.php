        <nav class="navbar navbar-default">
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">menú de navegación</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">
                
                <img src="images/logo.png" width="200px"  alt="logo-comparlante" data-original="images/logo.png"</img>
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse">

            <ul class="nav navbar-nav navbar-right">
                
                <?php $this->widget('zii.widgets.CMenu',array(
                    'htmlOptions'=>array('class'=>'nav navbar-nav navbar-text'),
                    'submenuHtmlOptions'=>array('class'=>'dropdown-menu'),
                    'itemCssClass'=>'dropdown',
                    'encodeLabel'=>false,
                    'items'=>array(
                        array('label'=>'Inicio', 'url'=>array('/site/index'),'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>'Buscador de libros', 'url'=>array('/BuscadorLibros/index'),'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>'Biblioteca', 'url'=>array('/BuscadorLibros/biblioteca'),'visible'=>!Yii::app()->user->isGuest),
                        /*Acceso por menú a los Visitantes */
                        //array('label'=>'Libros', 'url'=>array('/libros/index'),'visible'=>Yii::app()->user->isGuest),
                        //Biblioteca de libros
                        array('label'=>'Libros <span class="caret"></span>', 'url'=>'#','visible'=>!Yii::app()->user->isGuest,'itemOptions'=>array('class'=>"dropdown", 'tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"), 
                            'items'=>array(
                                array('label'=>'Libros' , 'url'=>array('libros/index'),'visible'=>!Yii::app()->user->isGuest),
                                array('label'=>'Biblioteca', 'url'=>array('libros/admin')),
                                array('label'=>'Agregar', 'url'=>array('libros/create')),

                                )),
                        array('label'=>'Configuración <span class="caret"></span>', 'url'=>'#','visible'=>!Yii::app()->user->isGuest,'itemOptions'=>array('class'=>"dropdown", 'tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"), 
                            'items'=>array(
                                array('label'=>'Autores',   'url'=>array('autores/admin')),
                                array('label'=>'Categorias','url'=>array('categorias/admin')),
                                array('label'=>'Géneros',   'url'=>array('genero/admin')),
                                array('label'=>'Etiquetas', 'url'=>array('etiquetas/admin')),
                                array('label'=>'Idiomas', 'url'=>array('idiomas/admin')),
                                array('label'=>'Usuarios',  'url'=>array('usuario/admin')),
                        )),
                        //array('label'=>'Reportes' , 'url'=>array('/reportes/index'),'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>'Salir ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
                        ),
                        )); ?>
        </ul>
    </div><!-- /.navbar-collapse -->
</div><!-- /.container-fluid -->
</nav>