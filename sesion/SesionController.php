<?php
include_once '../Model/MasterModel.php';
class SesionController{
	private $objModel;
	public function __construct(){
		//$this->objModel=new MasterModel();
	}
	public function validarUsuario(){										
		$login=$_POST['username'];
		$pass=$_POST['usupassword'];
		
										
		/*$usuario=$this->objModel->consultar("usu_id, concat(usu_nombre, ' ', usu_apellido) as nombre, perf_id", 
							"usuario", 
							"usu_login='$login'
								and usu_pass='$pass'
								and usu_estado='Activo'");			   
	   
		if($usuario->num_rows > 0)
		{
            foreach($usuario as $usu){}
			$_SESSION['usu_id']=$usu['usu_id'];
			$_SESSION['usu_nombre']=$usu['nombre'];
			$_SESSION['usu_perfil']=$usu['perf_id'];
            $_SESSION['auth']="Autorizado";
		    redirect('index.php');
								
		}
		else
		{
			echo"<script>alert('Usuario No Valido');</script>";
			 redirect('page.php');
		}*/
		$_SESSION['usu_id']= "123";
		$_SESSION['usu_nombre']="Admin";
		$_SESSION['usu_perfil']=1;
		$_SESSION['auth']="Autorizado";
		 redirect('index.php');
	}

	public function CerrarSesion()
    {        
        @session_start();
        @session_destroy();			
        redirect('page.php');    
    }
	
	public function recuperar()
	{
		$correo=$_POST['usu_correo'];
		//$ObjUser= new MasterModel();
		$clave=  rand(9999, 9999999);
	   // $clave=  sha1(md5($str));

	   //$objModel->Actualizar("update usuario set usu_pass='$clave' where usu_correo='$correo'");
		
		 $message="De acuerdo a la solicitud de recuperacion de clave "
					. "la nueva informacion de acceso a su cuenta es: \n\r \n\r"                       
					. "clave: $str \n\r \n\r "
					. "Esperamos haber atentido su solicitud de la mejor manera \n\r \n\r ";                    
		//mail($correo, "Nueva clave para su Usuario", $message);
		//$ObjUser->closeConect();
		redirect("page.php");
	}


}
?>