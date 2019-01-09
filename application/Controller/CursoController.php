<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 30/12/18
 * Time: 21:04
 */

namespace Mini\Controller;
use Mini\Libs\Dbpdo;
use Mini\Core\Controller;
use Mini\Core\Validacion;
use Mini\Model\Curso;
use Mini\Model\Study;
use Exception;




class CursoController extends Controller
{
    public function index()
    {
        $categorias = new Dbpdo();

        $query = $categorias->all('cursos');
        echo $this->view->render("/cursos/index", ['data' => $query]);
    }

    public function create()
    {
        if(isset($_SESSION['userConSesionIniciada']['rol']) && $_SESSION['userConSesionIniciada']['rol'] == 'profesor'){

            $errores = [];
            if(!$_POST){
                echo $this->view->render("/cursos/create");
            }else{
                $repeat = new Dbpdo();
                $validaciones = new Validacion();

                if(!isset($_POST['nombre'])){
                    $errores['nombre'] = 'No he recibido el nombre';
                }else{
                    Validacion::formateaDatos($_POST['nombre']);
                    $value = $validaciones->validaNombre($_POST['nombre']);
                    if($value){
                        $errores['nombre'] = $value;
                    }
                    if($check = $repeat->checkRepeat('cursos','nombre', $_POST['nombre'])){
                        $errores['nombre'] = 'Este curso ya existe';
                    }
                }
                if(empty($_POST['descripcion'])){
                    $errores['descripcion'] = 'No he recibido la descripción';
                }else{
                    Validacion::formateaDatos($_POST['descripcion']);
                }

                if($errores){
                    echo $this->view->render("/cursos/create", ['errores' => $errores]);

                }else{
                    $insert = new Curso();
                    $insert->insert(['nombre' => $_POST['nombre'], 'descripcion' => $_POST['descripcion']]);
                    echo $this->view->render("/partials/category-success");
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
                    $cursos = new Dbpdo();
                    $query = $cursos->allWithId('cursos', $id);

                    echo $this->view->render("/cursos/edit", ['data' => $query]);


                }else{

                    $category = new Curso();
                    $validaciones = new Validacion();

                    if(!isset($_POST['nombre'])){
                        $errores['nombre'] = 'No he recibido el nombre';
                    }else{
                        Validacion::formateaDatos($_POST['nombre']);
                        if(!$check = $category->checkRepeatUpdate('cursos', 'nombre', $_POST['nombre'], $id)){
                            $errores['nombre'] = 'Ese curso ya existe';
                        }
                    }

                    if(!isset($_POST['descripcion'])){
                        $errores['descripcion'] = 'No he recibido la descripción';
                    }else{
                        Validacion::formateaDatos($_POST['descripcion']);
                        $value = $validaciones->validaDescripcion($_POST['descripcion']);
                        if($value){
                            $errores['descripcion'] = $value;
                        }
                    }


                    if($errores){
                        echo $this->view->render("/cursos/edit", ['data' => $_POST, 'errores' => $errores]);
                    }else{
                        $dataArray = ['id' => $id, 'nombre' => $_POST['nombre'], 'descripcion' => $_POST['descripcion']];
                        $category->update('cursos', $dataArray);
                        echo $this->view->render("/partials/update-success");
                    }
                }

            }else{
                header("Location:" . URL);
            }

        }else{
            echo $this->view->render("/error/error-private");
        }





    }

    public function enroll($id)
    {
        $matricula = new Study();
        $dataArray = ['id_user' => $_SESSION['userConSesionIniciada']['id'], 'id_curso' => $id];
        $matricula->insert($dataArray);
        echo $this->view->render("/user/user-enroll");

    }

    public function show($id)
    {
        $categorias = new Dbpdo();
        $matricula = new Study();

        $query = $categorias->allWithId('cursos', $id);
        $query2 = $matricula->query($_SESSION['userConSesionIniciada']['id'], $id);

            echo $this->view->render("/cursos/show", ['data' => $query, 'matricula' => $query2]);



    }



}