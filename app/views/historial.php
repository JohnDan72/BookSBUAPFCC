<?php include "templates/header.php";?>
<!--Aqui va todo el css adicional de cada vista-->
<link rel="stylesheet" href="<?= $BASE_PATH;?>public/css/historial.css">
<!--Aquí escribe el título de la página actual-->
<title>Historial</title>
<script src="<?= $BASE_PATH;?>public/js/indexJS.js"></script>
<?php include "templates/navbar.php";?>
<?php
	if (!isset($_SESSION['userdata'])) {
		header("Location: index.php");
		exit();
	}

	//Recuperación de Actividad
	require("../models/historyModel.php");	//model
	$modelH = new HistoryModel();			//instancia de modelo
	if ($_SESSION['userdata']['Tipo'] == 0) { //solo recupera libros comprados
		$librosComprados = $modelH->getLibrosComprados($_SESSION['userdata']['Id']);
	}
	else{ // recupera libros subidos, vendidos, comprados
		$librosComprados 	= $modelH->getLibrosComprados($_SESSION['userdata']['Id']);
		$librosSubidos 		= $modelH->getLibrosSubidos($_SESSION['userdata']['Id']);
		$librosVendidos 	= $modelH->getLibrosVendidos($_SESSION['userdata']['Id']);
	}


?>

<div class="parallax-container valign-wrapper">
	<div class="parallax">
		<img src="http://www.hdfondos.eu/pictures/2012/1108/1/orig_518230.jpg">
	</div>
	<div id="imgParallax2" class="row center grey-text text-lighten-4  grey darken-1">
  	<h5>Mi Historial</h5>
  </div>
</div>

