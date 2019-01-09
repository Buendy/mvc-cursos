<?php $this->layout('layout');

?>

<div class="contentTitles">
    <div class="titles">
        <h2>Home</h2>
    </div>
    <div class="paddin">
        <h3>You are in the View: application/view/categories/index.php (everything in the box comes from this file)</h3>
        <p>In a real application this could be the homepage categories.</p>

    </div>
</div>

<div class="contentTitles">

    <div class="titles">
        <h2>Tabla de categorías</h2>
    </div>
    <div class="paddin">
        <?php if(isset($_SESSION['userConSesionIniciada']['rol'])) : ?>
        <p>Crear nuevos cursos: <a href="<?= URL ?>curso/create" class="btnss">CREAR</a></p>
        <table>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th colspan="2">Acciones</th>
            </tr>

            <?php  foreach($data as $value): ?>
                <tr>
                    <td><?= $value->nombre ?></td>

                    <td><?= $value->descripcion ?></td>
                    <td>

                        <a href="<?= URL?>curso/show/<?= $value->id ?>">Ver curso</a></td>

                    <?php if(isset($_SESSION['userConSesionIniciada']['rol']) && $_SESSION['userConSesionIniciada']['rol'] == 'profesor')  :  ?>
                    <td>
                        <a href="<?= URL?>curso/edit/<?= $value->id ?>">Editar</a>
                        <?php endif ?>
                    </td>
                </tr>

            <?php endforeach ?>
            <?php endif ?>

        </table>
    </div>
</div>

