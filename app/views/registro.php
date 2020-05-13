<?php include "templates/header.php";?>
<!--Aqui va todo el css adicional de cada vista-->
<link rel="stylesheet" href="<?= $BASE_PATH;?>public/css/registro.css">
<!-- CSS  de Stepper-->
<link rel="stylesheet" href="https://unpkg.com/materialize-stepper@3.1.0/dist/css/mstepper.min.css">
<!--Aquí escribe el título de la página actual-->
<title>Registro</title>
<script src="<?= $BASE_PATH;?>public/js/indexJS.js"></script>
<?php include "templates/navbar.php";?>
<?php
	if (isset($_SESSION['userdata'])) {
		header("Location: index.php");
		exit();
	}
?>


<!--Aqui va todo el contenido de la página actual-->
<div class="parallax-container valign-wrapper">
  <div class="parallax"><img src="../../public/img/fondoRegistro.jpg"></div>
  <div id="imgParallax2" class="row center grey-text text-lighten-4  grey darken-1">
  	<h5>Crea una nueva cuenta para disfrutar de todos los beneficios</h5>
  </div>
</div>

<div class="container">
	<div class="row center">
		<h3>Registro</h3>
		
		<div class="subheader">Llena el formulario para crear tú cuenta nueva</div>
		<div class="col s10 m6 l6 offset-s1 offset-m3 offset-l3">
			<div class="divider"></div>
		</div>
		<div class="clearfix"></div>
	</div>

	<div class="row">
		<ul class="stepper linear col s12 m8 l6 offset-m2 offset-l3">
		   <li class="step">
		      <div class="step-title waves-effect">Información Personal</div>
		      <div class="step-content">
		         <div class="row">
		         	<div class="input-field col s12">
			          <input placeholder="Ingresa tu primer nombre" name="nombre" id="id_nombre" type="text" class="validate" required>
			          <label for="id_nombre">Nombre</label>
			        </div>
			        <div class="input-field col s12">
			          <input placeholder="Ingresa tu apellido paterno" name="ap_pat" id="id_ap_pat" type="text" class="validate" required>
			          <label for="id_ap_pat">Apellido Paterno</label>
			        </div>
			        <div class="input-field col s12">
			          <input placeholder="Ingresa tu apellido materno" name="ap_mat" id="id_ap_mat" type="text" class="validate" required>
			          <label for="id_ap_mat">Apellido Materno</label>
			        </div>
			        <div class="input-field col s12">
			          <input placeholder="Ingresa tu número de celular (10 dígitos)" name="telefono" id="id_tel" type="text" class="validate" maxlength="10" data-length="10" onkeypress="return soloNumeros(event);" required>
			          <label for="id_tel">Telefono</label>
			        </div>
		         </div>
		         <div class="step-actions right">
		            <!-- Here goes your actions buttons -->
		            <button class="waves-effect waves-dark btn next-step light-blue accent-3 right">Continuar</button>
		         </div>
		      </div>
		   </li>

		   <li class="step">
		      <div class="step-title waves-effect">Información Cuenta</div>
		      <div class="step-content">
		         <div class="row">
		         	<div class="input-field col s12">
			          <input placeholder="Ingresa tu correo" name="correo" id="id_correo" type="email" class="validate" required>
			          <label for="id_correo">Correo</label>
			        </div>
			        <div class="input-field col s12">
			          <input placeholder="Nueva Contraseña" name="pass1" id="id_pass1" type="password" class="validate" required>
			          <label for="id_pass1">Contraseña</label>
			        </div>
			        <div class="input-field col s12">
			          <input placeholder="Confirma tu contraseña" name="pass2" id="id_pass2" type="password" class="validate" required>
			          <label for="id_pass2">Confirmación de Contaseña</label>
			        </div>

			        <div class="row center"><h5>¿Para qué te gustaría usar tu cuenta?</h5></div>
			        <div class="col s6 center">
			        	<label>
					      <input name="tipoCuenta" type="radio" value="0" />
					      <span>Comprar libros</span>
					    </label>
			        </div>
			        <div class="col s6 center">
					    <label>
					      <input name="tipoCuenta" type="radio" value="1"/>
					      <span>Vender y Comprar libros</span>
					    </label>
			        </div>
			        <div class="col s12 center">
			        	<div align="center" class="g-recaptcha" data-sitekey="6LcLefUUAAAAAIR7n2G2ZUp0wIHeZ3r2yrRE52_h" style="margin-top: 50px; margin-bottom: 50px;"></div>
			        </div>
		         </div>
		         <div class="step-actions right">
		            <!-- Here goes your actions buttons -->
		            <button class="waves-effect waves-dark btn next-step light-blue accent-3 right">Continuar</button>
		         </div>
		      </div>
		   </li>
		</ul>
	</div>
</div>





<?php include "templates/footer.php";?>
<!--Aquí va todo el javascript que quieras incluir-->
<!-- JS de Stepper -->
<script src="https://unpkg.com/materialize-stepper@3.1.0/dist/js/mstepper.min.js"></script>
<!--API de captcha de Google-->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>


<script type="text/javascript">
	$(document).ready(function(){
		$('input#id_tel').characterCounter();

	});
	function soloNumeros(e){

		
	  		tecla = (document.all) ? e.keyCode : e.which;
	        //Tecla de retroceso para borrar, siempre la permite
	        if (tecla == 8) {
	            return true;
	        }
	        // Patron de entrada, en este caso solo acepta numeros y letras
	        patron = /[0-9]/;
	        tecla_final = String.fromCharCode(tecla);
	        return patron.test(tecla_final);
	  	
	}
	/*Se inicializa el Stepper*/
	var stepper = document.querySelector('.stepper');
	var stepperInstace = new MStepper(stepper, {
	   // Default active step.
	   firstActive: 1,
	   // Allow navigation by clicking on the next and previous steps on linear steppers.
	   linearStepsNavigation: true,
	   // Auto focus on first input of each step.
	   autoFocusInput: true,
	   // Set if a loading screen will appear while feedbacks functions are running.
	   showFeedbackPreloader: true,
	   // Function to be called everytime a nextstep occurs. It receives 2 arguments, in this sequece: stepperForm, activeStepContent.
	   validationFunction: defaultValidationFunction, // more about this default functions below
	   // Enable or disable navigation by clicking on step-titles
	   stepTitleNavigation: true,
	   // Preloader used when step is waiting for feedback function. If not defined, Materializecss spinner-blue-only will be used.
	   //feedbackPreloader: '<div class="spinner-layer spinner-blue-only">...</div>'
	});

	/*Funcion para validación del stepper*/
	function defaultValidationFunction(stepperForm, activeStepContent) {
		var currentSteps = stepperInstace.getSteps(); /*Funcion que siver para obtener ls info del stepper y checar en cual va para realizar funciones con fetch dentro del mismo stepper*/

		console.log(currentSteps+"\n\n"+currentSteps.active.index);/**/
	   var inputs = activeStepContent.querySelectorAll('input, textarea, select');
	   for (let i = 0; i < inputs.length; i++) if (!inputs[i].checkValidity()) return false;
	   return true;
	}

</script>
<?php include "templates/end.php";?>


