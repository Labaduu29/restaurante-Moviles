<?php
	include_once '../Model/MasterModel.php';
	class usuarioController{
		private $objModel;
		public function __construct(){
			$this->objModel=new MasterModel();
		}
		public function index(){			
			$usuarios=$this->objModel->consultar("*", "usuario natural join perfil", " usu_estado='Activo'");
		
			include_once '../View/usuario/index.php';
		}			

		public function getInsertar(){
					
			include_once '../view/usuario/insertar.php';
		}
		public function postInsertar(){
			extract($_POST);

			$cli=$this->objModel->insertar("cliente",
			"cli_nombre,cli_apellidos ,cli_direccion,cli_telefono, cli_correo, cli_estado",
			"'$cli_nombre', '$cli_apellidos','$cli_direccion','$cli_telefono', '$cli_correo','Activo'");
			
			redirect(getUrl("usuario","usuario","index"));
		}
		public function getModificar(){
			$id=$_GET['id'];
			$clientes=$this->objModel->consultar("*", "usuario", "cli_id='$id'");
			include_once '../view/usuario/modificar.php';
		}
		public function postModificar(){
			extract($_POST);
			
			 $cli=$this->objModel->editar("cliente",
			 "cli_id='$cli_id'",
			 array("cli_nombre"=>"'".$cli_nombre."'",
					"cli_apellidos"=>"'".$cli_apellidos."'",
					"cli_direccion"=>"'".$cli_direccion."'",
                                        "cli_correo"=>"'".$cli_correo."'",
					"cli_telefono"=>"'".$cli_telefono."'")
			 );
			
			redirect(getUrl("usuario","usuario","index"));
		}
		public function getEliminar(){
			$id=$_GET['id'];
			$clientes=$this->objModel->consultar("*", "cliente", "cli_id='$id'");
			
			include_once '../view/cliente/eliminar.php';

			
		}
		public function postEliminar(){
			extract($_POST);
			
			 $clientes=$this->objModel->editar("cliente",
			 "cli_id='$cli_id'",
			 array("cli_estado"=>"'InActivo'")
			 );
			redirect(getUrl("Cliente","Cliente","index"));
		}
	}
?>