<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 30/12/18
 * Time: 17:38
 */

namespace Mini\Controller;
Use Mini\Core\Controller;
Use Mini\Core\Validacion;
Use Mini\Model\User;
Use Mini\Libs\Dbpdo;
Use Mini\Model\Curso;



class UserController extends Controller
{
    public function index()
    {
        if(isset($_SESSION['userConSesionIniciada']['rol']) && $_SESSION['userConSesionIniciada']['rol'] == 'profesor'){
            $categorias = new Dbpdo();
            $query = $categorias->allCondition('users', 'rol', 'alumno');
            echo $this->view->render("/user/index", ['data' => $query]);

        }else{
            echo $this->view->render("/error/error-private");
        }
    }

    public function login()
    {
        $errores = [];
        if(!isset($_SESSION['userConSesionIniciada']['id'])){
            if(!$_POST){
                echo $this->view->render("/user/login");
            }else{

                if(Validacion::checkField() != null){
                    Validacion::formateaDatos($_POST['initname']);
                    $errores['inituser']=Validacion::checkField();
                };

                if(Validacion::checkPass() != null){
                    Validacion::formateaDatos($_POST['pass']);
                    $errores['pass']=Validacion::checkPass();

                };


                if(!$errores){
                    if(Validacion::checkRep('users', 'email', $_POST['initname'], 'password', $_POST['pass']) != null){
                        $errores['inituser']= Validacion::checkRep('users', 'email', $_POST['initname'], 'password', $_POST['pass']);
                    };
                }



                if ($errores) {
                    echo $this->view->render("/user/login", ["errores" => $errores]);
                } else {

                    $query = new User();
                    $user = $query->allFields('users', 'email', $_POST['initname']);
                    $_SESSION['userConSesionIniciada']['id'] = $user['id'];
                    $_SESSION['userConSesionIniciada']['email'] = $user['email'];
                    $_SESSION['userConSesionIniciada']['rol'] = $user['rol'];
                    echo $this->view->render("/partials/login-succes");

                }

            }

        }else{

            echo $this->view->render("/error/error-login");
        }
    }

    public function logout()
    {
        session_destroy();
        echo $this->view->render("/partials/logout");
    }


    public function create()
    {
        if($_SESSION['userConSesionIniciada']['rol'] == 'profesor'){

            $errores = [];
            if(!$_POST){
                echo $this->view->render("/user/create");
            }else {
                $repeat = new Dbpdo();
                $validaciones = new Validacion();


                if (empty($_POST['nombre'])) {
                    $errores['nombre'] = 'No he recibido el nombre';
                } else {
                    Validacion::formateaDatos($_POST['nombre']);
                    $value = $validaciones->validaNombre($_POST['nombre']);
                    if ($value) {
                        $errores['nombre'] = $value;
                    }
                }

                if (empty($_POST['apellidos'])) {
                    $errores['apellidos'] = 'No he recibido los apellidos';
                } else {
                    Validacion::formateaDatos($_POST['apellidos']);
                    $value = $validaciones->validaApellidos($_POST['apellidos']);
                    if ($value) {
                        $errores['apellidos'] = $value;
                    }
                }


                if (empty($_POST['email'])) {
                    $errores['email'] = 'No he recibido el email';
                } else {
                    Validacion::formateaDatos($_POST['email']);
                    $value = $validaciones->validaEmail($_POST['email']);
                    if ($value) {
                        $errores['email'] = $value;
                    }
                    if ($check = $repeat->checkRepeat('users', 'email', $_POST['email'])) {
                        $errores['email'] = 'Ese email ya existe';
                    }
                }

                if(empty($_POST['pass1']) || empty($_POST['pass2'])){
                    $errores['pass'] = 'No he recibido ambas claves<br>';
                } else {
                    Validacion::formateaDatos('pass1');
                    Validacion::formateaDatos('pass2');
                    $value = $validaciones->validaPass($_POST['pass1'], $_POST['pass2']);
                    if($value){
                        $errores['pass'] = $value;
                    }

                }

                if(!isset($_POST['rol'])){
                    $errores['rol'] = 'No he recibido el rol del usuario';

                }else{
                    if($_POST['rol'] != 'profesor'){
                        if($_POST['rol'] != 'alumno'){
                            $errores['rol'] = 'El rol del usuario no es correcto';
                        }
                    }
                }

                if($errores){
                    echo $this->view->render("/user/create", ['errores' => $errores]);
                }else{

                    $insert = new User();
                    $insert->insert(['first_name' => $_POST['nombre'], 'last_name' => $_POST['apellidos'], 'email' => $_POST['email'],
                        'password' => md5($_POST['pass1']), 'rol' => $_POST['rol']]);
                    echo $this->view->render("/user/user-success");
                }

            }

        }else {
            echo $this->view->render("/error/error-private");



        }

    }

