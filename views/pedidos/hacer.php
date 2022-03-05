<?php if(isset($_SESSION['id'])) : ?>

<h1>Hacer pedido</h1>
<p>
<a href="<?=base_url?>carrito/index">Ver productos alcanzados</a>
</p>
<br>
<h3>Datos para el envio</h3>
<form action="<?=base_url?>pedidos/add" method="POST">
    <label for="Provincia">Provincia</label>
    <input type="text" name="provincia" required>

    <label for="Ciudad">Cuidad</label>
    <input type="text" name="localidad" required>

    <label for="Direccion">Direccion</label>
    <input type="text" name="direccion" required>

    <input type="submit" value="Confirmar pedido">
</form>


<?php else: ?>
    <h1>Necesitas estar registrado para realizar un pedido</h1>
<?php endif ;?>