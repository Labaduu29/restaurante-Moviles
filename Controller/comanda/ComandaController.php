<?php
	include_once '../Model/MasterModel.php';
	class ComandaController{
		private $objModel;
		public function __construct(){
			//$this->objModel=new MasterModel();
		}

		public function index(){			
			/*$pedidos=$this->objModel->consultar("*", "pedido as p, pedido_detalle as pd, plato, estado",
								" pd.ped_id=p.ped_id and pd.pla_id=plato.pla_id and pd.est_id=1
										and p.est_id=estado.est_id and pd.est_id=1");	*/		
			include_once '../View/comanda/index.php';
		}			
		
	}
?>