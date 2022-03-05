<?php
require_once 'models/pedido.php';
class PedidosController{
    public function hacer(){
        

        require_once 'views/pedidos/hacer.php';
    }

    public function add(){
        if(isset($_SESSION['id'])){
            $usuario_id = $_SESSION['id']->id;
            $provincia = isset($_POST['provincia']) ? $_POST['provincia'] : false;
            $localidad = isset($_POST['localidad']) ? $_POST['localidad'] : false;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;

            $stats = Utils::statsCarrito();
            $coste = $stats['total'];
            //Guardar en la base de datos
            if($provincia && $localidad && $direccion){
                $pedido = new Pedido();
                $pedido->setUsuarioID($usuario_id);
                $pedido->setProvincia($provincia);
                $pedido->setLocalidad($localidad);
                $pedido->setDireccion($direccion);
                $pedido->setCoste($coste);
                $save = $pedido->save();

                //Guardo linea de pedido
                $save_linea = $pedido->save_linea();
                if($save && $save_linea){
                    $_SESSION['pedido'] = "complete";
                }else{
                    $_SESSION['pedido'] = " failed ";
                }
            }else{
                $_SESSION['pedido'] = " failed ";
            }
           header("Location:".base_url.'pedidos/confirmado');
        }else{
            header("Location:".base_url);
        }
    }

    public function confirmado(){

        if(isset($_SESSION['id'])){
            $id = $_SESSION['id'];
            $pedido = new Pedido();
            $pedido->setUsuarioID($id->id);
            $pedido = $pedido->getOneByUser();

            $pedido_producto = new Pedido();
            $productos = $pedido_producto->getProductosByPedidos($pedido->id);
            
        }

        require_once 'views/pedidos/confirmado.php';
    }

    public function mis_pedidos(){
        Utils::isIdentity();

         $usuario_id = $_SESSION['id']->id;
         $pedido = new Pedido();

         //Sacar todos los pedidos del usuario
         $pedido->setUsuarioID($usuario_id);
         $pedidos = $pedido->getByUser();  
        require_once 'views/pedidos/mis_pedidos.php';
    }

    public function detalle(){
        Utils::isIdentity();
        if(isset($_GET['id'])){

            $id = $_GET['id'];

            //Sacar el pedido
            $pedido = new Pedido();
            $pedido->setId($id);
            $pedido = $pedido->getOne();

            //Sacar los productos
            $pedidos_productos = new Pedido();
            $productos = $pedidos_productos->getProductosByPedidos($id);
            

            require_once 'views/pedidos/detalle.php';
        }else{
            header("Location:".base_url."pedidos/mis_pedidos");
        }
    }

    public function gestion(){
        Utils::isAdmin();
        $gestion = true;

        $pedido = new Pedido();
        $pedidos = $pedido->getAll();
        require_once 'views/pedidos/mis_pedidos.php';
    }

    public function estado(){
        Utils::isAdmin();
        if(isset($_POST['pedido_id']) && isset($_POST['estado'])){
            //Agarrar los datos de la url
            $id = $_POST['pedido_id'];
            $estado = $_POST['estado'];

            //Actualizar el pedido
            $pedido = new Pedido();
            $pedido->setId($id);
            $pedido->setEstado($estado);
            $pedido->edit();
            header("Location:".base_url.'pedidos/detalle&id='.$id);
        }else{
            header("Location:".base_url);
        }
    }
}