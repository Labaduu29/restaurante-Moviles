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
	<?php 
		if(isset($_SESSION['usu_perfil'])){
			if($_SESSION['usu_perfil']==1){ ;
				include_once "../View/Partials/header_admin.php";
			}
			else{ echo" es Aux";
				include_once "../View/Partials/header_aux.php";
			}
		}
		else{
			include_once "../View/Partials/header.php";
		}
		?>
	<!-- Header section end -->

	<!-- Recipes section -->
	<?php 	cargarPrincipal(); ?>
	<!-- Recipes section end -->


	<?php include_once "../View/Partials/footer.php"; ?>
	
	<!-- Footer section  -->
	
</body>
</html>


