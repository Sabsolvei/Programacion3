<?php 

include_once "Usuario.php";

$claveRecibida = $_POST['clave'];
$mailRecibido = $_POST["mail"];

$lista = Usuario::TraerListaUsuarios();

foreach ($lista as $Usuario) {
    if($Usuario->getMail() == $mailRecibido)
     {
            if($Usuario->getClave() == $claveRecibida)
            {
                echo "BIENVENIDO";
                break;
            }
            else{
                echo "LA CLAVE ES INCORRECTA";
                break;
            }
     }
     else
     {
         echo "El usuario no existe";
         break;
     }
    
}

?>