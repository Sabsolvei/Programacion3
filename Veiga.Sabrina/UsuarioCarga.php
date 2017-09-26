<?php 
include_once "Usuario.php";

$usuario = new Usuario($_GET['nombre'], $_GET["mail"] , $_GET["perfil"], $_GET["edad"] , $_GET["clave"]);
if(Usuario::Guardar($usuario))
{
    echo "Usuario guardado en archivo";
}



?>