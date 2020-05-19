<?php include "templates/header.php";?>
<!--Aqui va todo el css adicional de cada vista-->
<link rel="stylesheet" href="<?= $BASE_PATH;?>public/css/libros.css">
<!--Aquí escribe el título de la página actual-->
<title>Libros</title>
<script src="<?= $BASE_PATH;?>public/js/indexJS.js"></script>
<?php include "templates/navbar.php";?>

<?php
	
	//METHOD POST PARA REALIZAR PEDIDO
	if (isset($_POST['enviarModal'])) {
		require("../models/historyModel.php");
		$modelH = new HistoryModel();
		if ($modelH->insertVenta($_POST)) {
			$infoVenta = $modelH->getInfoVenta($_POST['Id_Cliente'],$_POST['Id_Vendedor'],$_POST['Id_Libro']);
			if ($infoVenta) {
				$nombrePDF = $modelH->generarPDF($infoVenta);
			}
		}
		else
			echo "Error al insertar";
		//echo var_dump($_POST);
	}


	//METHOD GET PARA TODA LA GESTIÓN DE LA PAGINACIÓN
	include "../models/libroModel.php";
	//NUMERO DE FILTRO
	if (isset($_SESSION['filtro_actual'])) { //se checa que filtro se tiene
		$MIN_FILTRO = 1; $MAX_FILTRO = 8;
		if (isset($_POST['filtro']) && is_numeric($_POST['filtro']) && $_POST['filtro']>=$MIN_FILTRO && $_POST['filtro']<=$MAX_FILTRO) {
			//echo "Session: ".$_SESSION['filtro_actual'];
			$_SESSION['filtro_actual'] = $_POST['filtro'];
		}
		//else $_SESSION['filtro_actual'] = 1;
	}
	else $_SESSION['filtro_actual'] = 1;

	//NUMERO DE PÁGINA 
	if (isset($_GET['numPage'])) {
        $numPage = $_GET['numPage'];
        if (!(is_numeric($numPage))) //seguridad si se ingresa parámetro inválido
        	$numPage = 1;
    } else {
        $numPage = 1;
    }
    $no_of_records_per_page = 8;
    $offset = ($numPage-1) * $no_of_records_per_page;

    //Model Libro
    $modelLibro = new LibroModel();
    if (isset($_SESSION['userdata']))
    	$total_pages = $modelLibro->getTotalPages($no_of_records_per_page,$_SESSION['filtro_actual'],$_SESSION['userdata']['Id']);	//total de páginas de acuerdo a la info de la DB
    else
    	$total_pages = $modelLibro->getTotalPages($no_of_records_per_page,$_SESSION['filtro_actual'],0);	//total de páginas de acuerdo a la info de la DB
    
    if ($numPage>$total_pages) {$numPage = 1; $offset = ($numPage-1) * $no_of_records_per_page;} //seguridad si ocurre un error por url 	
    
    if (isset($_SESSION['userdata']))
    	$dataCurrentPage = $modelLibro->getDataCurrentPage($offset,$no_of_records_per_page,$_SESSION['filtro_actual'],$_SESSION['userdata']['Id']);	//se obtiene la información de la página actual
    else
    	$dataCurrentPage = $modelLibro->getDataCurrentPage($offset,$no_of_records_per_page,$_SESSION['filtro_actual'],0);	//se obtiene la información de la página actual
    

    //TAG DEL FILTRO ACTUAL
    $filtroTag = "";
    switch ($_SESSION['filtro_actual']) {
    	case '1':$filtroTag="Por Nombre";break;
    	case '2':$filtroTag="Libros de Computación";break;
    	case '3':$filtroTag="Libros de Física";break;
    	case '4':$filtroTag="Libros de Hardware";break;
    	case '5':$filtroTag="Libros de Matemáticas";break;
    	case '6':$filtroTag="Otros Libros";break;
    	case '7':$filtroTag="Del más barato al más caro";break;
    	case '8':$filtroTag="Nuestros libros vendidos";break;
    }
    
