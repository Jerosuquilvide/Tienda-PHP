<h1>Algunos de nuestros productos</h1>
<?php while($pro = $productos->fetch_object() ): ?>

    <div class="productos">
        <a href="<?=base_url?>productos/ver&id<?=$pro->id?>">
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


        