<?php
	include_once '../Model/MasterModel.php';
	class EstadoController{
		private $objModel;
		public function __construct(){
			//$this->objModel=new MasterModel();
		}
		public function index(){			
			$est=""; /*$this->objModel->consultar("e.*,te.*,te.tes_descripcion", "estado e,tipo_estado te ",
				" e.tes_id=te.tes_id and est_estado='Activo'","order by est_id");*/
				
			include_once '../View/Estado/index.php';
		}			

		public function getInsertar(){
			/*$est_id=$this->objModel->autoIncrement("est_id","estado");
			$tes=$this->objModel->consultar("*", 
			"tipo_estado");*/

			include_once '../view/estado/insertar.php';
		}
		public function postInsertar(){
			extract($_POST);

			$est=$this->objModel->insertar("estado",
			"est_descripcion, tes_id,est_estado",
			"'$est_descripcion', '$tes_id','Activo'");
			
			redirect(getUrl("Estado","Estado","index"));
		}
		public function getModificar(){
			$id=$_GET['id'];
			$est=$this->objModel->consultar("*", "estado", "est_id='$id'");
			$tes=$this->objModel->consultar("*", "tipo_estado", "", "tes_descripcion");

			include_once '../view/Estado/modificar.php';
		}
		public function postModificar(){
			extract($_POST);
			
			 $est=$this->objModel->editar("estado",
			 "est_id='$est_id'",
			 array("est_descripcion"=>"'".$est_descripcion."'",
					"tes_id"=>"'".$tes_id."'",
					"est_estado"=>"'".$est_estado."'")
			 );
			redirect(getUrl("Estado","Estado","index"));
		}
		public function getEliminar(){
			$id=$_GET['id'];
			$est=$this->objModel->consultar("*", "estado", "est_id='$id'");
			include_once '../view/Estado/eliminar.php';
			
		}
		public function postEliminar(){
			extract($_POST);
			
			 $est=$this->objModel->editar("estado",
			 "est_id='$est_id'",
			 array("est_estado"=>"'InActivo'")
			 );
			redirect(getUrl("Estado","Estado","index"));
		}
	}
?>