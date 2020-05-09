<?php include "templates/header.php";?>
<!--Aquí escribe el título de la página actual-->
<title>Inicio</title>
<script src="<?= $BASE_PATH;?>public/js/indexJS.js"></script>
<?php include "templates/navbar.php";?>


<!--Aqui va todo el contenido de la página actual-->
<div id="imgIndex" class="responsive-img valign-wrapper">
	<div class="container">
		<div class="row grey-text text-lighten-4 center">
			<h3 class="col s12">Bienvenido a BookS-BUAP</h3>
			<div class="clearfix"></div>
			<h5 class="col s12">La página número uno en venta de libros para la FCC. Solo inicia sesión para obtener todos los beneficios!</h5>
		</div>
		<div class="row">
			<button class="btn waves-effect waves-light pulse light-blue accent-3 col s8 m2 l2 offset-s2 offset-m5 offset-l5">Iniciar</button>
		</div>
	</div>
</div>

<div id="section_container" class="container">
	<div class="row">
		<div class="col s12 m4 l4 center section_class">
			<div class="row">
				<i class="medium material-icons light-blue-text text-darken-4">search</i>
			</div>
			<div class="row">
				<h5>Variedad de títulos y autores</h5>
			</div>
			<div class="row" ALIGN="justify">
				<p>
					Busca cualquier tipo de libro que se tienen para tí. Se cuenta con más de 1,000 títulos que pueden interesarte. De los temas más comunes: Matemáticas, Hardware, Software, Redes, Apps Móviles, entre muchos otros. Si tu área no es específicamente la informática, no te preocupes, también contamos con títulos de otras carreras.
				</p>
			</div>
			
		</div>
		<div class="col s12 m4 l4 center section_class">
			<div class="row">
				<div class="col s2 m4 l3 offset-s4 offset-m4 offset-l3">
					<i class="medium material-icons light-blue-text text-darken-4">tablet</i>
				</div>
				<div class="col s2 m4 l3">
					<i class="medium material-icons light-blue-text text-darken-4">phone_android</i>
				</div>
			</div>
			<div class="row">
				<h5>Compatibilidad móvil</h5>
			</div>
			<div class="row" ALIGN="justify">
				<p>
					Esta aplicación no es solo exclusiva para PC de escritorio. Gracias al diseño responsivo, puedes disfrutar de la misma experiencia en cualquier dispositivo móvil como celulares o tablets. 
				</p>
			</div>
		</div>
		<div class="col s12 m4 l4 center section_class">
			<div class="row">
				<i class="medium material-icons light-blue-text text-darken-4">home</i>
			</div>
			<div class="row">
				<h5>Facilidad de uso</h5>
			</div>
			<div class="row" ALIGN="justify">
				<p>
					Aplicación web desarrollada con alta tecnología para la mejor experiencia. Cada sección tiene las indicaciones correspondientes para lograr los objetivos de cada tarea. Desarrollo simple pero funcional. Solo ingresa a tu cuenta si ya tienes una para poder comprar cualquier libro que se tienen a tu alcance.
				</p>
			</div>
		</div>
	</div>
</div>

<div class="parallax-container valign-wrapper">
  <div class="parallax"><img src="<?= $BASE_PATH;?>public/img/library2.jpg"></div>
  <div id="imgParallax2" class="row center grey-text text-lighten-4  grey darken-1">
  	<h5>Encuentra el libro que estabas buscando</h5>
  </div>
</div>




<?php include "templates/footer.php";?>
<!--Aquí va todo el javascript que quieras incluir-->
<script type="text/javascript">
	
</script>
<?php include "templates/end.php";?>