<?php
 
class Pedido{
    private $id;
    private $provincia;
    private $usuario_id;
    private $localidad;
    private $direccion;
    private $coste;
    private $estado;
    private $fecha;
    private $hora;
    private $db;

    public function __construct(){
        $this->db = DataBase::connect();
    }

    //Setters y Getters
    function setId($id){ $this->id = $id; }
    function getId(){ return $this->id; }

    function setProvincia($provincia){
        $this->provincia = $this->db->real_escape_string($provincia);
    }
    function getProvincia(){ return $this->provincia; }

    function setUsuarioID($usuario_id){ $this->usuario_id = $usuario_id; }

    function getUsuarioID(){ return $this->usuario_id; }
    
    function setLocalidad($localidad){ $this->localidad = $this->db->real_escape_string($localidad); }

    function getLocalidad(){ return $this->localidad; }

    function setCoste($coste){ $this->coste = $this->db->real_escape_string($coste); }

    function getCoste(){ return $this->coste; }

    function setDireccion($direccion){ $this->direccion = $this->db->real_escape_string($direccion); }

    function getDireccion(){ return $this->direccion; }
    
    function setEstado($estado){ $this->estado = $this->db->real_escape_string($estado) ;}

    function getEstado(){ return $this->estado; }

    function setFecha($fecha){ $this->fecha = $fecha; }

    function getFecha(){ return $this->fecha; }
     
    function setHora($hora){ $this->hora = $hora; } 

    function getHora(){ return $this->hora; }
 
    public function getAll(){
        $productos = $this->db->query("SELECT * FROM pedidos ORDER BY id DESC ;");
        return $productos;
    }


    public function getOne(){
        $producto = $this->db->query("SELECT * FROM pedidos WHERE id = {$this->getId()} ");
        return $producto->fetch_object();
    }

    public function getOneByUser(){
        $sql = "SELECT p.id ,p.coste FROM pedidos p "
        //." INNER JOIN lineaspedidos lp ON lp.pedido = p.id "
        ." WHERE p.usuario_id = {$this->getUsuarioID()}  ORDER BY id DESC LIMIT 1  ;";
        $pedido = $this->db->query($sql);
        
        return $pedido->fetch_object();
    }

    public function getByUser(){
        $sql = "SELECT p .* FROM pedidos p "
        ." WHERE p.usuario_id = {$this->getUsuarioID()}  ORDER BY id DESC ;";
        $pedido = $this->db->query($sql);
        
        return $pedido;
    }


    public function getProductosByPedidos($id){
            //$sql = "SELECT * FROM productos WHERE id IN "
            //. " (SELECT producto_id FROM lineaspedidos WHERE pedido_id = {$id} ";


            $sql = "SELECT pr.* , lp.unidades FROM productos pr "
            ." INNER JOIN lineaspedidos lp ON pr.id = lp.producto_id "
            ." WHERE lp.pedido_id = {$id} ;" ;
            $productos = $this->db->query($sql);
        
            return $productos;
    }

    public function save(){
        $sql = "INSERT INTO pedidos  VALUES(NULL,{$this->getUsuarioID()} ,'{$this->getProvincia()}', '{$this->getLocalidad()}'
         ,'{$this->getDireccion()}',{$this->getCoste()}, 'confirm' , CURDATE(), CURTIME(),NULL);";

        $save = $this->db->query($sql);
        $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }

    
    public function save_linea(){
        $sql = "SELECT LAST_INSERT_ID() as 'pedido' ";

        $query = $this->db->query($sql);
        $pedido_id = $query->fetch_object()->pedido;
        
        foreach($_SESSION['carrito'] as $indice => $elemento){
            $producto =  $elemento['producto'];
            $insert = "INSERT INTO lineaspedidos VALUES(NULL, {$pedido_id}, {$producto->id},{$elemento['unidades']});";
            $save = $this->db->query($insert);
        }
        $result = false;
        if($save){
            $result = true;
        }
        return $result;   
    }
        public function edit(){
        $sql = "UPDATE pedidos  SET  estado='{$this->getEstado()}' ";
        $sql .= "WHERE id={$this->getId()}; ";
       
        $save = $this->db->query($sql);
       
        $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }

}