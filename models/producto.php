<?php
 
class Producto{
    private $id;
    private $nombre;
    private $categoria_id;
    private $descripcion;
    private $precio;
    private $stock;
    private $oferta;
    private $fecha;
    private $imagen;
    private $db;

    public function __construct(){
        $this->db = DataBase::connect();
    }

    //Setters y Getters
    function setId($id){ $this->id = $id; }
    function getId(){ return $this->id; }

    function setNombre($nombre){
        $this->nombre = $this->db->real_escape_string($nombre);
    }
    function getNombre(){ return $this->nombre; }

    function setCategoriaID($categoria_id){ $this->categoria_id = $categoria_id; }

    function getCategoriaID(){ return $this->categoria_id; }
    
    function setDescripcion($descripcion){ $this->descripcion = $this->db->real_escape_string($descripcion); }

    function getDescripcion(){ return $this->descripcion; }

    function setPrecio($precio){ $this->precio = $this->db->real_escape_string($precio); }

    function getPrecio(){ return $this->precio; }

    function setStock($stock){ $this->stock = $this->db->real_escape_string($stock); }

    function getStock(){ return $this->stock; }
    
    function setOferta($oferta){ $this->oferta = $this->db->real_escape_string($oferta) ;}

    function getOferta(){ return $this->oferta; }

    function setFecha($fecha){ $this->fecha = $fecha; }

    function getFecha(){ return $this->fecha; }
     
    function setImagen($imagen){ $this->imagen = $imagen; } 

    function getImagen(){ return $this->imagen; }
 
    public function getAll(){
        $productos = $this->db->query("SELECT * FROM productos ORDER BY id DESC ;");
        return $productos;
    }

    public function getAllCategory(){
      $sql = "SELECT p.*, c.nombre AS 'catnombre' FROM productos p "
				. "INNER JOIN categorias c ON c.id = p.categoria_id "
				. "WHERE p.categoria_id = {$this->getCategoriaID() } "
				. "ORDER BY id DESC";
        $productos = $this->db->query($sql);
        return $productos;
    }

    public function getRandom($limit){
        $productos = $this->db->query("SELECT * FROM productos ORDER BY RAND() LIMIT $limit ;" );
        return $productos;
    }

    public function getOne(){
        $producto = $this->db->query("SELECT * FROM productos WHERE id = {$this->getId()} ");
        return $producto->fetch_object();
    }


    public function save(){
        $sql = "INSERT INTO productos  VALUES(NULL,{$this->getCategoriaID()} ,'{$this->getNombre()}', '{$this->getDescripcion()}'
         ,{$this->getPrecio()},{$this->getStock()}, null , CURDATE(), '{$this->getImagen()}');";
        $save = $this->db->query($sql);
    
        $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }

    public function edit(){
        $sql = "UPDATE productos  SET  nombre='{$this->getNombre()}', descripcion='{$this->getDescripcion()}'
         , precio={$this->getPrecio()}, stock={$this->getStock()},categoria_id={$this->getCategoriaID()} ";
         if($this->getImagen() != NULL){
            $sql .=", imagen='{$this->getImagen()}' ";
         }

        $sql .= "WHERE id={$this->id}; ";
       
        $save = $this->db->query($sql);
       
        $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }

    public function delete(){
        $sql = "DELETE FROM productos WHERE id={$this->id}";

        $delete = $this->db->query($sql);
        $result = false;
        if($delete){
            $result = true;
        }
        return $result;
    }
}