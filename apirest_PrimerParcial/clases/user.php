<?php 

class user

{
	public $id;
	public $nombre;
	public $mail;
	public $password;
	public $sexo;


  //ALTA USUARIO
	 public function InsertarUser()
	 {
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into personas (nombre,mail,sexo,password)values('$this->nombre','$this->mail','$this->sexo','$this->password')");
				$consulta->execute();
				return $objetoAccesoDato->RetornarUltimoIdInsertado();
				

	 }
  //BAJA USUARIO
 	public function BorrarUser()
	 {
	 		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				delete 
				from personas				
				WHERE id=:id");	
				$consulta->bindValue(':id',$this->id, PDO::PARAM_INT);		
				$consulta->execute();
				return $consulta->rowCount();
	 }

  //MODIFICA USUARIO
	public function ModificarUser()
	 {

			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				update personas 
				set nombre='$this->nombre',
				 mail='$this->mail',
				sexo='$this->sexo',
				password='$this->password'
				WHERE id='$this->id'");
			return $consulta->execute();

	 }
	


  //TRAE TODOS LOS USUARIO
  	public static function TraerTodoLosUser()
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id,nombre,mail,sexo,password from personas ");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "user");		
	}
  //TRAE UN  USUARIO
	public static function TraerUnUser($id) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id,nombre,mail,sexo,password from personas where id = $id");
			$consulta->execute();
			$unuser= $consulta->fetchObject('user');
			return $unuser;				

			
	}

	

}




 ?>