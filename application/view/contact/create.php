<?php $this->layout('layout');
use Mini\Core\Functions;
$content = new Functions();

?>

<div class="contentTitles">
    <div class="titles">
        <h2>Home</h2>
    </div>
    <div class="paddin">
        <h3>You are in the View: application/view/categories/create.php (everything in the box comes from this file)</h3>
        <p>In a real application this could be the category form.</p>

    </div>
</div>


<div class="contentTitles">
    <div class="titles">
        <h2>Formulario para la creación posts</h2>
    </div>
    <div class="paddin">
        <?php
        if(isset($errores)) {
            Functions::mostrarErrorCampo('nombre', $errores);
            Functions::mostrarErrorCampo('apellidos', $errores);
            Functions::mostrarErrorCampo('email', $errores);
            Functions::mostrarErrorCampo('telefono', $errores);
            Functions::mostrarErrorCampo('direccion', $errores);
            Functions::mostrarErrorCampo('categoria', $errores);
        }
        ?>
        <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">
            <p><label for="nombre">Nombre:</label></p>
            <p><input type="text" name="nombre" <?= $content::mostrarCampo('nombre') ?>></p>
            <p><label for="apellidos">Apellidos:</label></p>
            <p><input type="text" name="apellidos" <?= $content::mostrarCampo('apellidos') ?>></p>
            <p><label for="email">Email:</label></p>
            <p><input type="text" name="email" <?= $content::mostrarCampo('email') ?>></p>
            <p><label for="telefono">Teléfono:</label></p>
            <p><input type="text" name="telefono" <?= $content::mostrarCampo('telefono') ?>></p>
            <p><label for="direccion">Dirección:</label></p>
            <p><input type="text" name="direccion" <?= $content::mostrarCampo('direccion') ?>></p>


            <p><label for="categoria">Categoría:</label></p>
            <select name="categoria" id="">
                <option value="-">Seleccione una categoría</option>
                <?php foreach ($categoria as $value) :?>
                <option value="<?= $value->id ?>"><?= $value->name ?></option>
                <?php endforeach; ?>
            </select>


            <p><input type="submit" value="Crear" class="btnss"></p>
        </form>


    </div>
</div>
