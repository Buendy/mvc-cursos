<?php
d($data);
d($datauser);

$this->layout('layout'); ?>

<div class="contentTitles">
    <div class="titles">
        <h2>Detalles</h2>
    </div>

    <div class="paddin" id="padd">

        <?php  foreach($datauser as $value): ?>
            <div class="contentTitles" id="paddtitle">

                <div class="titles">
                    <h3 class="centrado">Detalles alumno</h3>
                </div>
                <div class="paddin">
                    <p><?= $value->nombre ?></p>
                    <p><?= $value->email ?></p>
                </div>
            </div>
        <?php endforeach ?>

        <div class="contentTitles" id="paddtitle">

            <div class="titles">
                <h3 class="centrado">Cursos</h3>
            </div>
            <div class="paddin">
                <?php  foreach($data as $value ) : ?>
                    <p><?= $value->nombre ?></p>
                <?php endforeach ?>

            </div>
        </div>

    </div>


</div>
