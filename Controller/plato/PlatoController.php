<?php
	include_once '../Model/MasterModel.php';
	class PlatoController{
		private $objModel;
		public function __construct(){
			//$this->objModel=new MasterModel();
		}
		public function index(){			
			$pla=$this->objModel->consultar("p.*,e.*,e.est_descripcion", "plato p,estado e ","e.est_id=p.est_id and (p.est_id='7' or p.est_id='8')");
				
			include_once '../View/Plato/index.php';
		}			

		public function getInsertar(){
			$pla_id=""; //$this->objModel->autoIncrement("pla_id","plato");
			$pla=""; //$this->objModel->consultar("*", "plato");
			$es= ""; //$this->objModel->consultar("*","estado");

			include_once '../view/plato/insertar.php';
		}
		public function postInsertar(){
			extract($_POST);

			$pla=$this->objModel->insertar("plato",
			"pla_descripcion,pla_precio,est_id",
			"'$pla_descripcion', '$pla_precio','$est_id'");
			
			redirect(getUrl("Plato","Plato","index"));
		}
		public function getModificar(){
			$id=$_GET['id'];
			$pla=$this->objModel->consultar("*", "plato", "pla_id='$id'");
			$es=$this->objModel->consultar("*", 
			"estado");
			include_once '../view/plato/modificar.php';
		}
		public function postModificar(){
			extract($_POST);
			
			 $pla=$this->objModel->editar("plato",
			 "pla_id='$pla_id'",
			 array("pla_descripcion"=>"'".$pla_descripcion."'",
					"pla_precio"=>"'".$pla_precio."'",
					"est_id"=>"'".$est_id."'")
			 );
			redirect(getUrl("Plato","Plato","index"));
		}
		public function getEliminar(){
			$id=$_GET['id'];
			$pla=$this->objModel->consultar("*", "plato", "pla_id='$id'");
			$es=$this->objModel->consultar("*", 
			"estado");
			include_once '../view/plato/Eliminar.php';
			
		}
		public function postEliminar(){
				extract($_POST);
			$pla=$this->objModel->editar("Plato",
			"pla_id='$pla_id'",
			array("est_id"=>"'9'")
			);
		  redirect(getUrl("Plato","Plato","index"));	
		}
	}
?>