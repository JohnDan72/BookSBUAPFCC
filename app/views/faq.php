<?php include "templates/header.php";?>
<!--Aqui va todo el css adicional de cada vista-->
<link rel="stylesheet" href="<?= $BASE_PATH;?>public/css/faq.css">
<!--Aquí escribe el título de la página actual-->
<title>FAQ</title>
<script src="<?= $BASE_PATH;?>public/js/indexJS.js"></script>
<?php include "templates/navbar.php";?>

<?php
	require("../models/faqModel.php");
	$faqModel = new FAQModel();
	$faqs = $faqModel->getFaqs();
?>

<div class="parallax-container valign-wrapper">
  <div class="parallax"><img src="../../public/img/fondoFaq.jpg"></div>
  <div id="imgParallax2" class="row center grey-text text-lighten-4  grey darken-1">
  	<h5>Aclara tus dudas sobre Book Store - BUAP</h5>
  </div>
</div>

<?php
	if ($faqs) {
		?>
			<div class="container" style="margin-top: 50px;">
				<div class="row center">
					<img src="../../public/img/Logo.png" height="80px">
				</div>
				<div class="row center grey-text text-darken-2">
					<h4 class="col s12">Respuestas a Preguntas Frecuentes (FAQ)</h4>
					<div class="col s12 subheader">¿Tienes alguna duda? Probablemente aquí esta la respuesta.</div>
				</div>
				<div class="row center">
					<?php
						foreach ($faqs as $faq) {
							?>
								<div class="col s12 m6 l4">
									<ul class="collapsible">
									    <li>
									      <div class="collapsible-header"><i class="material-icons">question_answer</i><?= $faq['Pregunta']?></div>
									      <div class="collapsible-body grey lighten-3"><span><?= $faq['Respuesta']?></span></div>
									    </li>
									</ul>
								</div>


							<?php
						}
					?>
					
				</div>
			</div>
		<?php
	}
	else{
		?>
			<div class="container" style="margin-top: 50px;">
				<div class="row center">
					<img src="../../public/img/Logo.png" height="80px">
				</div>
				<div class="row center grey-text text-darken-2">
					<h4 class="col s12">Respuestas a Preguntas Frecuentes (FAQ)</h4>
					<div class="col s12 subheader">¿Tienes alguna duda? Probablemente aquí esta la respuesta.</div>
				</div>
				<div class="row center">
					<img src="https://image.flaticon.com/icons/svg/2909/2909934.svg" width="300px">
				</div>
				<div class="row center">
					<h5>Aquí aparecerán las preguntas frecuentes que hay acerca de BookS-BUAP</h5>
				</div>
			</div>
		<?php
	}
?>



<?php include "templates/footer.php";?>
<!--Aquí va todo el javascript que quieras incluir-->
<script type="text/javascript">
	
	$(document).ready(function(){
    	$('.collapsible').collapsible();
  	});
</script>
<?php include "templates/end.php";?>