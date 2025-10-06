<section class="hero-section">
		<div class="hero-slider owl-carousel">
		
				<div class="container">
					<div class="section-title">
						<h2>Lista Solicitudes Pendientes</h2>
					</div>
					<div class="bd-example">
																			
						<table class="table table-bordered tables">
							<thead>
								<tr>
									<th class="text-center">No Pedido</th>
									<th class="text-center">No Mesa</th>
									<th>Plato</th>									
									<th>Observaciones</th>
									<th class="text-center">Estado</th>
									<th ></th>
								</tr>
							</thead>

							<tbody>
							<?php 
							if(isset($pedidos)){
								foreach($pedidos as $pedido){
								echo'<tr>
									<td class="text-center">'.$pedido['ped_id'].'</td>
									<td class="text-center">'.$pedido['ped_mesa'].'</td>
									<td>'.$pedido['pla_descripcion'].'</td>
									<td>'.$pedido['ped_det_obser'].'</td>
									<td class="text-center">'.$pedido['est_descripcion'].'</td>
									<td class="text-center"><button class="btn btn-primary">Ok</button></td>';
							}
							}
							
							
							?>
							</tbody>
						</table>
															
					</div>
				</div>
			
		</div>
	</section>