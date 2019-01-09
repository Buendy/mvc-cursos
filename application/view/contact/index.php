<?php $this->layout('layout'); d($data)?>

<div class="contentTitles">
    <div class="titles">
        <?php if(isset($_SESSION['check'])) : ?>
            <form action="<?php echo URL; ?>post/index" method="post">
                <p><label for="search">Buscar por palabras: </label><input type="text" name="search"><input type="submit" value="Buscar" class="btnss"></p>
            </form>
        <?php endif ?>
    </div>
</div>
<div class="contentTitles">
    <div class="titles">
        <h2>Posts index</h2>
    </div>
    <div class="paddin">
        <h3>You are in the View: application/view/post/index.php (everything in the box comes from this file)</h3>
        <p>In a real application this could be the posts show page.</p>
    </div>
</div>

<div class="contentTitles">
    <div class="titles">
        <h2>Listado de posts</h2>
    </div>
    <div class="paddin">
        <p>Crear nuevo contacto: <a href="<?= URL ?>contact/create" class="btnss">CREAR</a></p>
        <table>
            <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Categoría</th>

                <th colspan="2">Acciones</th>
            </tr>
            <?php  foreach($data as $value): ?>
                <tr>
                    <td><?= $value->first_name ?></td>

                    <td><?= $value->last_name ?></td>
                    <td><?= $value->email ?></td>
                    <td><?= $value->phone ?></td>
                    <td><?= $value->address ?></td>
                    <td><?= $value->name ?></td>
                    <td><a href="<?= URL?>contact/edit/<?= $value->id ?>">Editar</a></td>
                    <form action="<?= URL ?>contact/delete" method="post">
                        <input type="hidden" value="<?= $value->id ?>" name="id">
                        <td><input type="submit" value="Borrar" class="btnsdelete"></td>
                    </form>
                </tr>

            <?php endforeach ?>
        </table>

    </div>
</div>

