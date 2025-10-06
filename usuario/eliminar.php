
<?php $cliente = mysqli_fetch_object($clientes);?>
<section class="hero-section">
<div class="container">
	<div class="section-title">
		<h2>Eliminar Cliente</h2>
	</div>
	<div class="row">											
		<form method="post" action="<?php echo getUrl("Cliente","Cliente","postEliminar"); ?>">
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
                        <input readonly type="text" class="form-control" name="cli_nombre" value= "<?php echo $cliente->cli_nombre; ?>">
                    </div>  
			</div>
		</div>
			<br>
			<div class="form">
            <div class="col-md-7 col-lg-7 col-xs-7" style="text-align:center">
					<button class="btn btn-primary" type="submit">Eliminar</button>
					<a class='btn btn-default' href="<?php echo getUrl("Cliente","Cliente","index"); ?>">Cancelar</a> 
				</div>
			</div>
		</form><br><br><br>											
		</div>
	</div>
</section>






