<?php  if(isset($_SESSION['pedido']) && $_SESSION['pedido'] == "complete") : ?>
<h1>Tu pedido fue confirmado con exito</h1>
<p>
    Una vez realiza la transferencia a la cuenta bancaria 1111122222 
    sera procesado y enviado 
</p>
<br>
    <?php if(isset($pedido)) : ?>
            <h3>Datos del envio: </h3>
        
                Numero del pedido: <?=$pedido->id?> <br>
                Total a pagar $: <?=$pedido->coste?> <br>
                <h3>Productos:</h3> <br>
                <table>
                    <tr>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                    </tr>
                <?php while($producto = $productos->fetch_object()) : ?>
                <tr>

                    <td>
                            <?php if($producto->imagen != NULL) : ?>
                            <img src="<?=base_url?>uploads/images/<?=$producto->imagen?>" class="img_carrito">
                            <?php else: ?>
                                <img src="<?=base_url?>assets/image/camiseta.png" class="img_carrito">
                            <?php endif ; ?>
                    </td>
            
                    <td>
                        <a href="<?=base_url?>productos/ver&id=<?=$producto->id?>"><?= $producto->nombre ?></a>
                    </td>

                    <td>
                        <?= $producto->precio?>
                    </td>

                    <td>
                        <?= $producto->unidades?>
                    </td>
            </tr>
                <?php endwhile ; ?>
                </table>
    <?php endif ; ?>
<?php elseif(isset($_SESSION['pedido']) && $_SESSION['pedido'] != "complete") : ?>
    <h1>Tu pedido no pudo  confirmarse con exito</h1>
<?php endif ; ?>