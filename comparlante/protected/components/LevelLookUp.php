<?php

class LevelLookUp{

      const A1=A1;



      // For CGridView, CListView Purposes

      public static function getLabel( $level ){

          if($level == self::A1)

             return 'A1';

        
          return false;

      }

      // for dropdown lists purposes

      public static function getLevelList(){

          return array(

                 self::A1=>'A1',

              

          ); 

    }

}

