<?php include "templates/header.php";?>
<!--Aqui va todo el css adicional de cada vista-->
<link rel="stylesheet" href="../../public/css/subirLibro.css">
<!--Aquí escribe el título de la página actual-->
<title>Subir Libro</title>
<?php include "templates/navbar.php";?>
<?php
	if (!isset($_SESSION['userdata']) || $_SESSION['userdata']['Tipo']==0) {
		header("Location: index.php");
		exit();
	}

	if (isset($_POST['titulo'])) {

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
	    if((isset($_FILES['foto']['name'])) && ($_FILES['foto']['name']!="") && ($_FILES['foto']['size']<=$MAX_SIZE)){
	        if(in_array($mime, $allowed_mime_type_arr)){
	            $band['foto'] = true;
	        }else{
	            $band['foto'] = false;
	        }
	    }else{
	        $band['foto'] = false;
	    }

	    //validacion completa del formulario por POST
	    if ($band['titulo'] && $band['area'] && $band['descripcion'] && $band['precio'] && $band['edo_libro'] && $band['foto']) {
	    	$img_name = $_FILES['foto']['name'];
	    	while (file_exists("../../public/img/imgLibros/".$img_name)) {
	    		$indAux=1;
	    		$img_name = str_replace(".$mime", "", "$img_name")."_"."$indAux".".$mime"; //armando el nuevo nombre de la imagen si ya se repitió
	    		$indAux++;
	    	}
	    	$ruta = "../../public/img/imgLibros/".$img_name;
			copy($_FILES['foto']['tmp_name'], $ruta); //se guarda la imaen en la carpeta

			require("../models/libroModel.php");
			$modelLibro = new LibroModel();
			$_POST['area'] = $areas[((int) $_POST['area'])-1];
			$_POST['edo_libro'] = $estadosLibro[((int) $_POST['edo_libro'])-1];
			$_POST['precio'] = str_replace(",","",$_POST['precio']);
			$success = $modelLibro->insertBook($_POST,$img_name,$_SESSION['userdata']['Id']);
			if ($success) {
				header("Location: subirLibro.php?cadResult=1");
				exit();
			}
			else{
				header("Location: subirLibro.php?cadResult=0");
				exit();
			}
	    	
	    }
	    else{
	    	header("Location: subirLibro.php?cadResult=0");
	    	exit();
	    }

	}
?>


<div class="parallax-container valign-wrapper">
  <div class="parallax"><img src="../../public/img/fondoSubirLibro.jpg"></div>
  <div id="imgParallax2" class="row center grey-text text-lighten-4  grey darken-1">
  	<h5>Sube un nuevo libro</h5>
  </div>
</div>

<div class="container" style="margin-top: 30px;">
	<div class="row">
		<div class="col s12 m5 l5 center section_class">
			<div class="row">
				<h4 class="col s12 grey-text text-darken-3">Subir Nuevo Libro</h4>
				<div class="subheader grey-text text-darken-1">Ingresa la información corespondiente para poder subir tu nuevo libro a vender</div>
			</div>
			<div class="row" style="margin-top: 50px;">
				<img src="https://image.flaticon.com/icons/png/512/1946/1946093.png" width="300px" height="300px">
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
				<form id="id_form_Libro" class="col s12" action="subirLibro.php" method="POST" enctype="multipart/form-data">
					<div class="row">
						<div class="input-field col s12 m6">
				          <input placeholder="Título del libro" name="titulo" id="id_titulo" type="text" class="validate" required>
				          <label for="id_titulo">Título</label>
				          <div class="row" id='id_titulo_error' style="display: none;">
					          	<span style="color: red">Ingresa el título primero</span>
					      </div>
				        </div>
				        <div class="input-field col s12 m6">
						    <select name="area">
						      <option value="" disabled selected>Elige el área del libro</option>
						      <option value="1">Computación</option>
						      <option value="2">Hardware</option>
						      <option value="3">Matemáticas</option>
						      <option value="4">Física</option>
						      <option value="5">Otros</option>
						    </select>
						    <label></label>
						    <div class="row" id='id_area_error' style="display: none;">
					          	<span style="color: red">Selecciona un área</span>
					        </div>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12">
							<textarea placeholder="Descripción del libro..." name="descripcion" id="id_descrip" class="materialize-textarea validate" data-length="50" maxlength="50"></textarea>
	          				<label for="id_descrip">50 caracteres máximo</label>
	          				<div class="row" id='id_descrip_error' style="display: none;">
					          	<span style="color: red">Tamaño máximo de caracteres: 50</span>
					      </div>
	          			</div>
					</div>
					<div class="row">
						<div class="input-field col s12 m6">
							<i class="material-icons prefix">attach_money</i>
					        <input placeholder="Precio del libro MXN" name="precio" id="id_precio" type="text" class="validate" maxlength="5" data-length="5" onkeypress="return soloNumeros(event);" onkeydown="return soloRetroceso(event)" required>
					        <label for="id_precio">Precio</label>
					        <div id='id_precio_error' style="display: none;">
					        	<span style="color: red">Ingresa el precio primero</span>
					        </div>
				        </div>
				        <div class="input-field col s12 m6">
						    <select name="edo_libro">
						      <option value="" disabled selected>¿En qué estado esta el libro?</option>
						      <option value="1">Impecable</option>
						      <option value="2">Regular</option>
						      <option value="3">Maltratado</option>
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
				</form>
				<div class="row center">
					<button class="waves-effect waves-dark btn light-blue accent-3" name="enviarLibro" onclick="return fetchUploadLibro();">Subir Libro<i class="material-icons right">send</i></button>
				</div>
				
			</div>
		</div>
	</div>
