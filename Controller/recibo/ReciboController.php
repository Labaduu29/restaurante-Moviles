<?php
	include_once '../Model/MasterModel.php';
	class ReciboController{
		private $objModel;
		public function __construct(){
			//$this->objModel=new MasterModel();
		}

		public function index(){				
			$Recibos=[]; //$this->objModel->consultar("*", "recibo_caja natural join cliente", "rc_estado='Activo'", " order by rc_fecha");			
			include_once '../View/Recibo/index.php';
		}		
		
		public function getInsertar(){
			$num_doc= ""; //$this->objModel->autoIncrement("rc_num", "recibo_caja");
			/*$platos=$this->objModel->consultar("*", "plato", "est_id='8'", " order by pla_descripcion");
			$clientes=$this->objModel->consultar("cli_id, concat(cli_nombre, ' ',cli_apellidos) as nombre_cli", "cliente", "cli_estado='Activo'", " order by nombre_cli");*/
			include_once '../View/recibo/insertar.php';
		}
	
	}
?>