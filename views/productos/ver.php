<?php if(isset($pro)) : ?>

    <h1><?=$pro->nombre?></h1>    
        <div id="detail-product">
            <div class="image">
                <?php if($pro->imagen != NULL) : ?>

                        <img src="<?=base_url?>uploads/images/<?=$pro->imagen?>">

                        <?php else: ?>
                    </div>
                    <div class="data">
                            <img src="<?=base_url?>assets/image/camiseta.png">

                            <?php endif ; ?>

                            <p class="description"><?= $pro->descripcion?></p>
                            <p class="price"><?= $pro->precio?>$</p>
                            <a href="<?=base_url?>carrito/add&id=<?=$pro->id?>" class="button">Comprar</a>
                    </div >
            </div>
    <?php else: ?>
    <h1>El producto no existe</h1>
    
<?php endif; ?>