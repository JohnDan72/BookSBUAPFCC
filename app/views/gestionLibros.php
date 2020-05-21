<?php include "templates/header.php";?>
<!--Aqui va todo el css adicional de cada vista-->
<link rel="stylesheet" href="<?= $BASE_PATH;?>public/css/gestionLibros.css">
<!--Aquí escribe el título de la página actual-->
<title>Gestion de Libros</title>
<script src="<?= $BASE_PATH;?>public/js/indexJS.js"></script>
<?php include "templates/navbar.php";?>
<?php
	if (!isset($_SESSION['userdata']) || $_SESSION['userdata']['Tipo']==0) {
		header("Location: index.php");
		exit();
	}

	//Recuperación de libros subidos
	require("../models/libroModel.php");
	$modelLibro = new LibroModel();
	$misLibros = $modelLibro->getMyBooks($_SESSION['userdata']['Id']);
?>

<div class="parallax-container valign-wrapper">
	<div class="parallax">
		<img class="responsive-img" src="../../public/img/fondoGestion.jpg">
	</div>
	<div id="imgParallax2" class="row center grey-text text-lighten-4  grey darken-1">
  	<h5>Gestiona tus libros subidos</h5>
  </div>
</div>

<div class="container white" id="containerRedondo">
	<div class="row center grey-text text-darken-2">
		<div class="col s12">
			<h4>Gestión de Libros</h4>
		</div>
		<div class="col s12 subheader">
			Comprueba que la información de tus libros este actualizada, realiza cualquier cambio que desees.
		</div>
	</div>
	<?php
		if (isset($_REQUEST['response']) && is_numeric($_REQUEST['response'])) {
			switch ($_REQUEST['response']) {
				case '-1':
					?>
						<div class="row center red-text text-darken-1">
							<h5>Ocurrió un error inesperado, inténtelo de nuevo más tarde</h5>
						</div>
					<?php
					break;
				case '0':
					?>
						<div class="row center  orange-text text-darken-2">
							<h5>Información sin cambios</h5>
						</div>
					<?php
					break;
				case '1':
					?>
						<div class="row center blue-text text-darken-1">
							<h5>Información actualizada correctamente</h5>
						</div>
					<?php
					break;
			}
		}
	?>
	

	<div class="row center"><div class="col s8 offset-s2 divider"></div></div>
	<div class="row">
		<?php
			if ($misLibros) {
				?>
					<table class="col s12 m10 offset-m1 responsive-table centered striped">
			    		<thead>
			    			<tr>
				    			<th>Título</th>
				    			<th>Área</th>
				    			<th>Descripción</th>
				    			<th>Precio sugerido</th>
				    			<th>Estado libro</th>
				    			<th>Subido el</th>
				    			<th>Imagen</th>
				    			<th>Opción</th>
			    			</tr>
			    			
			    		</thead>
			    		<tbody>
			    			<?php
			    			$rutaPDF = "../../public/files/pdfs/comprobante_libro_";
			    			$formato = ".pdf";
			    				foreach ($misLibros as $libroSub) {
			    					?>
			    					<tr>
					    				<td><?= $libroSub['Titulo']?></td>
					    				<td><?= $libroSub['Area']?></td>
					    				<td><?= $libroSub['Descripcion']?></td>
					    				<td><?= "$".$libroSub['Precio']?></td>
					    				<td><?= $libroSub['Edo_Libro']?></td>
					    				<td><?= $libroSub['Fecha_Subido']?></td>
					    				<td>
					    					<img class="materialboxed" src="../../public/img/imgLibros/<?= $libroSub['Imagen']?>" width="100px">
					    				</td>
					    				<td>
					    					<a class="waves-effect waves-light btn-flat blue lighten-1 grey-text text-lighten-5" href="actualizarLibro.php?libro=<?= $libroSub['Id'];?>">Actualizar</a>
					    				</td>
					    			</tr>
			    					<?php
			    				}
			    			?>
			    			
			    		</tbody>
			    	</table>
				<?php
			}
			else{
				?>
				<div class="row center">
					<img src="https://image.flaticon.com/icons/svg/2909/2909934.svg" width="300px">
				</div>
				<div class="row center grey-text text-darken-2">
					<h6>Aqí apareceran los libros que haz subido y no haz vendido para poder actualizar su información. Puedes subir nuevos libros...</h6>
				</div>
				<div class="row center">
					<a class="waves-effect waves-light btn-flat blue lighten-1 grey-text text-lighten-5" href="subirLibro.php">¡Aqui!</a>
				</div>
				<?php
			}
		?>
	</div>
</div>





<?php include "templates/footer.php";?>
<!--Aquí va todo el javascript que quieras incluir-->
<script type="text/javascript">

</script>
<?php include "templates/end.php";?>