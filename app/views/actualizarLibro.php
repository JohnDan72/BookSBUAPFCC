<?php include "templates/header.php";?>
<!--Aqui va todo el css adicional de cada vista-->
<link rel="stylesheet" href="../../public/css/subirLibro.css">
<!--Aquí escribe el título de la página actual-->
<title>Actualizar Libro</title>
<?php include "templates/navbar.php";?>

<?php

	if (isset($_POST['id_libro_anterior'])) {

		require("../models/libroModel.php");
		$auxModel = new LibroModel();
		//se recupera la informacion del libro anterior para comparar si hay diferencias o NO
		$infoAnt = $auxModel->getInfoLibro($_POST['id_libro_anterior'],$_SESSION['userdata']['Id']);
		if (!$infoAnt) {
			header("Location: gestionLibros.php?response=-1");
			exit();
		}


		$areas = ["Computación","Hardware","Matemáticas","Física","Otros"];	//valores posibles Area
    	$estadosLibro = ["Impecable","Regular","Maltratado"]; //valores posibles Estado del Libro

    	//se validan los campos del formulario
	    $band['titulo']     = ($_POST['titulo'] != null) &&($_POST['titulo'] != "");
	    $band['area']       = (isset($_POST['area'])) && ($_POST['area']>=1) && ($_POST['area']<=5);
	    $band['descripcion']= (strlen($_POST['descripcion']) <= 50);
	    $band['precio']     = ($_POST['precio'] != null) && ($_POST['precio'] != "") && (is_numeric(str_replace(",","",$_POST['precio']))) && (strlen(str_replace(",","",$_POST['precio'])) <=4);
	    $band['edo_libro']  = (isset($_POST['edo_libro'])) && ($_POST['edo_libro']>=1) && ($_POST['edo_libro']<=3);

	    //validación del File
	    $MAX_SIZE = 5000000;
	    $allowed_mime_type_arr = array('jpeg','png','jpg');
	    //Nota: En fetch no funciona get_mime_by_extension()
	    
	    $arrayAux = explode('.', $_FILES['foto']['name']);
	    $mime = end($arrayAux); //obtiene la extensión del file
	    //se checa si se cumplen todas las condiciones para un file correcto
	    if((isset($_FILES['foto']['name'])) && ($_FILES['foto']['name']!="") && ($_FILES['foto']['size']<=$MAX_SIZE)) {
	        if(in_array($mime, $allowed_mime_type_arr)){
	            $band['foto'] = 1;
	        }else{
	            $band['foto'] = 0;
	        }
	    }else{
	        $band['foto'] = 0;
	    }

	    //Se comprueba si se ingresó una imagen nueva para validarla, si no entonces no se actualiza la imagen y se continua
	    if (!isset($_FILES['foto']['name']) || $_FILES['foto']['name']=="") {
	        $band['foto'] = 2;   //no es obligatorio que actualice la foto del libro
	    }

	    /*
			$band['foto'] = 0;  //imágen inválida
			$band['foto'] = 1;	//imagen nueva válida
			$band['foto'] = 2;	//imagen sin cambios
	    */
	    //validacion completa del formulario por POST
	    if ($band['titulo'] && $band['area'] && $band['descripcion'] && $band['precio'] && $band['edo_libro']) {
	    	//validacion de nueva foto / foto sin cambios / foto inválda
	    	if ($band['foto'] == 1) {	//foto nueva
	    		unlink("../../public/img/imgLibros/".$infoAnt['Imagen']);	//se borra la imágen anterior para actualizar
		    	$img_name = $_FILES['foto']['name'];
		    	while (file_exists("../../public/img/imgLibros/".$img_name)) {
		    		$indAux=1;
		    		$img_name = str_replace(".$mime", "", "$img_name")."_"."$indAux".".$mime"; //armando el nuevo nombre de la imagen si ya se repitió
		    		$indAux++;
		    	}
		    	$ruta = "../../public/img/imgLibros/".$img_name;
				copy($_FILES['foto']['tmp_name'], $ruta); //se guarda la imaen en la carpeta

				
				$modelLibro = new LibroModel();
				$_POST['area'] = $areas[((int) $_POST['area'])-1];
				$_POST['edo_libro'] = $estadosLibro[((int) $_POST['edo_libro'])-1];
				$_POST['precio'] = str_replace(",","",$_POST['precio']);
				$success = $modelLibro->updateLibro1($_POST,$img_name);
				if ($success) {
					header("Location: gestionLibros.php?response=1");
					exit();
				}
				else{
					header("Location: gestionLibros.php?response=-1");
					exit();
				}
	    	}
	    	elseif ($band['foto'] == 2) { //foto sin cambios
		    	$modelLibro = new LibroModel();
				$_POST['area'] = $areas[((int) $_POST['area'])-1];
				$_POST['edo_libro'] = $estadosLibro[((int) $_POST['edo_libro'])-1];
				$_POST['precio'] = str_replace(",","",$_POST['precio']);
				$success = $modelLibro->updateLibro2($_POST,$infoAnt);
				//se retorna la respuesta del update
				header("Location: gestionLibros.php?response=$success");
				exit();
				
		    }
	    	else{//error en la imagen
	    	 	header("Location: gestionLibros.php?response=-1");
				exit();
	    	}
	    }
	    else{
	    	header("Location: gestionLibros.php?response=-1");
	    	exit();
	    }
	}

	if (!isset($_SESSION['userdata']) || $_SESSION['userdata']['Tipo']==0 || !isset($_REQUEST['libro']) || !is_numeric($_REQUEST['libro'])) {
		header("Location: libros.php");
		exit();
	}

	//recuperar información del libro a actualizar
	require("../models/libroModel.php");
	$modelAuxLibro = new LibroModel();
	$infoLibro = $modelAuxLibro->getInfoLibro($_REQUEST['libro'],$_SESSION['userdata']['Id']);
	if (!$infoLibro) {
		header("Location: gestionLibros.php?response=-1");
		exit();
	}
