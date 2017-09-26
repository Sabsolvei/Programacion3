<?php 

	class Usuario
	{

		private $_nombre;
		private $_mail;
		private $_perfil;
        private $_edad;
        private $_clave;

		public function __construct($nombre, $mail, $perfil, $edad, $clave)
		{
			$this->_nombre = $nombre;
			$this->_mail = $mail;
			$this->_perfil = $perfil;
            $this->_edad = $edad;
            $this->_clave = $clave;
		}

		public function getNombre()
		{
			return $this->_nombre;
		}

		public function getMail()
		{
			return $this->_mail;
		}

		public function getPerfil()
		{
			return $this->_perfil;
		}

		public function getEdad()
		{
			return $this->_edad;
        }
        
        public function getClave()
		{
			return $this->_clave;
		}

		public function __toString()
		{
			$string = $this->_nombre . " - " . $this->_mail . " - " . $this->_perfil . " - " . $this->_edad . " - "  . $this->_clave;
			return $string;
		}

		public static function Guardar($obj)
		{
			$resultado = FALSE;
			$ar = fopen("Usuarios.txt", "a");
			$cant = fwrite($ar, $obj->__toString(). "\r\n");
			if($cant > 0)
			{
				$resultado = TRUE;			
			}
			fclose($ar);
			return $resultado;
		}

		public static function TraerListaUsuarios()
		{
			
			$ListaDeUsuarios = array();
			//leo todos los productos del archivo
			$archivo=fopen("Usuarios.txt", "r");
			
			while(!feof($archivo))
			{
				if($archAux = fgets($archivo))
				{
					$Usuarios = explode(" - ", $archAux);
					$Usuarios[0] = trim($Usuarios[0]);
					$Usuarios[1] = trim($Usuarios[1]);
					$Usuarios[2] = trim($Usuarios[2]);
                    $Usuarios[3] = trim($Usuarios[3]);
                    $Usuarios[4] = trim($Usuarios[4]);
					if($Usuarios[0] != "")
					{				
						$ListaDeUsuarios[] = (new Usuario($Usuarios[0], $Usuarios[1],$Usuarios[2],$Usuarios[3],$Usuarios[4]));
                    }
        
				}
			} 
			fclose($archivo);
		
			return $ListaDeUsuarios;
		}
	}

?>