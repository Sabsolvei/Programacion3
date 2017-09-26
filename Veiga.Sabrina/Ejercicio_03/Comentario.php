<?php 

	class Comentario
	{
		private $_mail;
		private $_titulo;
        private $_comentario;
		
		public function __construct($mail, $titulo, $comentario)
		{
			$this->_titulo = $titulo;
			$this->_mail = $mail;
			$this->_comentario = $comentario;
			//$this->_path = $path;

		}

		public function getTitulo()
		{
			return $this->_titulo;
		}

		public function getMail()
		{
			return $this->_mail;
		}

		public function getComentario()
		{
			return $this->_comentario;
		}



		public function __toString()
		{
			$string = $this->_mail . " - " . $this->_titulo . " - " . $this->_comentario;
			return $string;
		}

		public static function Guardar($obj)
		{
			$resultado = FALSE;
			$ar = fopen("Comentario.txt", "a");
			$cant = fwrite($ar, $obj->__toString(). "\r\n");
			if($cant > 0)
			{
				$resultado = TRUE;			
			}
			fclose($ar);
			return $resultado;
		}

		public static function TraerListaDeComentario()
		{
			
			$ListaDeComentarios = array();

			$archivo=fopen("Comentario.txt", "r");
			
			while(!feof($archivo))
			{
				if($archAux = fgets($archivo))
				{
					$comentario = explode(" - ", $archAux);
					$comentario[0] = trim($comentario[0]);
					$comentario[1] = trim($comentario[1]);
					$comentario[2] = trim($comentario[2]);
   
					if($comentario[0] != "")
					{				
						$ListaDeComentarios[] = new Comentario($comentario[0], $comentario[1],$comentario[2]);
                    }
        
				}
			} 
			fclose($archivo);
		
			return $ListaDeComentarios;
		}
	}

?>