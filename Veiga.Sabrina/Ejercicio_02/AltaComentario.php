<?php 

include_once "Comentario.php";
include_once "Usuario.php";

$comentario = $_POST['comentario'];
$titulo = $_POST['titulo'];
$mailRecibido = $_POST["mail"];

$coment = new Comentario ($mailRecibido, $titulo, $comentario);

$lista = Usuario::TraerListaUsuarios();
var_dump($lista);
var_dump($mailRecibido);
foreach ($lista as $usuario) 
{

    if($usuario->getMail() === $mailRecibido)
     {
         
         echo "Mails son iguales";
         var_dump($coment);
        Comentario::Guardar($coment);
        break;
     }    
    
}

?>