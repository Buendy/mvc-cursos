<?php
use Mini\Core\Functions;
$this->layout('layout');
$content = new Functions();
?>

<div class="contentTitles">
    <div class="titles">
        <h2>Login</h2>
    </div>
    <div class="paddin">

        <h2>You are in the View: application/view/login/index.php (everything in the box comes from this file)</h2>
        <p>In a real application this could be the login page.</p>
    </div>
</div>


<div class="contentTitles">
    <div class="titles">
        <h5>Formulario de login</h5>
    </div>
    <div class="paddin">
        <div class="container">
            <div align="center">
                <form class="" action="<?= URL ?>user/edit/<?= $data[0]->id ?>" method="post">
                    <?php
                    if(isset($errores)){
                        Functions::mostrarErrorCampo('nombre', $errores);
                        Functions::mostrarErrorCampo('apellidos', $errores);
                        Functions::mostrarErrorCampo('email', $errores);
                        Functions::mostrarErrorCampo('rol', $errores);
                    }
                    ?>
                    <p>Nombre:</p>
                    <p><input type="text" name="nombre" value="<?= isset($data[0]->nombre) ? $data[0]->nombre : $data['nombre'] ?>"></p>
                    <p>Apellidos:</p>
                    <p><input type="text" name="apellidos" value="<?= isset($data[0]->apellidos) ? $data[0]->apellidos : $data['apellidos'] ?>"></p>
                    <p>Email:</p>
                    <p><input type="text" name="email" value="<?= isset($data[0]->email) ? $data[0]->email : $data['email'] ?>"></p>

                    <p>Rol de usuario:</p>
                    <p><select name="rol" id="">
                            <option value="alumno">Alumno</option>
                            <option value="profesor">Profesor</option>
                        </select></p>
                    <p><input type="submit" name="submit" value="Submit"></p>
                </form>
            </div>
        </div>

    </div>
</div>
