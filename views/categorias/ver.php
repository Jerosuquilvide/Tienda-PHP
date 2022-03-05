<?php if(isset($categoria)) : ?>
    <h1><?=$categoria->nombre?></h1>
    <?php if ($productos->num_rows == 0): ?>
        <p>No hay productos de esa categoria</p>
        <?php else: ?>
            <?php while($pro = $productos->fetch_object() ): ?>

                <div class="productos">
                    <a href="<?=base_url?>productos/ver&id=<?=$pro->id?>">
                            <?php if($pro->imagen != NULL) : ?>
                                    <img src="<?=base_url?>uploads/images/<?=$pro->imagen?>">
                            <?php else: ?>
                                <img src="<?=base_url?>assets/image/camiseta.png">
                            <?php endif ; ?>
                                    <h2><?= $pro->nombre?></h2>
                    </a>
                            <p><?= $pro->precio?></p>
                            <a href="<?=base_url?>carrito/add&id=<?=$pro->id?>" class="button">Comprar</a>
                </div>

<?php endwhile ; ?>
        <?php endif; ?>
<?php else: ?>
    <h1>Error</h1>
<?php endif; ?>