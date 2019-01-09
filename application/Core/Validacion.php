<?php

namespace Mini\Core;
use Mini\Model\User;

class Validacion
{
    private $tam_max = 2 * 1024 * 1024; //declaramos como tam maximo 2 MB

    public static function checkField()
    {

        if(!isset($_POST['initname'])){
            return 'No he recibido el nombre de usuario';

        }else if(!$_POST['initname']){
            return'No he recibido el nombre de usuario';

        }else{
            return null;
        }

    }


    public static function checkPass()
    {
        if(!isset($_POST['pass'])){
            return  'No he recibido la contraseña';

        }else if(!$_POST['pass']){
            return  'No he recibido la contraseña';

        }else{
            return null;
        }
    }

    public static function checkRep($table, $nombreCampo, $valorCampo, $pass, $valorPass)
    {
        $query = new User();
        d($valorPass);
        d(md5($valorPass));

        if(!$query->checkRepeat($table, $nombreCampo, $valorCampo)){
            return 'Usuario o contraseña incorrectos1';



        }else{
            if(!$query->checkRepeatPass($table, $nombreCampo, $valorCampo, $pass,  md5($valorPass))){
                return 'Usuario o contraseña incorrecto2';

            }

        }

    }

    public function validaDescripcion($campo){

        if ( isset($campo)){

            if(strlen($campo) < 20){
                return 'La descripción es demasiado corta<br>';
            }elseif(strlen($campo) > 100){
                return 'la descripcion es demasiado larga';
            }else {
                return null;
            }
        } else {
            return 'No he recibido la descripción';
        }
    }


    public function validaPalabras($campo){

        if (isset($campo)){

            if(!preg_match("/^([A-ZÑ\d]{2,}[,]){4,9}[A-ZÑ\d]{2,}$/",$campo)){
                return 'Por favor, introduce de 5 a 10 palabras separadas por comas';
            }else {
                return null;
            }
        } else {
            return 'No he recibido ninguna palabra';
        }
    }


    public function validaNombre($campo){

        if (isset($campo)){

            if(strlen($campo) < 3){
                return 'El nombre es demasiado corto<br>';
            }elseif(preg_match("/[^a-zA-Z' áéíóúàèìòùäëïöüÁÉÍÓÚÀÈÌÒÙÄËÏÖÜ]/", $campo)){
                return 'El nombre no puede contener números o caracteres especiales';
            }else {
                return null;
            }
        } else {
            return 'No he recibido el nombre';
        }
    }

    public function validaDireccion($campo){

        if (isset($campo)){

            if(strlen($campo) < 5){
                return 'La dirección es demasiado corta<br>';
            }elseif(strlen($campo) > 255){
                return 'La dirección es muy larga';
            }else {
                return null;
            }
        } else {
            return 'No he recibido la dirección nombre';
        }
    }

    public function validaApellidos($campo){

        if(isset($campo)){

            if(strlen($campo) < 4){
                return 'El apellido es demasiado corto<br>';
            } elseif(preg_match("/[^a-zA-Z'á éíóúàèìòùäëïöüÁÉÍÓÚÀÈÌÒÙÄËÏÖÜ]/", $campo)){
                return 'El apellido no puede contener números o caracteres especiales';
            }else {
                return null;
            }

        } else {
            return 'No he recibido los apellidos';
        }

    }

    public function validaEmail($campo){ //Se valida el email para que tenga el formato correcto

        if (isset($campo)){

            if(strlen($campo) < 6){
                return 'El email es demasiado corto';
            }elseif(!preg_match_all('/^[a-zA-Z\d-_*\.]+@[a-zA-Z\d-_*\.]+\.[a-zA-Z\d]{2,}$/',$campo)){
                return 'El email no es correcto';
            }else {
                return null;
            }
        } else {
            return 'No he recibido el email';
        }

    }
    public function validaTelefono($campo){

        if(isset($campo)){

            if(strlen($campo) < 9 || strlen($campo) > 9  ){
                return 'El número de teléfono introducido no es correcto';
            }elseif(!preg_match('/^[8|9|6|7][\d]{8}$/', $campo)){
                return 'El número introducido no es correcto';
            } else {
                return null;
            }
        } else {
            return 'No he recibido el teléfono';
        }

    }

    public function validaPass($campo1, $campo2){

        if(isset($campo1) || isset($campo2)){

            if(strlen($campo1) < 8){
                return 'La contraseña debe de tener al menos 8 caracteres';

            }elseif(!preg_match_all("/(?=.*[A-Z])(?=.*\d)(?=.*[a-z])/", $campo1)){
                return 'El formato no es correcto, Debe tener 1 minúscula, 1 mayúscula y 1 número';
            }elseif($campo1 != $campo2){
                return 'Las contraseñas no coinciden';
            } else {
                return null;
            }
        } else {
            return 'No he recibido ambas claves';
        }

    }



    public static function formateaDatos($campo){

        if ( isset($_POST[$campo])){
            $_POST[$campo] = trim($_POST[$campo]);
            $_POST[$campo] = strip_tags($_POST[$campo]);
            $_POST[$campo] = preg_replace("/\"/",'', $_POST[$campo]);
            return $_POST[$campo];
        }

    }



}