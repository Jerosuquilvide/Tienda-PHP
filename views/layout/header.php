<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta charset= "utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda PHP</title>
    <script src="https://kit.fontawesome.com/84b9aa9a7e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?=@base_url?>assets/css/styles.css">
</head>
<body>
<div id="container">
    <!--Head-->
    <header id="header">
        <div id="logo">
            <img src="<?=base_url?>assets/image/camiseta.png">
            <a href="<?=base_url?>">
                Tienda de PHP
            </a>
        </div>
    </header>
    <!--Menu-->
    <?php $categorias =  Utils::showCategorias() ; ?>
    <nav id="menu">
            <ul>
                <li><a href="<?=base_url?>">Inicio</a></li>
                <?php while($cat = $categorias->fetch_object()) : ?>
                    <li>
                        <a href="<?=base_url?>categoria/ver&id=<?=$cat->id?>"><?= $cat->nombre ; ?></a>
                    </li>
                <?php endwhile ; ?>
            </ul>
    </nav>
    
    <div id="contenido">