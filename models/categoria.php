<?php
 include 'config/db.php';
class Categoria{
    private $id;
    private $nombre;
    private $db;

    public function __construct(){
        $this->db = DataBase::connect();
    }


    //Setters y getters
    function setId($id){
        $this->id = $id;
    }
    function getId(){
        return $this->id;
    }
  
    function setNombre($nombre){
        $this->nombre = $this->db->real_escape_string($nombre);
    }
    function getNombre(){
        return $this->nombre;
    }

    public function getCategorias(){
        $categorias = $this->db->query("SELECT * FROM categorias ORDER BY id DESC;");
        return $categorias;
    }

    public function getOne(){
        $categoria = $this->db->query("SELECT * FROM categorias WHERE id={$this->getId()};");
        return $categoria->fetch_object();
    }
    public function save(){
        
        $sql = "INSERT INTO categorias  VALUES(NULL,'{$this->getNombre()}' ) ;";
       $save = $this->db->query($sql);

       $result = false;
       if($save){
           $result = true;
       }
       return $result;

    }
}    