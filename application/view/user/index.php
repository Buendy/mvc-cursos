<?php $this->layout('layout');
?>




<div class="contentTitles">
    <div class="titles">
        <h2>Listado de usuarios</h2>
    </div>
    <div class="paddin">

        <table>
            <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Email</th>
                <th colspan="2">Acciones</th>

            </tr>
            <?php  foreach($data as $value): ?>

                <tr>

                    <td><?= $value->nombre ?></td>

                    <td><?= $value->apellidos ?></td>
                    <td><?= $value->email ?></td>
                    <td class="centrado"><a href="<?= URL?>user/edit/<?= $value->id ?>">Editar</a></td>
                    <td class="centrado"><a href="<?= URL?>user/details/<?= $value->id ?>">Matriculaciones</a></td>
                </tr>


            <?php endforeach ?>
        </table>

    </div>
</div>