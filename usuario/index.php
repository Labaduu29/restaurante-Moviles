<section class="hero-section">
	<div class="hero-slider owl-carousel">
	
		<div class="container">
		
			<div class="row">
				<div class="col-md-9 col-xs-3 section-title">
					<h2>Usuario</h2>						
				</div>
				<br>
				<div class="col-md-3 col-xs-3"><a href="<?php echo getUrl("usuario","usuario","getInsertar");?>">
						<button type="submit" class="btn btn-success">Crear un Nuevo Usuario </button></a>
				</div>
			</div>
				
	  
			<table class="table table-bordered text-center tables ">
				<thead>
					<tr>
					  <th class="text-center">ID</th>
					  <th class="text-center">Nombre</th>
					  <th class="text-center">Apellidos</th>
					  <th class="text-center">Direcci&oacute;n</th>
					  <th class="text-center">Tel&eacute;fono</th>
					  <th class="text-center">Correo</th>
					  <th class="text-center">Perfil</th>
					  <th class="text-center">Editar</th>
					  <th class="text-center">Eliminar</th>     

					</tr>
				</thead>
				  <tbody>
				  <?php
								foreach($usuarios as $usuario){
									echo"<tr >";
									echo"<td>". ($usuario['usu_id']) . "</td>";
									echo"<td>". UTF8_encode($usuario['usu_nombre']) . "</td>";
									echo"<td>". UTF8_encode($usuario['usu_apellido']) . "</td>";
									echo"<td>". UTF8_encode($usuario['usu_direccion']) . "</td>";
									echo"<td>". ($usuario['usu_telefono']) . "</td>";
									echo"<td>". ($usuario['usu_correo']) . "</td>";
									echo"<td>". ($usuario['perf_descripcion']) . "</td>";
									echo"<td>";

									echo"<div class='icon-reorder tooltips' data-original-title='Modificar' data-placement='bottom'>
							       <a class='btn btn-warning' href='". getUrl("usuario","usuario","getModificar",array("id"=>$usuario['usu_id']))."'><i class='fa fa-edit'></i></a>
							      </div></td>";
									echo"<td>";
									echo"<div class='icon-reorder tooltips' data-original-title='Eliminar' data-placement='bottom'>
									  <a class='btn btn-danger' href='". getUrl("usuario","usuario","getEliminar",array("id"=>$usuario['usu_id']))."'><i class='fa fa-trash-o'></i></a>
									</div></td>";
									echo "</tr>";
								}
							?>
				  </tbody>
			</table>

			</div>
		
	</div>
</section>
