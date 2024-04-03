<?php
echo $_SESSION["num"];
  @session_start();
  if(isset($_SESSION["num"]) && $_SESSION["num"] == 1)
  {
    ?>

<style>
/* Multiselect
----------------------------------*/

.ui-multiselect { border: solid 1px; font-size: 0.8em; }
.ui-multiselect ul { -moz-user-select: none; }
.ui-multiselect li { margin: 0; padding: 0; cursor: default; line-height: 20px; height: 20px; font-size: 11px; list-style: none; }
.ui-multiselect li a { color: #999; text-decoration: none; padding: 0; display: block; float: left; cursor: pointer;}
.ui-multiselect li.ui-draggable-dragging { padding-left: 10px; }

.ui-multiselect div.selected { position: relative; padding: 0; margin: 0; border: 0; float:left; }
.ui-multiselect ul.selected { position: relative; padding: 0; overflow: auto; overflow-x: hidden; background: #fff; margin: 0; list-style: none; border: 0; position: relative; width: 100%; }
.ui-multiselect ul.selected li { }

.ui-multiselect div.available { position: relative; padding: 0; margin: 0; border: 0; float:left; border-left: 1px solid; }
.ui-multiselect ul.available { position: relative; padding: 0; overflow: auto; overflow-x: hidden; background: #fff; margin: 0; list-style: none; border: 0; width: 100%; }
.ui-multiselect ul.available li { padding-left: 10px; }

.ui-multiselect .ui-state-default { border: none; margin-bottom: 1px; position: relative; padding-left: 20px;}
.ui-multiselect .ui-state-hover { border: none; }
.ui-multiselect .ui-widget-header {border: none; font-size: 11px; margin-bottom: 1px;}

.ui-multiselect .add-all { float: right; padding: 7px;}
.ui-multiselect .remove-all { float: right; padding: 7px;}
.ui-multiselect .search { float: left; padding: 4px;}
.ui-multiselect .count { float: left; padding: 7px;}

.ui-multiselect li span.ui-icon-arrowthick-2-n-s { position: absolute; left: 2px; }
.ui-multiselect li a.action { position: absolute; right: 2px; top: 2px; }

.ui-multiselect input.search { height: 14px; padding: 1px; opacity: 0.5; margin: 4px; width: 100px; }

/* multiselect styles */
  .multiselect {
    width: 460px;
    height: 200px;
  }
</style>

    <script type="text/javascript">
      
(function($) {

$.widget("ui.multiselect", {
  options: {
    sortable: true,
    searchable: true,
    doubleClickable: true,
    animated: 'fast',
    show: 'slideDown',
    hide: 'slideUp',
    dividerLocation: 0.6,
    width: null,
    height: null,
    nodeComparator: function(node1,node2) {
      var text1 = node1.text(),
          text2 = node2.text();
      return text1 == text2 ? 0 : (text1 < text2 ? -1 : 1);
    }
  },
  _create: function() {
    this.element.hide();
    this.id = this.element.attr("id");
    this.container = $('<div class="ui-multiselect ui-helper-clearfix ui-widget"></div>').insertAfter(this.element);
    this.count = 0; // number of currently selected options
    this.selectedContainer = $('<div class="selected"></div>').appendTo(this.container);
    this.availableContainer = $('<div class="available"></div>').appendTo(this.container);
    this.selectedActions = $('<div class="actions ui-widget-header ui-helper-clearfix"><span class="count">0 '+$.ui.multiselect.locale.itemsCount+'</span><a href="#" class="remove-all">'+$.ui.multiselect.locale.removeAll+'</a></div>').appendTo(this.selectedContainer);
    this.availableActions = $('<div class="actions ui-widget-header ui-helper-clearfix"><input type="text" class="search empty ui-widget-content ui-corner-all"/><a href="#" class="add-all">'+$.ui.multiselect.locale.addAll+'</a></div>').appendTo(this.availableContainer);
    this.selectedList = $('<ul class="selected connected-list"><li class="ui-helper-hidden-accessible"></li></ul>').bind('selectstart', function(){return false;}).appendTo(this.selectedContainer);
    this.availableList = $('<ul class="available connected-list"><li class="ui-helper-hidden-accessible"></li></ul>').bind('selectstart', function(){return false;}).appendTo(this.availableContainer);
    
    var that = this;
    
    var width = this.options.width;
    if (!width) {
      width = this.element.width();
    }
    var height = this.options.height;
    if (!height) {
      height = this.element.height();
    }
    
    // set dimensions
    this.container.width(width-2);
    this.selectedContainer.width(Math.floor(width*this.options.dividerLocation)-1);
    this.availableContainer.width(Math.floor(width*(1-this.options.dividerLocation))-2);

    // fix list height to match <option> depending on their individual header's heights
    this.selectedList.height(Math.max(height-this.selectedActions.height(),1));
    this.availableList.height(Math.max(height-this.availableActions.height(),1));
    
    if ( !this.options.animated ) {
      this.options.show = 'show';
      this.options.hide = 'hide';
    }
    
    // init lists
    this._populateLists(this.element.find('option'));
    
    // make selection sortable
    if (this.options.sortable) {
      this.selectedList.sortable({
        placeholder: 'ui-state-highlight',
        axis: 'y',
        update: function(event, ui) {
          // apply the new sort order to the original selectbox
          that.selectedList.find('li').each(function() {
            if ($(this).data('optionLink'))
              $(this).data('optionLink').remove().appendTo(that.element);
          });
        },
        beforeStop: function (event, ui) {
          // This lets us recognize which item was just added to
          // the list in receive, per the workaround for not being
          // able to reference the new element.
          ui.item.addClass('dropped');
        },
        receive: function(event, ui) {
          ui.item.data('optionLink').attr('selected', true);
          // increment count
          that.count += 1;
          that._updateCount();
          // workaround, because there's no way to reference 
          // the new element, see http://dev.jqueryui.com/ticket/4303
          that.selectedList.children('.dropped').each(function() {
            $(this).removeClass('dropped');
            $(this).data('optionLink', ui.item.data('optionLink'));
            $(this).data('idx', ui.item.data('idx'));
            that._applyItemState($(this), true);
          });
      
          // workaround according to http://dev.jqueryui.com/ticket/4088
          setTimeout(function() { ui.item.remove(); }, 1);
        },
        stop: function (event, ui) { that.element.change(); }
      });
    }
    
    // set up livesearch
    if (this.options.searchable) {
      this._registerSearchEvents(this.availableContainer.find('input.search'));
    } else {
      $('.search').hide();
    }
    
    // batch actions
    this.container.find(".remove-all").click(function() {
      that._populateLists(that.element.find('option').removeAttr('selected'));
      that.element.trigger('change');
      return false;
    });
    
    this.container.find(".add-all").click(function() {
      var options = that.element.find('option').not(":selected");
      if (that.availableList.children('li:hidden').length > 1) {
        that.availableList.children('li').each(function(i) {
          if ($(this).is(":visible")) $(options[i-1]).attr('selected', 'selected'); 
        });
      } else {
        options.attr('selected', 'selected');
      }
      that._populateLists(that.element.find('option'));
      that.element.trigger('change');
      return false;
    });
  },
  destroy: function() {
    this.element.show();
    this.container.remove();

    $.Widget.prototype.destroy.apply(this, arguments);
  },
  _populateLists: function(options) {
    this.selectedList.children('.ui-element').remove();
    this.availableList.children('.ui-element').remove();
    this.count = 0;

    var that = this;
    var items = $(options.map(function(i) {
        var item = that._getOptionNode(this).appendTo(this.selected ? that.selectedList : that.availableList).show();

      if (this.selected) that.count += 1;
      that._applyItemState(item, this.selected);
      item.data('idx', i);
      return item[0];
    }));
    
    // update count
    this._updateCount();
    that._filter.apply(this.availableContainer.find('input.search'), [that.availableList]);
  },
  _updateCount: function() {
    this.selectedContainer.find('span.count').text(this.count+" "+$.ui.multiselect.locale.itemsCount);
  },
  _getOptionNode: function(option) {
    option = $(option);
    var node = $('<li class="ui-state-default ui-element" title="'+option.text()+'"><span class="ui-icon"/>'+option.text()+'<a href="#" class="action"><span class="ui-corner-all ui-icon"/></a></li>').hide();
    node.data('optionLink', option);
    return node;
  },
  // clones an item with associated data
  // didn't find a smarter away around this
  _cloneWithData: function(clonee) {
    var clone = clonee.clone(false,false);
    clone.data('optionLink', clonee.data('optionLink'));
    clone.data('idx', clonee.data('idx'));
    return clone;
  },
  _setSelected: function(item, selected) {
    var temp = item.data('optionLink').attr('selected', selected);
    var parent = temp.parent();
    temp.detach().appendTo(parent);
    this.element.trigger('change');

    if (selected) {
      var selectedItem = this._cloneWithData(item);
      item[this.options.hide](this.options.animated, function() { $(this).remove(); });
      selectedItem.appendTo(this.selectedList).hide()[this.options.show](this.options.animated);
      
      this._applyItemState(selectedItem, true);
      return selectedItem;
    } else {
      
      // look for successor based on initial option index
      var items = this.availableList.find('li'), comparator = this.options.nodeComparator;
      var succ = null, i = item.data('idx'), direction = comparator(item, $(items[i]));

      // TODO: test needed for dynamic list populating
      if ( direction ) {
        while (i>=0 && i<items.length) {
          direction > 0 ? i++ : i--;
          if ( direction != comparator(item, $(items[i])) ) {
            // going up, go back one item down, otherwise leave as is
            succ = items[direction > 0 ? i : i+1];
            break;
          }
        }
      } else {
        succ = items[i];
      }
      
      var availableItem = this._cloneWithData(item);
      succ ? availableItem.insertBefore($(succ)) : availableItem.appendTo(this.availableList);
      item[this.options.hide](this.options.animated, function() { $(this).remove(); });
      availableItem.hide()[this.options.show](this.options.animated);
      
      this._applyItemState(availableItem, false);
      return availableItem;
    }
  },
  _applyItemState: function(item, selected) {
    if (selected) {
      if (this.options.sortable)
        item.children('span').addClass('ui-icon-arrowthick-2-n-s').removeClass('ui-helper-hidden').addClass('ui-icon');
      else
        item.children('span').removeClass('ui-icon-arrowthick-2-n-s').addClass('ui-helper-hidden').removeClass('ui-icon');
      item.find('a.action span').addClass('ui-icon-minus').removeClass('ui-icon-plus');
      this._registerRemoveEvents(item.find('a.action'));
      
    } else {
      item.children('span').removeClass('ui-icon-arrowthick-2-n-s').addClass('ui-helper-hidden').removeClass('ui-icon');
      item.find('a.action span').addClass('ui-icon-plus').removeClass('ui-icon-minus');
      this._registerAddEvents(item.find('a.action'));
    }
    
    this._registerDoubleClickEvents(item);
    this._registerHoverEvents(item);
  },
  // taken from John Resig's liveUpdate script
  _filter: function(list) {
    var input = $(this);
    var rows = list.children('li'),
      cache = rows.map(function(){
        
        return $(this).text().toLowerCase();
      });
    
    var term = $.trim(input.val().toLowerCase()), scores = [];
    
    if (!term) {
      rows.show();
    } else {
      rows.hide();

      cache.each(function(i) {
        if (this.indexOf(term)>-1) { scores.push(i); }
      });

      $.each(scores, function() {
        $(rows[this]).show();
      });
    }
  },
  _registerDoubleClickEvents: function(elements) {
    if (!this.options.doubleClickable) return;
    elements.dblclick(function() {
      elements.find('a.action').click();
    });
    
    // Double-clicks on an action link shouldn't do anything, as the
    // single-click listener does all the work in this case.
    // If we don't do this, then it is possible to create duplicates of an
    // item by clicking on the action link, then clicking again as the next
    // item slides into place beneath our cursor, triggering a double-click
    // and a single click on our event listeners.
    elements.find('a.action').dblclick(function (event) {
      event.stopPropagation();
    });
  },
  _registerHoverEvents: function(elements) {
    elements.removeClass('ui-state-hover');
    elements.mouseover(function() {
      $(this).addClass('ui-state-hover');
    });
    elements.mouseout(function() {
      $(this).removeClass('ui-state-hover');
    });
  },
  _registerAddEvents: function(elements) {
    var that = this;
    elements.click(function() {
      var item = that._setSelected($(this).parent(), true);
      that.count += 1;
      that._updateCount();
      return false;
    });
    
    // make draggable
    if (this.options.sortable) {
      elements.each(function() {
        $(this).parent().draggable({
          connectToSortable: that.selectedList,
          helper: function() {
            var selectedItem = that._cloneWithData($(this)).width($(this).width() - 50);
            selectedItem.width($(this).width());
            return selectedItem;
          },
          appendTo: that.container,
          containment: that.container,
          revert: 'invalid'
        });
      });     
    }
  },
  _registerRemoveEvents: function(elements) {
    var that = this;
    elements.click(function() {
      that._setSelected($(this).parent(), false);
      that.count -= 1;
      that._updateCount();
      return false;
    });
  },
  _registerSearchEvents: function(input) {
    var that = this;

    input.focus(function() {
      $(this).addClass('ui-state-active');
    })
    .blur(function() {
      $(this).removeClass('ui-state-active');
    })
    .keypress(function(e) {
      if (e.keyCode == 13)
        return false;
    })
    .keyup(function() {
      that._filter.apply(this, [that.availableList]);
    });
  }
});
    
$.extend($.ui.multiselect, {
  locale: {
    addAll:'Agregar todo',
    removeAll:'Eliminar todo',
    itemsCount:'Elementos seleccionados'
  }
});


})(jQuery);

      </script>

      <script type="text/javascript">
        $( "#ui-multiselect.ui-helper-clearfix.ui-widget" ).clone().appendTo( ".multiselect" );

    <?php

    $params[] = "sortable:false";
    $params[] = "searchable:true";
    $parameters = '{' .implode(',', $params). '}';
    Yii::app()->clientScript->registerScript(
        '$(".multiselect").multiselect('. $parameters .');',
        CClientScript::POS_READY
    );
    echo '<div class="multiselect"></div>';

     $this->widget('ext.emultiselect.EMultiSelect',array('sortable'=>false/true, 'searchable'=>true));
  $dataA = CHtml::listData(Autores::model()->findAll(), 'ID_AUTOR', 'AUTOR');
  echo CHtml::dropDownList('autores','',$dataA,array('multiple'=>'multiple','key'=>'genero', 'class'=>'multiselect col-md-6 form-control','style'=>'width:50%; height:20%;'));
 
  }
  else{
 //   echo $_SESSION["num"]; 
 //         $sortable=true;
 // $searchable=true;

 //        $basePath=Yii::getPathOfAlias('ext.emultiselect.assets');
 //        //$baseUrl = Yii::app()->getAssetManager()->publish($basePath);

 //        $cs=Yii::app()->getClientScript();
 //        $cs->registerCssFile($basePath . '/' . 'ui.multiselect.css');

 //        //$this->scriptUrl=$basePath;
 //        $cs->registerScriptFile('ui.multiselect.js');

 //        $params = array();
 //        if ($sortable) {
 //            $params[] = "sortable:true";
 //        } else {
 //            $params[] = "sortable:false";
 //        }

 //        if ($searchable) {
 //            $params[] = "searchable:true";
 //        } else {
 //            $params[] = "searchable:false";
 //        }

 //        $parameters = '{' .implode(',', $params). '}';
 //        Yii::app()->clientScript->registerScript(
 //            'EMultiSelect',
 //            '$(".multiselect").multiselect('. $parameters .');',
 //            CClientScript::POS_READY
 //        );
    

    Yii::import('ext.emultiselect.EMultiSelect');
  
  $this->widget('ext.emultiselect.EMultiSelect',array('sortable'=>false/true, 'searchable'=>true));
  $dataA = CHtml::listData(Autores::model()->findAll(), 'ID_AUTOR', 'AUTOR');
  echo CHtml::dropDownList('autores','',$dataA,array('multiple'=>'multiple','key'=>'genero', 'class'=>'multiselect col-md-6 form-control','style'=>'width:50%; height:20%;'));
  }

  // echo '<div class="multiselect"></div>';
  // if(isset($_SESSION["num"]))
  // {
  //   $params[] = "sortable:false";
  //   $params[] = "searchable:true";
  //   $parameters = '{' .implode(',', $params). '}';
  //       Yii::app()->clientScript->registerScript(
  //           '$(".multiselect").multiselect('. $parameters .');',
  //           CClientScript::POS_READY
  //       );
  // }
?>
