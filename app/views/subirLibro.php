<?php include "templates/header.php";?>
<!--Aqui va todo el css adicional de cada vista-->
<link rel="stylesheet" href="../../public/css/subirLibro.css">
<!--Aquí escribe el título de la página actual-->
<title>Subir Libro</title>
<?php include "templates/navbar.php";?>
<?php
	if (!(isset($_SESSION['userdata']))) {
		header("Location: index.php");
		exit();
	}
?>

<div class="parallax-container valign-wrapper">
  <div class="parallax"><img src="../../public/img/fondoSubirLibro.jpg"></div>
  <div id="imgParallax2" class="row center grey-text text-lighten-4  grey darken-1">
  	<h5>Sube un nuevo libro</h5>
  </div>
</div>

<div class="container">
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
			<div class="row">
				<h5 class="col s12 grey-text text-darken-3">Información del Libro</h5>
				
			</div>
			<div class="row valign-wrapper">
				<form class="col s12" action="#" method="POST">
					<div class="row">
						<div class="input-field col s12 m6">
				          <input placeholder="Título del libro" name="titulo" id="id_titulo" type="text" class="validate" required>
				          <label for="id_titulo">Título</label>
				        </div>
				        <div class="input-field col s12 m6">
						    <select name="area" required>
						      <option value="" disabled selected>Elige el área del libro</option>
						      <option value="1">Computación</option>
						      <option value="2">Hardware</option>
						      <option value="3">Matemáticas</option>
						      <option value="4">Física</option>
						      <option value="5">Otros</option>
						    </select>
						    <label></label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12">
							<textarea placeholder="Descripción del libro..." name="descripcion" id="id_descrip" class="materialize-textarea validate" data-length="50" maxlength="50"></textarea>
	          				<label for="id_descrip">50 caracteres máximo</label>
	          			</div>
					</div>
					<div class="row">
						<div class="input-field col s12 m6">
					        <input placeholder="Precio del libro MXN" name="precio" id="id_precio" type="text" class="validate" maxlength="10" data-length="10" onkeypress="return soloNumeros(event);" required>
					        <label for="id_precio">Precio</label>
					        <div id='id_tel_error' style="display: none;">
					        	<span style="color: red">Número requerido</span>
					        </div>
				        </div>
				        <div class="input-field col s12 m6">
						    <select name="edo_libro" required>
						      <option value="" disabled selected>¿En qué estado esta el libro?</option>
						      <option value="1">Impecable</option>
						      <option value="2">Regular</option>
						      <option value="3">Maltratado</option>
						    </select>
						    <label></label>
						</div>
						<div class="clearfix"></div>
						<div class="file-field input-field col s12 m6 center">
					      <div class="btn grey darken-1">
					        <span>Imagen libro</span>
					        <input type="file">
					      </div>
					      <div class="file-path-wrapper">
					        <input class="file-path validate" type="text" required>
					      </div>
					    </div>
					</div>
					<div class="row center">
						<button class="waves-effect waves-dark btn light-blue accent-3" type="submit" name="enviarLibro">Subir Libro<i class="material-icons right">send</i></button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>










<?php include "templates/footer.php";?>
<!--Aquí va todo el javascript que quieras incluir-->
<script type="text/javascript">
	function soloNumeros(e){
	  		tecla = (document.all) ? e.keyCode : e.which;
	        //Tecla de retroceso para borrar, siempre la permite
	        if (tecla == 8 || tecla == 13) {
	            return true;
	        }
	        // Patron de entrada, en este caso solo acepta numeros y letras
	        patron = /[0-9]/;
	        tecla_final = String.fromCharCode(tecla);
	        return patron.test(tecla_final);
	}
</script>

<?php include "templates/end.php";?>