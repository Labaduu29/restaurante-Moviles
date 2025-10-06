
<?php $cliente = mysqli_fetch_object($clientes);?>
<section class="hero-section">
<div class="container">
	<div class="section-title">
		<h2>Modificar Cliente</h2>
	</div>
	<div class="row">											
		<form method="post" action="<?php echo getUrl("Cliente","Cliente","postModificar"); ?>">
		<div class="form-group">
			<div class="col-md-1 col-lg-1 col-xs-1">
            <label > N°</label>
                    </div>	
                    <div class="col-md-2 col-lg-2 col-xs-2">
                        <input readonly type="text" class="form-control" name="cli_id" value=" <?php echo $cliente->cli_id; ?>">
                    </div>	
                    <div class="col-md-1 col-lg-1 col-xs-1">
                        <label>Nombre(s)</label>
                    </div>
                    <div class="col-md-3 col-lg-3 col-xs-3">
                        <input type="text" class="form-control" name="cli_nombre" value= "<?php echo $cliente->cli_nombre; ?>">
                    </div>
                    <div class="col-md-1 col-lg-1 col-xs-1">
                        <label> Apellido(s) </label>
                    </div>
                    <div class="col-md-3 col-lg-3 col-xs-3">
                        <input type="text" class="form-control" name="cli_apellidos"value= "<?php echo $cliente->cli_apellidos; ?>" >
                    </div>
                </div>
            </div>
            

            <div class="row">
                <div class="form-group">
                
                    <div class="col-md-1 col-lg-1 col-xs-1 form-group">
                            <label> Tel&eacute;fono </label>
                    </div>
                    <div class="col-md-2 col-lg-2 col-xs-2">
                        <input type="text" class="form-control" name="cli_telefono" value= "<?php echo $cliente->cli_telefono; ?>" >
                    </div>
                    
                    <div class="col-md-1 col-lg-1 col-xs-1">
                        <label> Direcci&oacute;n </label>
                    </div>
                    <div class="col-md-3 col-lg-3 col-xs-3">
                        <input type="text" class="form-control" name="cli_direccion" value= "<?php echo $cliente->cli_direccion; ?>">
                    </div>
                    <div class="col-md-1 col-lg-1 col-xs-1">
                        <label> Correo </label>
                    </div>
                    <div class="col-md-3 col-lg-3 col-xs-3">
                        <input type="text" class="form-control" name="cli_correo" value= "<?php echo $cliente->cli_correo; ?>">
                    </div>
                    
			</div>
		</div>
			<br>
			<div class="form">
				<div class="col-md-3 col-lg-3 col-xs-3">
					<button class="btn btn-primary" type="submit">Guardar</button>
					<a class='btn btn-default' href="<?php echo getUrl("Cliente","Cliente","index"); ?>">Cancelar</a> 
				</div>
			</div>
		</form><br><br><br>											
		</div>
	</div>
</section>