</div>








<?php include "templates/footer.php";?>
<!--Aquí va todo el javascript que quieras incluir-->
<script type="text/javascript">
	function soloNumeros(e){
		var precioCant = document.getElementById('id_precio');

	  		tecla = (document.all) ? e.keyCode : e.which;
	  		//console.log(e.keyCode+"  --  "+e.which);

	        // Patron de entrada, en este caso solo acepta numeros
	        patron = /[0-9]/;
	        tecla_final = String.fromCharCode(tecla);
	        if (patron.test(tecla_final)) {
	        	if (precioCant.value.length == 3) {
	        		precioCant.value = precioCant.value.slice(0,1)+","+precioCant.value.slice(1)+tecla_final;
	        		return false;
	        	}
	        	else return true;
	        }
	        return false;
	}
	function soloRetroceso(e){
		var precioCant = document.getElementById('id_precio');
		
		tecla = (document.all) ? e.keyCode : e.which;

		//Tecla de retroceso para borrar, siempre la permite
        if (tecla == 8) {
            if (precioCant.value.length >= 4) {
            	precioCant.value = precioCant.value.slice(0,1)+precioCant.value.slice(2,4);
            	return false;
        	}
        	else
        		return true;
        }
	}

	
	function fetchUploadLibro(){
		var formdat = new FormData(document.getElementById('id_form_Libro'));
		
		fetch("../fetch_files/validaSubirLibro.php",{
			method: 'POST',
			body: formdat
		})
		.then((response) => {
			if (response.ok) {
				return response.json();
			}
			else{
				throw "Error al llamar fetch";
			}
		})
		.then((myJson) => {
			if (!myJson.titulo) {document.getElementById('id_titulo_error').style.display='block';}
			else{document.getElementById('id_titulo_error').style.display='none';}
			if (!myJson.area) {document.getElementById('id_area_error').style.display='block';}
			else{document.getElementById('id_area_error').style.display='none';}
			if (!myJson.descripcion) {document.getElementById('id_descrip_error').style.display='block';}
			else{document.getElementById('id_descrip_error').style.display='none';}
			if (!myJson.precio) {document.getElementById('id_precio_error').style.display='block';}
			else{document.getElementById('id_precio_error').style.display='none';}
			if (!myJson.edo_libro) {document.getElementById('id_edo_libro_error').style.display='block';}
			else{document.getElementById('id_edo_libro_error').style.display='none';}
			if (!myJson.foto) {document.getElementById('id_foto_error').style.display='block';}
			else{document.getElementById('id_foto_error').style.display='none';}
			
			if (myJson.titulo && myJson.area && myJson.descripcion && myJson.precio && myJson.edo_libro && myJson.foto) {
				document.getElementById('id_form_Libro').submit();
			}

		})
		.catch((exception) =>{
			console.log(exception);
		})
	}
	
</script>

<?php include "templates/end.php";?>