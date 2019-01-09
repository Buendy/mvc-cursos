<?php ?>
<div class="izquierda">
    <?php if(isset($_SESSION['userConSesionIniciada']['rol']) && $_SESSION['userConSesionIniciada']['rol']== 'profesor'): ?>
        <h4>Area de usuarios</h4>
        <p><a href="<?= URL ?>user/create" class="btns">Crear usuarios</a></p>
        <p><a href="<?= URL ?>user/index" class="btns">Ver Usuarios</a></p>
        <h4>Area de categorías</h4>
        <p><a href="<?= URL ?>curso/index" class="btns">Ver Cursos</a></p>
        <p><a href="<?= URL ?>curso/create" class="btns">Crear Cursos</a></p>
    <?php endif; ?>
    <?php if(isset($_SESSION['userConSesionIniciada']['rol']) && $_SESSION['userConSesionIniciada']['rol']== 'alumno'): ?>
        <p><a href="<?= URL ?>curso/index" class="btns">Ver Cursos</a></p>
        <p><a href="<?= URL ?>curso/my" class="btns">Mis cursos</a></p>
    <?php endif; ?>
</div>