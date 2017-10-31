<?php


class MWparaAutentificar
{
 /**
   * @api {any} /MWparaAutenticar/  Verificar Usuario
   * @apiVersion 0.1.0
   * @apiName VerificarUsuario
   * @apiGroup MIDDLEWARE
   * @apiDescription  Por medio de este MiddleWare verifico las credeciales antes de ingresar al correspondiente metodo 
   *
   * @apiParam {ServerRequestInterface} request  El objeto REQUEST.
 * @apiParam {ResponseInterface} response El objeto RESPONSE.
 * @apiParam {Callable} next  The next middleware callable.
   *
   * @apiExample Como usarlo:
   *    ->add(\MWparaAutenticar::class . ':VerificarUsuario')
   */
	public function VerificarUsuario($request, $response, $next) {
         
		  if($request->isGet())
		  {
				 $response->getBody()->write('<p>NO necesita credenciales para los get </p>');
				  //$ippp = ip2long($_SERVER["REMOTE_ADDR"]);
					$ippp = $_SERVER["REMOTE_ADDR"];
					//var_dump($ippp);
					$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
					//var_dump($objetoAccesoDato);
					$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into Ips (ip) values('$ippp')");
					//var_dump($consulta);
					$consulta->execute();
					//var_dump($_SERVER["REMOTE_ADDR"]);
		     $response = $next($request, $response);
		  }
		  else
		  {
		    $response->getBody()->write('<p>verifico credenciales</p>');
		    $ArrayDeParametros = $request->getParsedBody();
		    $nombre=$ArrayDeParametros['nombre'];
				$tipo=$ArrayDeParametros['tipo'];
				$contrasena=$ArrayDeParametros['contrasena'];
				$usuariosExistentes = TraerTodoLosUsuarios();
				$tipoAux;
				foreach ($usuariosExistentes as $value) {
					if($value['nombre'] == $nombre && $value['contrasena'] == $contrasena)
					{
							$tipoAux = $value['tipo'];
					}
				}


		    if($tipoAux=="administrador")
		    {
		      $response->getBody()->write("<h3>Bienvenido $nombre </h3>");
		      $response = $next($request, $response);
		    }
		    else
		    {
		      $response->getBody()->write('<p>no tenes habilitado el ingreso</p>');
		    }  
		  }
		  $response->getBody()->write('<p>vuelvo del verificador de credenciales</p>');
		  return $response;   
	}


	public static function TraerTodoLosUsuarios()
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select nombre, contrasena, tipo from usuarios");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_ASSOC);		
	}

}