<?php include "templates/header.php";?>
<!--Aqui va todo el css adicional de cada vista-->
<link rel="stylesheet" href="<?= $BASE_PATH;?>public/css/faq.css">
<!--Aquí escribe el título de la página actual-->
<title>FAQ</title>
<script src="<?= $BASE_PATH;?>public/js/indexJS.js"></script>
<?php include "templates/navbar.php";?>

<div class="parallax-container valign-wrapper">
  <div class="parallax"><img src="../../public/img/fondoFaq.jpg"></div>
  <div id="imgParallax2" class="row center grey-text text-lighten-4  grey darken-1">
  	<h5>Aclara tus dudas sobre Book Store - BUAP</h5>
  </div>
</div>

<div class="container" style="margin-top: 50px;">
	<div class="row center">
		<img src="../../public/img/Logo.png" height="80px">
	</div>
	<div class="row center grey-text text-darken-2">
		<h4 class="col s12">Respuestas a Preguntas Frecuentes (FAQ)</h4>
		<div class="col s12 subheader">¿Tienes alguna duda? Probablemente aquí esta la respuesta.</div>
	</div>
	<div class="row center">
		<div class="col s12 m8 l8 offset-m2 offset-l2">
			<ul class="collapsible">
			    <li>
			      <div class="collapsible-header"><i class="material-icons">question_answer</i>First</div>
			      <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
			    </li>
			    <li>
			      <div class="collapsible-header"><i class="material-icons">question_answer</i>Second</div>
			      <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
			    </li>
			    <li>
			      <div class="collapsible-header"><i class="material-icons">question_answer</i>Third</div>
			      <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
			    </li>
			</ul>
		</div>
	</div>
</div>


<?php include "templates/footer.php";?>
<!--Aquí va todo el javascript que quieras incluir-->
<script type="text/javascript">
	
	$(document).ready(function(){
    	$('.collapsible').collapsible();
  	});
</script>
<?php include "templates/end.php";?>