?>


<div class="parallax-container valign-wrapper">
  <div class="parallax"><img class="responsive-img" src="../../public/img/fondoGestion.jpg"></div>
  <div id="imgParallax2" class="row center grey-text text-lighten-4  grey darken-1">
  	<h5>Actualiza tu libro</h5>
  </div>
</div>

<div class="container" style="margin-top: 30px;">
	<div class="row">
		<div class="col s12 m5 l5 center section_class">
			<div class="row">
				<h4 class="col s12 grey-text text-darken-3">Actualizar Información de:</h4>
			</div>
			<div class="row center" style="margin-top: 50px;">
				<img src="../../public/img/imgLibros/<?= $infoLibro['Imagen']?>" width="300px">
			</div>
		</div>
		<div class="col s12 m7 l7 center section_class grey lighten-5" style="margin-top: 30px;"><!--Formulario-->
			<?php if(isset($_REQUEST['cadResult'])){
					if ($_REQUEST['cadResult'] == 1) {
						?>
							<div class='row center blue-text text-darken-2'>
								<h5>¡Libro Subido Correctamente!</h5>
								<div class='subheader'>Continua subiendo libros nuevos</div>
							</div>

						<?php
					}
					else{
						?>
							<div class='row center red-text text-darken-1'>
								<h5>Error</h5>
								<div class='subheader'>Ocurrió un error inesperado, intentalo de nuevo</div>
							</div>
						<?php
					}
				  }
			?>
			<div class="row">
				<h5 class="col s12 grey-text text-darken-3">Información del Libro</h5>
				
			</div>
			<div class="row">
				<form id="id_form_Libro" class="col s12" action="actualizarLibro.php" method="POST" enctype="multipart/form-data">
					<div class="row">
						<div class="input-field col s12 m6">
				          <input placeholder="Título del libro" name="titulo" id="id_titulo" type="text" class="validate" required value="<?= $infoLibro['Titulo']?>">
				          <label for="id_titulo">Título</label>
				          <div class="row" id='id_titulo_error' style="display: none;">
					          	<span style="color: red">Ingresa el título primero</span>
					      </div>
				        </div>
				        <div class="input-field col s12 m6">
						    <select name="area">
						      <option value="" disabled>Elige el área del libro</option>
						      <option <?php echo ($infoLibro['Area'] == "Computación") ? "selected" : ""; ?> 	value="1">Computación</option>
						      <option <?php echo ($infoLibro['Area'] == "Hardware") ? "selected" : ""; ?> 		value="2">Hardware</option>
						      <option <?php echo ($infoLibro['Area'] == "Matemáticas") ? "selected" : ""; ?> 	value="3">Matemáticas</option>
						      <option <?php echo ($infoLibro['Area'] == "Física") ? "selected" : ""; ?> 		value="4">Física</option>
						      <option <?php echo ($infoLibro['Area'] == "Otros") ? "selected" : ""; ?> 			value="5">Otros</option>
						    </select>
						    <label></label>
						    <div class="row" id='id_area_error' style="display: none;">
					          	<span style="color: red">Selecciona un área</span>
					        </div>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12">
							<textarea placeholder="Descripción del libro..." name="descripcion" id="id_descrip" class="materialize-textarea validate" data-length="50" maxlength="50" ><?= $infoLibro['Descripcion']?></textarea>
	          				<label for="id_descrip">50 caracteres máximo</label>
	          				<div class="row" id='id_descrip_error' style="display: none;">
					          	<span style="color: red">Tamaño máximo de caracteres: 50</span>
					      </div>
	          			</div>
					</div>
					<div class="row">
						<div class="input-field col s12 m6">
							<i class="material-icons prefix">attach_money</i>
					        <input placeholder="Precio del libro MXN" name="precio" id="id_precio" type="text" class="validate" maxlength="5" data-length="5" onkeypress="return soloNumeros(event);" onkeydown="return soloRetroceso(event)" required value="<?= $infoLibro['Precio'];?>">
					        <label for="id_precio">Precio</label>
					        <div id='id_precio_error' style="display: none;">
					        	<span style="color: red">Ingresa el precio primero</span>
					        </div>
				        </div>
				        <div class="input-field col s12 m6">
						    <select name="edo_libro">
						      <option value="" disabled>¿En qué estado esta el libro?</option>
						      <option <?php echo ($infoLibro['Edo_Libro'] == "Impecable") ? "selected" : ""; ?> 	value="1">Impecable</option>
						      <option <?php echo ($infoLibro['Edo_Libro'] == "Regular") ? "selected" : ""; ?> 		value="2">Regular</option>
						      <option <?php echo ($infoLibro['Edo_Libro'] == "Maltratado") ? "selected" : ""; ?> 	value="3">Maltratado</option>
						    </select>
						    <label></label>
						    <div class="row" id='id_edo_libro_error' style="display: none;">
					          	<span style="color: red">Selecciona el estado del libro primero</span>
					      </div>
						</div>
						<div class="clearfix"></div>
						<div class="file-field input-field col s12 m6 center">
					      <div class="btn grey darken-1">
					        <span>Imagen libro</span>
					        <input type="file" name="foto" value="Selecciona una Foto">
					      </div>
					      <div class="file-path-wrapper">
					        <input class="file-path validate" type="text" required>
					      </div>
					      <div class="row" id='id_foto_error' style="display: none;">
					          	<span style="color: red">Se requiere una foto jpg/png (max: 5MB)</span>
					      </div>
					    </div>
					</div>
					<input type="hidden" name="id_libro_anterior" value="<?= $infoLibro['Id']?>">
				</form>
				<div class="row center">
					<a href="gestionLibros.php" class="waves-effect waves-dark btn grey darken-1 white-text">Cancelar</a>
					<button class="waves-effect waves-dark btn light-blue accent-3" name="enviarLibro" onclick="return fetchUploadLibro();">Guardar Cambios<i class="material-icons right">send</i></button>
				</div>
				
			</div>
		</div>
	</div>
</div>








<?php include "templates/footer.php";?>
<!--Aquí va todo el javascript que quieras incluir-->
<script src="../../public/js/actualizarLibro.js"></script>

<?php include "templates/end.php";?>