<div class="container">
	<div class="row center grey-text text-darken-2">
		<div class="col s12"><h4>Registro de Actividad</h4></div>
		<div class="col s12 subheader">Puedes revisar toda actividad hecha en tu cuenta</div>
	</div>
	<div class="row">
		<?php
			if ($_SESSION['userdata']['Tipo'] == 0) {
				?>
					<div class="col s12">
				      <ul class="tabs">
				        <li class="tab col s12 m4 l4 offset-m4 offset-l4">
				        	<a href="#test1">Libros comprados</a>
				        </li>
				      </ul>
				    </div>


				    <div id="test1" class="col s12">
				    	<?php
				    		if ($librosComprados) {
				    			?>
				    				<table class="responsive-table centered striped">
							    		<thead>
							    			<tr>
							    				<th>Id libro</th>
								    			<th>Título</th>
								    			<th>Área</th>
								    			<th>Precio</th>
								    			<th>Estado libro</th>
								    			<th>Vendido por</th>
								    			<th>Correo Vendedor</th>
								    			<th>Fecha</th>
								    			<th>Imagen</th>
								    			<th>Comprobante</th>
							    			</tr>
							    			
							    		</thead>
							    		<tbody>
							    			<?php
							    			$rutaPDF = "../../public/files/pdfs/comprobante_libro_";
							    			$formato = ".pdf";
							    				foreach ($librosComprados as $libroComp) {
							    					?>
							    					<tr>
									    				<td><?= $libroComp['Id_Libro']?></td>
									    				<td><?= $libroComp['Titulo']?></td>
									    				<td><?= $libroComp['Area']?></td>
									    				<td><?= $libroComp['Precio']?></td>
									    				<td><?= $libroComp['Edo_Libro']?></td>
									    				<td><?= $libroComp['Nom_Vend']?></td>
									    				<td><?= $libroComp['Cor_Vend']?></td>
									    				<td><?= $libroComp['Fecha_Hora']?></td>
									    				<td>
									    					<img src="../../public/img/imgLibros/<?= $libroComp['Imagen']?>" width="100px">
									    				</td>
									    				<td>
									    					<a target="_blank" class="waves-effect waves-light btn-flat blue lighten-1 grey-text text-lighten-5" href="<?= $rutaPDF.$libroComp['Id_Libro'].$formato;?>">Abrir</a>
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
				    					<img src="https://image.flaticon.com/icons/svg/1680/1680012.svg" width="300px">
				    				</div>
				    				<div class="row center grey-text text-darken-2">
				    					<h6>Aun no haz hecho algún pedido. Busca un libro de tu interés y pídelo.</h6>
				    				</div>
				    				<div class="row center">
				    					<a class="waves-effect waves-light btn-flat blue lighten-1 grey-text text-lighten-5" href="libros.php">¡Aqui!</a>
				    				</div>
				    			<?php
				    		}
				    	?>
				    	
				    </div>
				<?php
			}
			else{
				?>
					<div class="col s12">
				      <ul class="tabs">
				        <li class="tab col s4">
				        	<a href="#test1">Libros comprados</a>
				        </li>
				        <li class="tab col s4">
				        	<a href="#test2">Libros subidos</a>
				        </li>
				        <li class="tab col s4">
				        	<a href="#test3">Libros vendidos</a>
				        </li>
				      </ul>
				    </div>

				    <div id="test1" class="col s12">
				    	<?php
				    		if ($librosComprados) {
				    			?>
				    				<table class="responsive-table centered striped">
							    		<thead>
							    			<tr>
							    				<th>Id libro</th>
								    			<th>Título</th>
								    			<th>Área</th>
								    			<th>Precio</th>
								    			<th>Estado libro</th>
								    			<th>Vendido por</th>
								    			<th>Correo Vendedor</th>
								    			<th>Fecha</th>
								    			<th>Imagen</th>
								    			<th>Comprobante</th>
							    			</tr>
							    			
							    		</thead>
							    		<tbody>
							    			<?php
							    			$rutaPDF = "../../public/files/pdfs/comprobante_libro_";
							    			$formato = ".pdf";
							    				foreach ($librosComprados as $libroComp) {
							    					?>
							    					<tr>
									    				<td><?= $libroComp['Id_Libro']?></td>
									    				<td><?= $libroComp['Titulo']?></td>
									    				<td><?= $libroComp['Area']?></td>
									    				<td><?= "$".$libroComp['Precio']?></td>
									    				<td><?= $libroComp['Edo_Libro']?></td>
									    				<td><?= $libroComp['Nom_Vend']?></td>
									    				<td><?= $libroComp['Cor_Vend']?></td>
									    				<td><?= $libroComp['Fecha_Hora']?></td>
									    				<td>
									    					<img src="../../public/img/imgLibros/<?= $libroComp['Imagen']?>" width="100px">
									    				</td>
									    				<td>
									    					<a target="_blank" class="waves-effect waves-light btn-flat blue lighten-1 grey-text text-lighten-5" href="<?= $rutaPDF.$libroComp['Id_Libro'].$formato;?>">Abrir</a>
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
				    					<img src="https://image.flaticon.com/icons/svg/1680/1680012.svg" width="300px">
				    				</div>
				    				<div class="row center grey-text text-darken-2">
				    					<h6>Aún no haz hecho algún pedido. Busca un libro de tu interés y pídelo.</h6>
				    				</div>
				    				<div class="row center">
				    					<a class="waves-effect waves-light btn-flat blue lighten-1 grey-text text-lighten-5" href="libros.php">¡Aqui!</a>
				    				</div>
				    			<?php
				    		}
				    	?>
				    </div>
				    <div id="test2" class="col s12">
				    	<?php
				    		if ($librosSubidos) {
				    			?>
				    				<table class="responsive-table centered striped">
							    		<thead>
							    			<tr>
							    				<th>Id libro</th>
								    			<th>Título</th>
								    			<th>Área</th>
								    			<th>Descripción</th>
								    			<th>Precio sugerido</th>
								    			<th>Estado libro</th>
								    			<th>Subido el</th>
								    			<th>Imagen</th>
							    			</tr>
							    			
							    		</thead>
							    		<tbody>
							    			<?php
							    			$rutaPDF = "../../public/files/pdfs/comprobante_libro_";
							    			$formato = ".pdf";
							    				foreach ($librosSubidos as $libroSub) {
							    					?>
							    					<tr>
									    				<td><?= $libroSub['Id']?></td>
									    				<td><?= $libroSub['Titulo']?></td>
									    				<td><?= $libroSub['Area']?></td>
									    				<td><?= $libroSub['Descripcion']?></td>
									    				<td><?= "$".$libroSub['Precio']?></td>
									    				<td><?= $libroSub['Edo_Libro']?></td>
									    				<td><?= $libroSub['Fecha_Subido']?></td>
									    				<td>
									    					<img src="../../public/img/imgLibros/<?= $libroSub['Imagen']?>" width="100px">
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
				    					<img src="https://image.flaticon.com/icons/svg/1680/1680012.svg" width="300px">
				    				</div>
				    				<div class="row center grey-text text-darken-2">
				    					<h6>Aún no haz subido algún libro. Hazlo</h6>
				    				</div>
				    				<div class="row center">
				    					<a class="waves-effect waves-light btn-flat blue lighten-1 grey-text text-lighten-5" href="subirLibro.php">¡Aqui!</a>
				    				</div>
				    			<?php
				    		}
				    	?>
				    </div>
				    <div id="test3" class="col s12">
				    	<?php
				    		if ($librosVendidos) {
				    			?>
				    				<table class="responsive-table centered striped">
							    		<thead>
							    			<tr>
							    				<th>Id libro</th>
								    			<th>Título</th>
								    			<th>Área</th>
								    			<th>Precio</th>
								    			<th>Estado libro</th>
								    			<th>Vendido a</th>
								    			<th>Correo Cliente</th>
								    			<th>Fecha</th>
								    			<th>Imagen</th>
								    			<th>Comprobante</th>
							    			</tr>
							    			
							    		</thead>
							    		<tbody>
							    			<?php
							    			$rutaPDF = "../../public/files/pdfs/comprobante_libro_";
							    			$formato = ".pdf";
							    				foreach ($librosVendidos as $libroVend) {
							    					?>
							    					<tr>
									    				<td><?= $libroVend['Id_Libro']?></td>
									    				<td><?= $libroVend['Titulo']?></td>
									    				<td><?= $libroVend['Area']?></td>
									    				<td><?= "$".$libroVend['Precio']?></td>
									    				<td><?= $libroVend['Edo_Libro']?></td>
									    				<td><?= $libroVend['Nom_Client']?></td>
									    				<td><?= $libroVend['Cor_Client']?></td>
									    				<td><?= $libroVend['Fecha_Hora']?></td>
									    				<td>
									    					<img src="../../public/img/imgLibros/<?= $libroVend['Imagen']?>" width="100px">
									    				</td>
									    				<td>
									    					<a target="_blank" class="waves-effect waves-light btn-flat blue lighten-1 grey-text text-lighten-5" href="<?= $rutaPDF.$libroVend['Id_Libro'].$formato;?>">Abrir</a>
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
				    					<img src="https://image.flaticon.com/icons/svg/1680/1680012.svg" width="300px">
				    				</div>
				    				<div class="row center grey-text text-darken-2">
				    					<h6>Aún no haz vendido algún libro. Sube más libros para promocionarlos.</h6>
				    				</div>
				    				<div class="row center">
				    					<a class="waves-effect waves-light btn-flat blue lighten-1 grey-text text-lighten-5" href="subirLibro.php">¡Aqui!</a>
				    				</div>
				    			<?php
				    		}
				    	?>
				    </div>


				<?php
			}
		?>
	    
	</div>
</div>




<?php include "templates/footer.php";?>
<!--Aquí va todo el javascript que quieras incluir-->
<script type="text/javascript">
	$(document).ready(function(){
	    $('.tabs').tabs();
	  });
</script>
<?php include "templates/end.php";?>