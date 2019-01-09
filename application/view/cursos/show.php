<?php $this->layout('layout');
d($matricula);
?>

<div class="contentTitles">
    <div class="titles">
        <h2>Cursos</h2>
    </div>
    <div class="paddin">
        <h3>You are in the View: application/view/categories/index.php (everything in the box comes from this file)</h3>
        <p>In a real application this could be the homepage categories.</p>

    </div>
</div>
<?php  foreach($data as $value): ?>
<div class="contentTitles">

    <div class="titles">
        <h2><?= $value->nombre ?></h2>
    </div>
    <div class="paddin">

        <?php if(isset($_SESSION['userConSesionIniciada']['rol'])) : ?>
            <?php if($matricula) : ?>
                <p>Ya estás matriculado en este curso</p>
            <?php else : ?>
                <p><a href="<?= URL?>curso/enroll/<?= $value->id ?>">Matricularme</a></p>
            <?php endif ?>
        <?php endif ?>

        <h3>Información sobre el curso</h3>
        <p><?= $value->nombre ?></p>
        <p><?= $value->descripcion ?></p>
        <?php endforeach ?>



    </div>
</div>

