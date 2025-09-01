<?php 
include_once('../Lib/helpers.php');
include_once'../View/Partials/Head.php';
 
?>
<br>
<br>
<div class="main">  
    <div class="main-inner">
        <div class="container">  
            <div class="row">
                <div class="span12">                      
                    <div class="widget ">
                        <center>  
                          <div class="widget-header">
                            <i class="icon-edit"></i>
                            <h3>Recuperar Contraseña</h3>
                          </div> <!-- /widget-header -->
                        </center>
                        <div class="widget-content">                                          
            
                            <div class="tab-content">
                                <div class="tab-pane active" id="formcontrols">
                                    <form  class="sky-form boxed" method="post" action="ajax.php?modulo=Session&controlador=Session&funcion=recuperar">					                                
                                        <fieldset>                      
                                            <div class="control-group">                     
                                              <label class="control-label">Correo</label>
                                              <div class="controls">
                                                <input type="text"  required class="span4" name="usu_correo">
                                              </div> <!-- /controls -->       
                                            </div> <!-- /control-group -->
                                            <center>                  
                                                <div class="form-actions">
                                                  <button type="submit" class="btn btn-primary">Recuperar</button> 
                                                  <a href="index.php"><button class="btn btn-success" type="button">Cancelar</button></a>
                                                </div>
                                            </center>
					</fieldset>				
				</form>
				<!-- /login form -->

				<hr />

			

			</div>

		</div>

		<!-- JAVASCRIPT FILES -->
		<script type="text/javascript">var plugin_path = 'Admin/Admin_BS3/assets/plugins/';</script>
		<script type="text/javascript" src="Admin/Admin_BS3/assets/plugins/jquery/jquery-2.2.3.min.js"></script>
		<script type="text/javascript" src="Admin/Admin_BS3/assets/js/app.js"></script>
	</body>
</html>