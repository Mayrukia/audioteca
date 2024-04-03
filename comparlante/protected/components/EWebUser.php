<?php

class EWebUser extends CWebUser{

 

    protected $_model;

/*
    function OP2(){

        $user = $this->loadUser();

        if ($user)

           return $user->COD_TIPO_USUARIO==LevelLookUp::OP2;

        return false;

    }
*/
    // Load user model.

    protected function loadUser()

    {

        $sql = "SELECT ID_USUARIO FROM usuario Where ID_USUARIO=:value";

        $params=array(':value'=>$this->id);

        if ( $this->_model === null ) {

                $this->_model = Usuario::model()->findBySql($sql,$params);

        }

        return $this->_model;

    }

}