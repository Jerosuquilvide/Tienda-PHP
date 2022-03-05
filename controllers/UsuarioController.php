<?php
require_once 'models/usuario.php';
class UsuarioController{
    public function index(){
        echo "Usuario Controller";
    }

    public function registro(){
        require_once 'views/usuario/registro.php';
    }

    public function save(){
       if(isset($_POST)){
           $nombre = isset($_POST['Nombre']) ? $_POST['Nombre'] : false;
           $apellido =  isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
           $email =  isset($_POST['email']) ? $_POST['email'] : false;
           $password =  isset($_POST['password']) ? $_POST['password'] : false;
           if($nombre && $apellido && $email && $password){
           $usuario = new Usuario();
           $usuario->setNombre($nombre);
           $usuario->setApellido($apellido);
           $usuario->setEmail($email);
           $usuario->setPassword($password);
            $save = $usuario->save();
            if($save){
                $_SESSION['register'] = "complete";
            }else{
                $_SESSION['register'] = "failed";
            }
        }else{
            $_SESSION['register'] = "failed";
        }
           #var_dump($usuario);
       }else{
        $_SESSION['register'] = "failed";
       }
       header("Location:".base_url.'usuario/registro');
    }

    public function login(){
        if(isset($_POST)){
            $usuario = new Usuario();
            $usuario->setEmail($_POST['email']);
            $usuario->setPassword($_POST['password']);

            $id = $usuario->login();
            
            if($id && is_object($id)){
                    $_SESSION['id'] = $id;

                    if($id->rol == 'admin'){
                        $_SESSION['admin'] = true;
                    }
            }else{
                $_SESSION['error_login'] = "Identificacion erronea !!";
            }

        }
        header("Location:".base_url);
    }

    public function logout(){
        if(isset($_SESSION['id'])){
            unset($_SESSION['id']);
        }

        if(isset($_SESSION['admin'])){
            unset($_SESSION['admin']);
        }
        header("Location:".base_url);
    }

}