<?php
	include_once '../Model/MasterModel.php';
	class PedidoController{
		private $objModel;
		public function __construct(){
			//$this->objModel=new MasterModel();
		}

		public function index(){	
			$pedidos=$this->objModel->consultar("*", "pedido, estado", " pedido.est_id=estado.est_id and pedido.est_id='4'", " order by ped_fecha");
			$this->objModel->closeConnect();
			include_once '../View/Pedido/index.php';
		}			

		public function getInsertar(){
			$num_doc=""; //$this->objModel->autoIncrement("ped_id", "pedido");
			$platos= ""; //$this->objModel->consultar("*", "plato", "est_id='8'", " order by pla_descripcion");
			//$this->objModel->closeConnect();
			include_once '../View/Pedido/insertar.php';
		}
		public function postInsertar(){
			$usu_id=$_SESSION['usu_id'];	
			extract($_POST);
			$this->objModel->insertar("pedido", 
							"",
								"$num_doc, '$fecha', '$usu_id', '$mesa', 4");
			for($i=1; $i<count($plato); $i++){
				$this->objModel->insertar("pedido_detalle", 
							"",
								"'', ".$cantidad[$i].", ".$precio[$i].", '".$observa[$i]."', ".$plato[$i].",'$num_doc', 1");
			}
			$this->objModel->closeConnect();
			alertas("Registro Exitoso !!!");
			redirect(getUrl("Pedido", "Pedido", "getInsertar"));
			
		}

		public function ver(){
			$num_doc=$_GET['num_doc'];
			$cabecera=$this->objModel->consultar("*", 
								"pedido, estado", " pedido.est_id=estado.est_id and pedido.ped_id='$num_doc'");

			$detalle=$this->objModel->consultar("*", 
								"pedido_detalle, plato", " pedido_detalle.pla_id=plato.pla_id and ped_id='$num_doc'");
			$this->objModel->closeConnect();

			include_once '../View/Pedido/ver.php';			
		}

		public function getModificar(){
			
		}
		public function postModificar(){
			
		}
		public function getEliminar(){
			

			
		}
		public function postEliminar(){
			
		}
	}
?>