<div class="modal-header">
        <h5 class="modal-title">Iniciar Sesión</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
</div>

<div class="modal-body">
		<form name="frm_iniciar_sesion" method="POST" action="#">
			<div style="margin-bottom: 25px" class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
				<input id="login-username" type="text" class="form-control" name="username" placeholder="Usuario">                                        
			</div>
					
			<div style="margin-bottom: 25px" class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
				<input id="login-password" type="password" class="form-control" name="usupassword" placeholder="Contraseña">
			</div>						


			<div style="margin-top:10px" class="form-group">
				<!-- Button -->
				<div class="col-sm-12 controls">							 
				  <button type="submit"class="btn btn-primary btn-lg btn-block" >Ingresar</button>
				</div>
			</div>


			<div class="form-group">
				<div class="col-md-12 control">
						<div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
								No tienes un Usuario! 
							<a href="../Web/ajax.php?modulo=Session&controlador=Session&funcion=crearUsuario">
									Registrate Aquí
							</a>
								<br>
							<a href="../Web/recover.php">
									Olvidaste tu Usuario?
							</a>
						</div>
				</div>
			</div>    				
		</form>
</div>

<div class="modal-footer">
	<button type="button" class="btn btn-primary">Ingresar</button>
	<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
</div>