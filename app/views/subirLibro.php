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
  <div class="parallax"><img src="https://pixabay.com/get/57e8d0434b55ac14f6d1867dda35367b1d36dbe45654794c_1920.jpg"></div>
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
			<div class="row">
				<img src="https://image.flaticon.com/icons/png/512/2521/2521739.png" width="300px" height="300px">
			</div>
		</div>
		<div class="col s12 m7 l7 center section_class" style="margin-top: 30px;"><!--Formulario-->
			<div class="row">
				<h5 class="col s12 grey-text text-darken-3">Información del Libro</h5>
				
			</div>
			<div class="row valign-wrapper">
				<form class="col s12">
					<div class="row">
						<div class="input-field col s12 m6">
				          <input placeholder="Título del libro" name="titulo" id="id_titulo" type="text" class="validate">
				          <label for="id_titulo">Título</label>
				        </div>
				        <div class="input-field col s12 m6">
						    <select>
						      <option value="" disabled selected>Elige el área del libro</option>
						      <option value="1">Computación</option>
						      <option value="2">Hardware</option>
						      <option value="3">Matemáticas</option>
						      <option value="4">Física</option>
						      <option value="5">Otros</option>
						    </select>
						    <label>Área</label>
						</div>
					</div>
					<div class="row">
						<textarea placeholder="Descripción del libro..." name="descripcion" id="id_descrip" class="materialize-textarea" data-length="50" maxlength="50"></textarea>
          				<label for="id_descrip">50 caracteres máximo</label>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>










<?php include "templates/footer.php";?>
<!--Aquí va todo el javascript que quieras incluir-->
<script type="text/javascript">
</script>

<?php include "templates/end.php";?>