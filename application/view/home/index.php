<?php $this->layout('layout');
?>

<div class="contentTitles">
    <div class="titles">
        <?php if(isset($_SESSION['check'])) : ?>
            <form action="<?php echo URL; ?>home/index" method="post">
                <p><label for="search">Buscar por palabras: </label><input type="text" name="search"><input type="submit" value="Buscar" class="btnss"></p>
            </form>
        <?php endif ?>
    </div>
</div>

<div class="contentTitles">
    <div class="titles">
        <h2>Home EXAMEN 31</h2>
    </div>
    <div class="paddin">
        <h3>You are in the View: application/view/home/index.php (everything in the box comes from this file)</h3>
        <p>In a real application this could be the homepage.</p>
    </div>
</div>


<div class="contentTitles">
    <div class="titles">
        <h2>Listado de cursos</h2>
    </div>
    <div class="paddin" id="padd">

        <?php  foreach($data as $value): ?>
        <div class="contentTitles" id="paddtitle">

            <div class="titles">
                <h3 class="centrado"><?= $value->nombre ?></h3>
            </div>
            <div class="paddin">
                <p class="centrado"><a href="<?= URL?>curso/show/<?= $value->id ?>" class="btnss">Ver curso</a></p>
            </div>
        </div>
        <?php endforeach ?>
    </div>
</div>






