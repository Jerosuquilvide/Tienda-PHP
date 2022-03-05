<?php
require_once 'models/categoria.php';
require_once 'models/producto.php';
class CategoriaController{
    public function index(){
        Utils::isAdmin();
        $categoria = new Categoria();
        $categorias = $categoria->getCategorias();
        require_once 'views/categorias/index.php';


    }

    public function crear(){
        Utils::isAdmin();

        require_once 'views/categorias/crear.php';
    }

    public function ver(){
            if(isset($_GET['id'])){
               $id = ($_GET['id']);
            //Conseguir la categoria
            $categoria = new Categoria();
            $categoria->setId($id);
            $categoria = $categoria->getOne();
            
            //Conseguir el producto
            $producto = new Producto();
            $producto->setCategoriaID($id);
            $productos = $producto->getAllCategory();
            }
        require_once 'views/categorias/ver.php';
    }

    public function save(){
        Utils::isAdmin();

        //Guardar la categoria en la db
        if(isset($_POST) && isset($_POST['nombre'])){
            $categoria = new Categoria();
            $categoria->setNombre($_POST['nombre']);
            $save = $categoria->save();

        }

        
        header("Location:".base_url."categoria/index");
    }
}