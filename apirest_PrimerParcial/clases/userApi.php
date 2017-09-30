<?php
require_once 'user.php';
require_once 'IApiUsable.php';

class userApi extends user implements IApiUsable
{

public function TraerUno($request,$response,$args)
{
	//Obtengo el Id por el cual filtramos
	$id=$args['id'];
	//utilizamos el metodo de la clase
	$user=user::TraerUnUser($id);
	//Desencripto Pass
	$user->password= base64_decode ($user->password);
	//si no encontro informamos que no existio y mandamos un 500 para detectar error
	if(!$user)
	{
		$obj= new stdclass();
		$obj->error= "el usuario no existe";
		$Respuesta=$response->withJson($obj,500);



	}
	else
	{
		//si encuentra lo devolvemos a travez del medotodo withJson del Response
		$Respuesta= $response->withJson($user,200);

	}
	return $Respuesta; 
}


public function TraerTodos($request,$response,$args)
{

	$todosLosUsers= user::TraerTodoLosUser();
	foreach ($todosLosUsers as  $user) {
		$user->password= base64_decode($user->password);
	}
	$Respuesta= $response->withJson($todosLosUsers,200);
	return $Respuesta;

}

public function CargarUno($request,$response,$args)
{
	//Creamos un objeto standard
	$obj= new stdclass();
	//con el metodo getparsedbody traemos todos los elementos que nos envian en el cuerpo del post
	$ArrayDeParametros=$request->getParsedBody();
	//var_dump(json_decode($ArrayDeParametros));
	//asignamos los valores a variables
	$nombre=$ArrayDeParametros['nombre'];
	$mail=$ArrayDeParametros['mail'];
	$sexo=$ArrayDeParametros['sexo'];
	$password=$ArrayDeParametros['password'];
	$password = base64_encode ($password);
	//generamos instancia de user
	$user = new user();
	//asignamos valores
	$user->nombre=$nombre;
	$user->mail=$mail;
	$user->sexo=$sexo;
	$user->password=$password;
	try{
		$user->InsertarUser();
		//nose para que sirve
		$archivos = $request->getUploadedFiles();
		//respuesta
		$obj->respuesta="Guardo el Usuario";
		//devolvemos obj respuesta y 200 de todo ok
		return $response->WithJson($obj,200);
	}
	 catch (Exception $e) {
	
		return $response->withJson($obj,401);
	}

}

Public function BorrarUno($request,$response,$args)
{
	//Objeto Standar
	$obj= new stdclass();
	//tomo parametro del body que recibo
	$ArrayDeParametros= $request->getParsedBody();
	//genero variable id
	$_id=$ArrayDeParametros['id'];
	//instancia user
	$user= new user();
	$user->id=$_id;
	//metodo que borra usuario y me devuelve >0 si borro
	$Borrados=$user->BorrarUser();
	$obj->cantidad=$Borrados;
	if($Borrados>0)
	{
	$obj->resultado="Eliminado";
	}
	else
	($obj->resultado="No Elimino Nada");
	//devuelvo respuesta y 200
	$Rta= $response->withJson($obj,200);
	return $Rta;

}



public function ModificarUno($request,$response,$args)
{
	$ArrayDeParametros = $request->getParsedBody();
	//var_dump($ArrayDeParametros);    	
	$miusuario = new user();
	$miusuario->id=$ArrayDeParametros['id'];
	$miusuario->nombre=$ArrayDeParametros['nombre'];
	$miusuario->mail=$ArrayDeParametros['mail'];
	$miusuario->sexo=$ArrayDeParametros['sexo'];
	$miusuario->password=$ArrayDeParametros['password'];

	   $resultado =$miusuario->ModificarUser();
	   $objDelaRespuesta= new stdclass();
	//var_dump($resultado);
	$objDelaRespuesta->resultado=$resultado;
	$objDelaRespuesta->tarea="modificar";
	return $response->withJson($objDelaRespuesta, 200);
	
}

}







  ?>