    public function edit($id = null)
    {
        if(isset($_SESSION['userConSesionIniciada']['rol']) && $_SESSION['userConSesionIniciada']['rol'] == 'profesor'){
            if($id){
                $errores = [];
                if(!$_POST){

                    $post = new Dbpdo();
                    $userUp = $post->allWithIdUp('users', $id);
                    d($userUp);
                    if(!$userUp){
                        header("Location:" . URL);
                    }else{
                        echo $this->view->render("/user/edit", ['data' => $userUp]);
                    }
                }else {
                    $repeat = new Dbpdo();
                    $validaciones = new Validacion();


                    if (empty($_POST['nombre'])) {
                        $errores['nombre'] = 'No he recibido el nombre';
                    } else {
                        Validacion::formateaDatos($_POST['nombre']);
                        $value = $validaciones->validaNombre($_POST['nombre']);
                        if ($value) {
                            $errores['nombre'] = $value;
                        }
                    }

                    if (empty($_POST['apellidos'])) {
                        $errores['apellidos'] = 'No he recibido los apellidos';
                    } else {
                        Validacion::formateaDatos($_POST['apellidos']);
                        $value = $validaciones->validaApellidos($_POST['apellidos']);
                        if ($value) {
                            $errores['apellidos'] = $value;
                        }
                    }


                    if (empty($_POST['email'])) {
                        $errores['email'] = 'No he recibido el email';
                    } else {
                        Validacion::formateaDatos($_POST['email']);
                        $value = $validaciones->validaEmail($_POST['email']);
                        if ($value) {
                            $errores['email'] = $value;
                        }
                        if(!$check = $repeat->checkRepeatUpdate('users', 'email', $_POST['email'], $id)){
                            $errores['email'] = 'Ese correo ya existe';
                        }
                    }

                    if(!isset($_POST['rol'])){
                        $errores['rol'] = 'No he recibido el rol del usuario';

                    }else{
                        if($_POST['rol'] != 'profesor'){
                            if($_POST['rol'] != 'alumno'){
                                $errores['rol'] = 'El rol del usuario no es correcto';
                            }
                        }
                    }

                    if($errores){
                        echo $this->view->render("/user/edit", ['errores' => $errores, 'data' => $_POST]);
                    }else{

                        $insert = new User();
                        $insert->update(
                            'users',
                            ['first_name' => $_POST['nombre'], 'last_name' => $_POST['apellidos'], 'email' => $_POST['email'],'rol' => $_POST['rol'], 'id' => $id]
                        );
                        echo $this->view->render("/user/user-success");
                    }

                }

            }else{
                header("Location:" . URL);
            }


        }else {
            echo $this->view->render("/error/error-private");
        }

    }


    public function details($id)
    {
        $query = new Curso();
        $data = $query->matriculacines($id);
        $query2 = new User();
        $datauser = $query2->allWithId('users', $id);
        echo $this->view->render("/user/details", ['data' => $data, 'datauser' => $datauser]);

    }



}