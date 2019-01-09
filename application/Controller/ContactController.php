<?php

namespace Mini\Controller;
use Illuminate\Support\Facades\URL;
use Mini\Core\Controller;
use Mini\Libs\Dbpdo;
Use Mini\Model\Contact;
use Mini\Core\Validacion;
use Mini\Model\Curso;


class ContactController extends Controller
{
    public function index()
    {
        if(!isset($_SESSION['userConSesionIniciada']['id'])){
            echo $this->view->render("/error/error-private");
        }else {

            if (isset($_POST['search'])) {
                $search = new Contact();
                $query = $search->search($_POST['search']);
                if ($query) {
                    echo $this->view->render("/home/index", ['data' => $query]);
                } else {
                    echo $this->view->render("/partials/error-search");
                }
            } else {
                $_SESSION['check'] = true;
                $categorias = new Contact();
                $query = $categorias->allWithCategory($_SESSION['userConSesionIniciada']['id']);
                echo $this->view->render("/contact/index", ['data' => $query]);
            }
        }

    }
    public function show($id = null)
    {

        if($id == null){
            header("Location:" . URL);
        }else {
            $post = new Dbpdo();
            $query = $post->allWithId('posts', $id);
            echo $this->view->render("post/show", ["data" => $query]);
        }

    }


    public function create()
    {
        if(!isset($_SESSION['userConSesionIniciada']['id'])){
            echo $this->view->render("/error/error-private");
        }else {
            $categoria = new Dbpdo();
            $query = $categoria->all('categories');
            $errores = [];
            if(!$_POST){
                echo $this->view->render("/contact/create", ['categoria' => $query]);
            }else {

                $repeat = new Dbpdo();
                $validaciones = new Validacion();

                if (!isset($_POST['nombre'])) {
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
                }

                if (empty($_POST['direccion'])) {
                    $errores['direccion'] = 'No he recibido la direccion';
                } else {
                    Validacion::formateaDatos($_POST['direccion']);
                    $value = $validaciones->validaDireccion($_POST['email']);
                    if ($value) {
                        $errores['direccion'] = $value;
                    }
                }


                if (empty($_POST['telefono'])) {
                    $errores['telefono'] = 'No he recibido el telefono';
                } else {
                    Validacion::formateaDatos($_POST['telefono']);
                    $value = $validaciones->validaTelefono($_POST['telefono']);
                    if ($value) {
                        $errores['telefono'] = $value;
                    }
                }



                if (!isset($_POST['categoria'])) {
                    $errores['categoria'] = 'No he recibido la categoria';
                } else {
                    Validacion::formateaDatos('categoria');
                    $cat = new Dbpdo();
                    $check = $cat->checkRepeat('categories', 'id', $_POST['categoria']);
                    if ($check == false) {
                        $errores['categoria'] = 'No has elegido una categoría correcta';
                    }

                }


            }


            if($errores){
                echo $this->view->render("/contact/create", ['categoria' => $query, 'errores' => $errores]);

            }else{
                $insert = new Contact();
                $insert->insert(['first_name' => $_POST['nombre'], 'last_name' => $_POST['apellidos'], 'email' => $_POST['email'],
                    'phone' => $_POST['telefono'], 'address' => $_POST['direccion'], 'category_id' => $_POST['categoria'],
                    'user_id' => $_SESSION['userConSesionIniciada']['id']]);
                echo $this->view->render("/partials/post-success");
            }

        }

    }


    public function edit($id = null)
    {
        if(!isset($_SESSION['userConSesionIniciada']['id'])){
            header("Location:" . URL);
        }else{
            if($id){
                $categoria = new Dbpdo();
                $query = $categoria->all('categories');
                $errores = [];
                if(!$_POST){

                    $post = new Dbpdo();
                    $postUp = $post->allWithIdUp('contacts', $id);

                    if(!$postUp){
                        header("Location:" . URL);
                    }else{
                        echo $this->view->render("/contact/edit", ['categoria' => $query, 'data' => $postUp]);
                    }



                }else{



                    $validaciones = new Validacion();

                    if (!isset($_POST['nombre'])) {
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
                    }

                    if (empty($_POST['direccion'])) {
                        $errores['direccion'] = 'No he recibido la direccion';
                    } else {
                        Validacion::formateaDatos($_POST['direccion']);
                        $value = $validaciones->validaDireccion($_POST['email']);
                        if ($value) {
                            $errores['direccion'] = $value;
                        }
                    }


                    if (empty($_POST['telefono'])) {
                        $errores['telefono'] = 'No he recibido el telefono';
                    } else {
                        Validacion::formateaDatos($_POST['telefono']);
                        $value = $validaciones->validaTelefono($_POST['telefono']);
                        if ($value) {
                            $errores['telefono'] = $value;
                        }
                    }



                    if (!isset($_POST['categoria'])) {
                        $errores['categoria'] = 'No he recibido la categoria';
                    } else {
                        Validacion::formateaDatos('categoria');
                        $cat = new Dbpdo();
                        $check = $cat->checkRepeat('categories', 'id', $_POST['categoria']);
                        if ($check == false) {
                            $errores['categoria'] = 'No has elegido una categoría correcta';
                        }

                    }


                    if($errores){
                        echo $this->view->render("/contact/edit", ['data' => $_POST, 'errores' => $errores, 'categoria' => $query]);
                    }else{
                        $post = new Contact();

                        $dataArray = ['first_name' => $_POST['nombre'], 'last_name' => $_POST['apellidos'], 'email' => $_POST['email'],
                            'phone' => $_POST['telefono'], 'address' => $_POST['direccion'], 'category_id' => $_POST['categoria'],
                            'user_id' => $_SESSION['userConSesionIniciada']['id'], 'id' => $id];
                        $post->update('contacts', $dataArray);

                        echo $this->view->render("/partials/update-success");
                    }
                }
            }else{
                header("Location:" . URL);
            }


        }



    }


    public function delete()
    {
        if(!isset($_SESSION['userConSesionIniciada']['id'])){
            header("Location:" . URL);
        }else{
            if(!$_POST){
                header("Location:" . URL);
            }else{
                $postDeleted = new Dbpdo();
                $delete = $postDeleted->delete('contacts', $_POST['id'], $_SESSION['userConSesionIniciada']['id'] );

                if($delete){
                    echo $this->view->render("/partials/delete-success");
                }else{
                    header("Location:" . URL);
                }

            }
        }

    }
}


