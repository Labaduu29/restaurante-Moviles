<?php
	include_once '../Model/MasterModel.php';
	class PerfilController{
		private $objModel;
		public function __construct(){
			$this->objModel=new MasterModel();
		}
		public function index(){			
			$perf=$this->objModel->consultar("*","perfil","perf_estado='Activo'" );
				
			include_once '../View/Perfil/index.php';
		}			

		public function getInsertar(){
			
			$perf_id=$this->objModel->autoIncrement("perf_id","perfil");
			include_once '../view/perfil/insertar.php';
		}
		public function postInsertar(){
			extract($_POST);

			$perf=$this->objModel->insertar("perfil",
			"perf_descripcion,perf_estado",
			"'$perf_descripcion', '$perf_estado'");
			
			redirect(getUrl("Perfil","Perfil","index"));
		}
		public function getModificar(){
			$id=$_GET['id'];
			$perf=$this->objModel->consultar("*", "perfil", "perf_id='$id'");
			

			include_once '../view/Perfil/modificar.php';
		}
		public function postModificar(){
			extract($_POST);
			
			 
			 $perf=$this->objModel->editar("perfil",
			 "perf_id='$perf_id'",
			 array("perf_descripcion"=>"'".$perf_descripcion."'",
					"perf_estado"=>"'".$perf_estado."'")
			 );
			redirect(getUrl("Perfil","Perfil","index"));
		}
		public function getEliminar(){
			$id=$_GET['id'];
			$perf=$this->objModel->consultar("*", "perfil", "perf_id='$id'");
			include_once '../view/perfil/eliminar.php';
			
		}
		public function postEliminar(){
			extract($_POST);
			
			$perf=$this->objModel->editar("perfil",
			"perf_id='$perf_id'",
			array("perf_estado"=>"'InActivo'")
			);
		  redirect(getUrl("Perfil","Perfil","index"));	
		}
	}
?>