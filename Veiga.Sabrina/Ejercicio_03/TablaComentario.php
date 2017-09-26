
<?php 
//5- (2pt.) TablaComentarios.php, puede recibir datos del comentario como el usuario, el titulo o nada para hacer
//una busqueda, y retornará una tabla con: (la imagen del comentario, el titulo , la edad del usuario y el nombre )
////6- (2pts.) UsuarioModificacion.php: (por POST)se ingresarán todos los valores necesarios (incluida una imagen)
//para realizar los cambios en los datos de cualquier usuario usuario.

 
include_once "Comentario.php";
include_once "Usuario.php";

$comentario ="";
$titulo = "";
$mailRecibido ="";
$recibido = FALSE;
$origen;
$ArrayDeComentario = Comentario::TraerListaDeComentario();
$ArrayUsuario =  Usuario::TraerListaUsuarios();

if(isset($_POST['comentario']))
{
    $comentario = $_POST['comentario'];
}

if(isset($_POST['titulo']))
{
    $titulo = $_POST['titulo'];
    echo $titulo;
}

if(isset($_POST["mail"]))
{
    $mailRecibido = $_POST["mail"];
}



for ($i=0; $i < count($ArrayDeComentario) ; $i++) 
{ 
    
    if($ArrayDeComentario[$i]->getMail() == $mailRecibido || $ArrayDeComentario[$i]->getTitulo() == $titulo || $ArrayDeComentario[$i]->getComentario() == $comentario)
    {
        $archivo = $ArrayDeComentario[$i]->getTitulo(). ".jpg";
        $origen = "./ImagenesDeComentario//" . $archivo;
        $titulo = $ArrayDeComentario[$i]->getTitulo();
        $comentario = $ArrayDeComentario[$i]->getComentario();
        $mailRecibido = $ArrayDeComentario[$i]->getMail();
       
        $recibido = TRUE;
        break;
    }
        
    
}

    if($recibido == TRUE)
    {

        $grilla = '<table class="table">
                    <thead style="background:rgb(14, 26, 112);color:#fff;">
                        <tr>
                            <th>  USUARIO </th>
                            <th>  TITULO </th>
                            <th>  COMENTARIO   </th>
                            <th>  NOMBRE   </th>
                            <th>  EDAD   </th>
                        </tr>  
                    </thead>';   	

        foreach ($ArrayUsuario as $us)
        {
            if($mailRecibido == $us->getMail())
            {
                $grilla .= "<tr>
                            <td>".$us->getMail()."</td>
                            <td>".$titulo."</td>
                            <td>".$comentario."</td>
                            <td>".$us->getNombre()."</td>
                            <td>".$us->getEdad()."</td>
                            <td><img src= '". $origen ."' width='100px' height='100px'/></td>
                        </tr>";	
            }
                
        }
        $grilla .= '</table>';		
    } 
    else
    {
        $grilla = '<table class="table">
        <thead style="background:rgb(14, 26, 112);color:#fff;">
            <tr>
                <th>  USUARIO </th>
                <th>  TITULO </th>
                <th>  COMENTARIO   </th>
                <th>  NOMBRE   </th>
                <th>  EDAD   </th>
            </tr>  
        </thead>';   	

    
        foreach ($ArrayUsuario as $us)
        {
            foreach($ArrayDeComentario as $coment)
            {
                
                    $archivo = $coment->getTitulo(). ".jpg";
                    $origen = "./ImagenesDeComentario/" . $archivo;
                    $grilla .= "<tr>
                                <td>".$us->getMail()."</td>
                                <td>".$coment->getTitulo()."</td>
                                <td>".$coment->getComentario()."</td>
                                <td>".$us->getNombre()." -- $origen</td>
                                <td>".$us->getEdad()."</td>
                                <td><img src= '". $origen ."' width='100px' height='100px'/></td>
                            </tr>";	
                
            }
        }
                
                    
    

        $grilla .= '</table>';	

    } 
    
    echo $grilla;
    
	
?>