?>




<div class="parallax-container valign-wrapper">
  <div class="parallax"><img src="../../public/img/fondoLibros.jpg"></div>
  <div id="imgParallax2" class="row center grey-text text-lighten-4  grey darken-1">
  	<h5>Busca un libro perfecto para tí</h5>
  </div>
</div>

<?php
	if (isset($nombrePDF)) {
		?>
			<div class="container">
				<div class="row green-text text-darken-2 center">
					<h3>Pedido realizado con Éxito</h3>
					<div class="subheader">¡Excelente, tu pedido se ha realizado, puedes descargar el comprobante abajo!</div>
				</div>
				<div class="row divider"></div>
				<div class="row center">
					<img src="https://image.flaticon.com/icons/svg/2331/2331925.svg" width="300px">
				</div>
				<div class="row center">
					<a class="waves-effect waves-light btn-flat grey darken-2 grey-text text-lighten-5" href="libros.php">Seguir navegando</a>
					<a target="_blank" class="waves-effect waves-light btn-flat blue lighten-1 grey-text text-lighten-5" href="../../public/files/pdfs/<?=$nombrePDF?>">Abrir Comprobante</a>
				</div>
			</div>
		<?php
	}
	else{
		?>
			<div class="container">
				<div class="row grey-text text-darken-3 center">
					<h3>Nuestros Libros</h3>
					<div class="subheader">¡Encuentra el libro que tanto deseas y cómpralo ahora mismo!</div>
				</div>

				<div class="row" id="id_form_filtro">
					<div class="col s12 m8 l8 grey-text text-lighten-1"><h5><?= $filtroTag;?></h5></div>
					<div class="col s12 m4 l4 right">
						<div class="input-field col s12">
						    <form class="row" method="POST" action="libros.php">
						    	<div class="grey-text -textdarken-3">Filtrar por: </div>
						    	<select name="filtro" onchange="this.form.submit()">
						    		<option value="" disabled selected>Elige una opción</option>
						    		<option value="1">Nombre</option>
						    		<option value="2">Computación</option>
						    		<option value="3">Física</option>
						    		<option value="4">Hardware</option>
						    		<option value="5">Matemáticas</option>
						    		<option value="6">Otros</option>
						    		<option value="7">Precio</option>
						    		<option value="8">Vendidos</option>
							    </select>
						    </form>
						</div>
					</div>
				</div>

				<div class="row">
					<?php
						if ($dataCurrentPage) {
							foreach($dataCurrentPage as $libro){
								if (!$libro['Vendido'] && isset($_SESSION['userdata'])) {
									?>
										<!-- Creación de Modal para link "Comprar" -->
									    <div id="modal<?= $libro['Id']?>" class="modal modal-fixed-footer">
									    	<form method="POST" action="libros.php" onsubmit="return confirmaCompra();">
									    		<input type="hidden" name="Id_Libro"	value="<?= $libro['Id']?>">
									    		<input type="hidden" name="Id_Vendedor"	value="<?= $libro['Id_Vendedor']?>">
									    		<input type="hidden" name="Id_Cliente"	value="<?= $_SESSION['userdata']['Id']?>">

											    <div class="modal-content ">
										    		<div class="row">
										    			<div class="col s12 m4 l4" style="border-right: 1px solid #eeeeee;">
										    				<div class="row center">
										    					<img class="responsive-img materialboxed" src="../../public/img/imgLibros/<?= $libro['Imagen']?>">
										    				</div>
										    				<div class="row divider"></div>
										    				<div class="row center">
										    					<div class="container">
										    						<p align="justify" class="grey-text text-darken-4" style="font-size: 18px; font-weight: bold;">Acerca del Vendedor</p>
														    		<p align="justify"><?= "Nombre:      ".$libro['Nombre']." ".$libro['Ap_Paterno']?></p>
														    		<p align="justify"><?= "Correo:        ".$libro['Correo']?></p>
														    		<p align="justify"><?= "Teléfono: ".$libro['Telefono']?></p>
													    		</div>
										    				</div>
										    				<div class="row divider hide-on-med-and-up"></div>
										    			</div>
										    			<div class="col s12 m8 l8">
										    				<div class="container" >
										    					<div class="row center">
										    						<h4><?= $libro['Titulo']?></h4>
										    					</div>
										    					<div class="row divider"></div>
										    					<div class="row">
														    		<p align="justify" class="grey-text text-darken-4" style="font-size: 18px; font-weight: bold;">Información del libro</p>
														    		<p align="justify"><?= "Título:      ".$libro['Titulo']?></p>
														    		<p align="justify"><?= "Área:        ".$libro['Area']?></p>
														    		<p align="justify"><?= "Descripción: ".$libro['Descripcion']?></p>
														    		<p align="justify" class="blue-text text-lighten-1" style="font-size: 16px; font-weight: bold;"><?= "Estado:      ".$libro['Edo_Libro']?></p>
														    		<p align="justify" class="red-text text-lighten-1" style="font-size: 16px; font-weight: bold;"><?= "Precio:      $".$libro['Precio']?></p>
										    					</div>
										    					<div class="row divider"></div>
										    					<div class="row">
										    						<div class="s12 center"><h5>Pasos para realizar tu compra</h5></div>
										    						<div class="s12">
										    							<div class="row">
											    							<div class="s12 center">
											    								<p>1. Da clic en el "Realizar Pedido, esto generará un pdf que podras descargar e imprimir cuando quieras."</p>
											    								<img src="https://image.flaticon.com/icons/png/512/430/430535.png" height="80px">
											    							</div>
											    							<div class="s12 center">
											    								<p>2. Espera a que el vendedor se comunique conigo para definir el lugar y la hora de entrega del libro"</p>
											    								<img src="https://image.flaticon.com/icons/png/512/1033/1033949.png" height="80px">
											    							</div>
											    							<div class="s12 center">
											    								<p>3. Concluye la entrega y pago de tu libro en la reunión con el vendedor"</p>
											    								<img src="https://image.flaticon.com/icons/png/512/1006/1006657.png" height="80px">
											    							</div>
											    						</div>
										    						</div>
										    					</div>
										    				</div>
										    			</div>
										    		</div>
											    </div>
											    <div class="modal-footer">
											    	<div class="center">
											    		<a href="#!" class="modal-close waves-effect waves-light btn-flat grey darken-2 grey-text text-lighten-5">Cancelar</a>
										    			<button type="submit" name="enviarModal" class="modal-close waves-effect waves-light btn-flat blue darken-1 grey-text text-lighten-5">Realizar el Pedido</button>
											    	</div> 
											    </div>
										    </form>
									    </div>
									<?php
								}
							?>
							
							    <!--Despliegue de libros-->
								<div class="col s12 m6 l3">
									<div class="card medium sticky-action myHover">
									    <div class="card-image waves-effect waves-block waves-light" style="height: 200px;">
									      <img class="activator" src="../../public/img/imgLibros/<?= $libro['Imagen']?>">
									    </div>
									    <div class="card-content">
								          <span class="card-title activator grey-text text-darken-4">
								          		<?php
								          			echo $libro['Titulo'];
								          		?>
								          		<i class="material-icons right">more_vert</i>
								          </span>
								        </div>
									    <div class="card-action">
									      <!-- Modal Trigger -->
									      <div class="row">
									      	<div class="col s4 grey-text text-darken-3" style="font-size: 16px; font-weight: bold;">
									      		<?= "$".$libro['Precio']?>
									      	</div>
									      	<div class="col s8 right-align" style="font-size: 16px; font-weight: bold;">
									      		<?php
										      		if ($libro['Vendido']) {
										      			?>
										      				<div class="yellow-text text-darken-4 right">No disponible</div>
										      			<?php
										      		}
										      		else{
										      			if (isset($_SESSION['userdata'])) {
										      				?>
										      					<a class="modal-trigger light-blue-text text-accent-3" href="#modal<?= $libro['Id']?>">Comprar</a>
										      				<?php
										      			}
										      			else{
										      				?>
										      					<a class="light-blue-text text-accent-3" href="login.php">Comprar</a>
										      				<?php
										      			}
										      		}
										      	?>
									      	</div>
									      	
									      </div>
									      
									    </div>
									    <div class="card-reveal">
									    	<div class="row">
									    		<span class="card-title grey-text text-darken-4"><?= $libro['Titulo']?><i class="material-icons right">close</i></span>
									    	</div>
									    	<div class="row divider"></div>
									    	<div class="row">
									    		<span class="grey-text text-darken-4 s12">Información del libro:</span>
									    		<p><?= "Título:      ".$libro['Titulo']?></p>
									    		<p><?= "Área:        ".$libro['Area']?></p>
									    		<p><?= "Descripción: ".$libro['Descripcion']?></p>
									    		<p><?= "Estado:      ".$libro['Edo_Libro']?></p>
									    		<p class="red-text text-lighten-1" style="font-size: 16px; font-weight: bold;"><?= "Precio:      $".$libro['Precio']?></p>
									    	</div>
									    	<div class="row divider"></div>
									    	<div class="row">
									    		<span class="grey-text text-darken-4 s12">Acerca del vendedor:</span>
									    		<p><?= "Nombre:      ".$libro['Nombre']." ".$libro['Ap_Paterno']?></p>
									    		<p><?= "Correo:      ".$libro['Correo']?></p>
									    		<p><?= "Teléfono:    ".$libro['Telefono']?></p>
									    	</div>
									    </div>
									</div>
								</div>
								

							<?php
							}
						}
						else{
							?>
							<!--else sin resultados-->
							<div class="container">
								<div class="row center grey-text text-darken-1"><h4>Lo sentimos, tu búsqueda no tiene resultados</h4></div>
								<div class="row center">
									<div class="s12">
										<img src="https://image.flaticon.com/icons/png/512/2531/2531052.png" width="300px">
									</div>
								</div>
							</div>
							<?php
						}
					?>
				</div>
				<div class="row center"> <!--Despliegue de paginación-->
					<ul class="pagination">
						<?php
							//FLECHA IZQ (PREV PAGINATION)
							if ($numPage>1) {
								?>
									<li class="waves-effect">
								    	<a href="libros.php?numPage=<?= ($numPage-1);?>">
								    		<i class="material-icons left">chevron_left</i>Anterior
								    	</a>
								    </li>
								<?php
							}

							//DESPLIEGUE DE PAGES NUMBER
							$LINKS_EXTREMOS = 3;	//numero de links a la izquierda y a la derecha
							for ($ind=($numPage-$LINKS_EXTREMOS); $ind<=($numPage+$LINKS_EXTREMOS); $ind++) {
								if(($ind>=1) && ($ind <= $total_pages)){
									?>
										<li class="<?php echo ($ind == $numPage)? 'active':'waves-effect';?>">
									    	<a href="libros.php?numPage=<?= ($ind);?>"><?= ($ind);?></a>
									    </li>

									<?php
								}
							}

							//FLECHA DERECHA (NEXT PAGINATION)
							if ($numPage<$total_pages) {
								?>
									<li class="waves-effect">
								    	<a href="libros.php?numPage=<?= ($numPage+1);?>">
								    		<i class="material-icons right">chevron_right</i>Siguiente
								    	</a>
								    </li>
								<?php
							}
						?>
					</ul>
				</div>
			</div>
		<?php
	}
?>
	






<?php include "templates/footer.php";?>
<!--Aquí va todo el javascript que quieras incluir-->
<script type="text/javascript">
	$(document).ready(function(){
		$('.materialboxed').materialbox();
	});
	function confirmaCompra(){
		return window.confirm("Estas a punto de realizar un pedido, confirma para continuar. De otro modo puedes cancelar.");
	}
</script>
<?php include "templates/end.php";?>