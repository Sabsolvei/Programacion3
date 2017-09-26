<?php 
	//require_once ("Producto.php");


	class Archivo {

		public static function Subir(){

			$retorno["Exito"] = TRUE;
			
			$tipoArchivo = pathinfo($_FILES["archivo"]["name"], PATHINFO_EXTENSION);

			if ($_FILES["archivo"]["size"] > 5000000) 
			{
				$retorno["Exito"] = FALSE;
				$retorno["Mensaje"] = "El archivo es demasiado grande. Verifique!!";
				return $retorno;
			}

			$esImagen = getimagesize($_FILES["archivo"]["tmp_name"]);

			if($esImagen === FALSE) {//NO ES UNA IMAGEN
				$retorno["Exito"] = FALSE;
				$retorno["Mensaje"] = "S&oacute;lo son permitidas IMAGENES.";
				return $retorno;
			}
			else {// ES UNA IMAGEN

				if($tipoArchivo != "jpg" && $tipoArchivo != "jpeg" && $tipoArchivo != "gif" && $tipoArchivo != "png") 
				{
					$retorno["Exito"] = FALSE;
					$retorno["Mensaje"] = "S&oacute;lo son permitidas imagenes con extensi&oacute;n JPG, JPEG, PNG o GIF.";
					return $retorno;
				}
			}

			//$archivoTmp = date("Ymd_His") . ".jpg";
			$archivo = $_POST["titulo"]. ".jpg";
			$destino = "ImagenesDeComentario/" . $archivo;
			if (!move_uploaded_file($_FILES["archivo"]["tmp_name"], $destino)) 
			{
				$retorno["Exito"] = FALSE;
				$retorno["Mensaje"] = "Ocurrio un error al subir el archivo. No pudo guardarse.";
				return $retorno;
			}
			else
			{
				$retorno["Mensaje"] = "Archivo subido exitosamente!!!"; 
				$retorno["PathTemporal"] = $destino;
				
				return $retorno;
			}
		}
		
	
		
		
	}

?>