 <!--Barra Lateral-->
 <aside id="lateral">

 <div id="login" class="block_aside">
     <?php 
        $stats = Utils::statsCarrito();
     ?>
        <h3>Carrito</h3>
        <ul>
             <li>Total Productos (<?=$stats['count']?>)</li>
             <li>Total $ : <?=$stats['total']?></li>
            <li><a href="<?=base_url?>carrito/index">Ver Carrito</a></li>
        </ul>
 </div>

<div id="login" class="block_aside">
    <?php if(!isset($_SESSION['id'])) : ?>
    <h3>Entrar</h3>
    <form action="<?=base_url?>usuario/login" method="post">
        <label for="email">Email</label>
        <input type="email" name="email">

        <label for="password">Contraseña</label>
        <input type="password" name="password">
        <input type="submit" value="Enviar">
    </form>
    <?php else : ?>
        <h3><?= $_SESSION['id']->nombre ?></h3>
    <?php endif; ?>
    <ul>
        <!--Aca estaban los li-->
            
            <?php if(isset($_SESSION['admin'])) :?>
            <i class="fab fa-algolia"></i><a href="<?=base_url?>pedidos/mis_pedidos">Gestionar Pedidos</a>
            <i class="fab fa-algolia"></i><a href="<?= base_url?>productos/gestion">Gestionar Productos</a>
            <i class="fas fa-book"></i><a href="<?= base_url?>categoria/index">Gestionar Categorias</a>
            <?php endif; ?>
            <?php if(isset($_SESSION['id'])) : ?>
            <i class="fas fa-address-card"></i><a href="<?=base_url?>carrito/index">Pedidos</a>
            <i class="fas fa-address-card"></i><a href="<?=base_url?>usuario/logout">Cerrar Sesion</a>
            <?php else: ?>
                <li><a href="<?=base_url?>usuario/registro">Registrarse</a></li>
            <?php endif ; ?>
    </ul>
</div>

</aside>

<!--Contenido-->
<div id="central">