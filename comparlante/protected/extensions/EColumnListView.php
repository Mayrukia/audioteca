<?php

/**
 * EColumnListView class file.
 *
 * @author Tasos Bekos <tbekos@gmail.com>
 * @copyright Copyright &copy; 2012 Tasos Bekos
 */
/**
 * EColumnListView represents a list view in multiple columns.
 *
 * @author Tasos Bekos <tbekos@gmail.com>
 */
Yii::import('zii.widgets.CListView');

class EColumnListView extends CListView {

    /**
     *
     * @var mixed integer the number of columns
     */
    public $columns = 2;

    /**
     * Renders the item view.
     * This is the main entry of the whole view rendering.
     *
     * This is override function that supports multiple columns
     */
    public function renderItems() {
        $numColumns = (int) $this->columns; // Number of columns

        if ($numColumns < 2) {
            parent::renderItems();
            return;
        }

        echo CHtml::openTag($this->itemsTagName, array('class' => $this->itemsCssClass)) . "\n";
        $data = $this->dataProvider->getData();

        if (($n = count($data)) > 0) {

            // Compute column width
            $width = 100 / $numColumns;

            // Initialize table
            echo CHtml::openTag('div',array('class'=>'row container-fluid table '));

            //echo CHtml::openTag('td', array('style' => 'width:' . $width . '%; vertical-align:top;'));

            $owner = $this->getOwner();


            $render = $owner instanceof CController ? 'renderPartial' : 'renderPartial';
            $tabindex=0;
            //$j = 0;
            foreach ($data as $i => $item) {

                $nombre = $item->ID_LIBRO;

                // Open cell
                echo CHtml::openTag('div', array('class'=>'col-md-4 team-list','style'=>'text-align: center;', 'tabindex'=> $i+5,'name'=>$nombre, 'onkeypress'=>"reproduceSonido(event,".$nombre.')'));//'name'=>'elemento'.$i+100
 
                $data = $this->viewData;
                $data['index'] = $i;
                $data['data'] = $item;
                $data['widget'] = $this;
                echo "<br>";
                $owner->$render($this->itemView, $data);

                // Close cell
                echo CHtml::closeTag('div');

                // Change row
                if (($i + 1) % $numColumns == 0) {
                    echo CHtml::closeTag('div') . CHtml::openTag('div',array('class'=>'row container-fluid table '));
                }
            }

            // Close table
            echo CHtml::closeTag('div');
        } else {
            $this->renderEmptyText();
        }
        echo CHtml::closeTag($this->itemsTagName);
    }

}

?>