<?php 

include_once "Comentario.php";
include_once "Usuario.php";
include_once "archivos.php";

$comentario = $_POST['comentario'];
$titulo = $_POST['titulo'];
$mailRecibido = $_POST["mail"];

$coment = new Comentario ($mailRecibido, $titulo, $comentario);

$lista = Usuario::TraerListaUsuarios();

foreach ($lista as $usuario) 
{

    if($usuario->getMail() === $mailRecibido)
     {
        Archivo::Subir();
         echo "Mails son iguales";
         var_dump($coment);
        Comentario::Guardar($coment);
        break;
     }    
    
}

?>