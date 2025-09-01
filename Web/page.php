<?php include_once "../Lib/helpers.php";?>
<!DOCTYPE html>
<html lang="en">
<?php include_once "../view/Partials/head.php";?>
<body>
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>

	<!-- Header section -->
	<?php include_once "../View/Partials/header.php";?>
	<!-- Header section end -->

	<!-- Recipes section -->
	<?php 	include_once "../View/Partials/slider_principal.php";	
		include_once "../View/Partials/dashboard.php"; ?>
	<!-- Recipes section end -->


	<?php include_once "../View/Partials/footer.php"; ?>
	
	<!-- Footer section  -->
	
</body>
</html>


<div class="modal" tabindex="-1" role="dialog" id="Iniciar_Sesion">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			
		
			<div class="modal-header">
				<h5 class="modal-title">Iniciar Sesión</h5>				
			</div>
			<form name="frm_iniciar_sesion" method="POST" action="ajax.php?modulo=Sesion&controlador=Sesion&funcion=validarUsuario">
				<div class="modal-body">				
					<div style="margin-bottom: 25px" class="input-group">
						<span class="input-group-addon"><i class="fa fa-user"></i></span>
						<input id="login-username" type="text" class="form-control" name="username" placeholder="Usuario">                                        
					</div>
							
					<div style="margin-bottom: 25px" class="input-group">
						<span class="input-group-addon"><i class="fa fa-lock"></i></span>
						<input id="login-password" type="password" class="form-control" name="usupassword" placeholder="Contraseña">
					</div>						
			
					<div class="form-group">
						<div class="col-md-12 control">
								<div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
										No tienes un Usuario! 
									<a href="ajax.php?modulo=Session&controlador=Session&funcion=crearUsuario">
											Registrate Aquí
									</a>
										<br>
									<a href="recover.php">
											Olvidaste tu Usuario?
									</a>
								</div>
						</div>
					</div>    				
				
				</div>

				<div class="modal-footer">
					<button type="submit" class="btn btn-danger">Ingresar</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				</div>
			</form>
		</div>
	</div>
</div>