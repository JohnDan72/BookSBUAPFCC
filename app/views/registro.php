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


	if (isset($_POST['enviarRegistro'])) 
	{
		//Validación del formulario
		if (isset($_POST['tipoCuenta']) && isset($_POST['carrera'])) {
			$hayError = true;
			$carreras = ["Ing Ciencias de la Computación","Lic Ciencias de la Computación","Ing TIC's","Otros","Docencia"];
			$nombre = str_replace(' ', '', $_POST['nombre']);
			$ap_p 	= str_replace(' ', '', $_POST['ap_pat']);
			$ap_m 	= str_replace(' ', '', $_POST['ap_mat']);
			$tel 	= str_replace(' ', '', $_POST['telefono']);
			$matri  = str_replace(' ', '', $_POST['matricula']);
			$email 	= str_replace(' ', '', $_POST['correo']);
			$pass1 	= str_replace(' ', '', $_POST['pass1']);
			$pass2 	= str_replace(' ', '', $_POST['pass2']);
			$tipoC 	= $_POST['tipoCuenta'];
			$carrera = $_POST['carrera'];

			//validaciones
			if ($nombre!="" && $ap_p!="" && $ap_m!="" && $tel!="" && is_numeric($tel) && $matri!="" && is_numeric($matri) && strlen($matri)==9 && is_numeric($carrera) && $carrera>=1 && $carrera<=5 && $email!="" && $pass1!="" && $pass1==$pass2) {
				require("../models/usuarioModel.php");	//carga del model
				$model = new UserModel();				
				if (($model->insertUser($nombre,$ap_p,$ap_m,$tel,$email,$pass1,$tipoC,$matri,$carreras[$carrera-1]))) {	//realizar el insert y checar si no hay error
					$hayError = false;
				}
			}
			
			if ($hayError) 
			{ 	//ocurrió un problema
				include "Errors/errorRegistro.php";
			}
			else
			{	//Registro completado exitósamente
				include "Exito/exitoRegistro.php";
			}
		}
		
		include "templates/footer.php";
	}
	else
	{
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
				
				<div class="subheader"><h6>Llena el formulario para crear tú cuenta nueva</h6></div>
				<div class="col s10 m6 l6 offset-s1 offset-m3 offset-l3">
					<div class="divider"></div>
				</div>
				<div class="clearfix"></div>
			</div>

			<div class="row">
				<form id="form_register" method="POST" action="registro.php">
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
						          <label for="id_tel">Teléfono (celular)</label>
						          <div id='id_tel_error' style="display: none;">
						          	<span style="color: red">El número telefónico debe tener 10 dígitos</span>
						          </div>
						        </div>
					         </div>
					         <div class="step-actions right">
					            <!-- Here goes your actions buttons -->
					            <button class="waves-effect waves-dark btn next-step light-blue accent-3" data-feedback="someFunction">Siguiente</button>
					         </div>
					      </div>
					   </li>

					   <li class="step">
					      <div class="step-title waves-effect">Información Cuenta</div>
					      <div class="step-content">
					         <div class="row">
					         	<div class="input-field col s12">
						          <input placeholder="Ingresa tu matrícula o Id de trabajador" name="matricula" id="id_matri" type="text" class="validate" maxlength="9" data-length="9" onkeypress="return soloNumeros(event);" required>
						          <label for="id_matri">Matrícula o Id Trabajador</label>
						          <div id='id_matri_error' style="display: none;">
						          	<span style="color: red">Matrícula inválida o ya existente</span>
						          </div>
						        </div>
						        <div class="input-field col s12">
								    <select name="carrera">
								      <option value="" disabled selected>Elige tu carrera</option>
								      <option value="1">Ing. Ciencias de la Computación</option>
								      <option value="2">Lic. Ciencias de la Computación</option>
								      <option value="3">Ing TIC's</option>
								      <option value="4">Otra Carrera</option>
								      <option value="5">Docencia</option>
								    </select>
								    <label></label>
								    <div class="row" id='id_carrera_error' style="display: none;">
							          	<span style="color: red">Selecciona tu carrera</span>
							        </div>
								</div>
					         	<div class="input-field col s12">
						          <input placeholder="Ingresa tu correo" name="correo" id="id_correo" type="email" class="validate" required>
						          <label for="id_correo">Correo</label>
						          <div id='id_correo_error' style="display: none;">
						          	<span style="color: red">Error, este correo ya ha sido registrado</span>
						          </div>
						        </div>
						        <div class="input-field col s12">
						          <input placeholder="Nueva Contraseña" name="pass1" id="id_pass1" type="password" class="validate" required>
						          <label for="id_pass1">Contraseña (6 caracteres mínimo)</label>
						          <div id='id_pass_error1' style="display: none;">
						          	<span style="color: red">Debe contener mínimo 6 caracteres alfanuméricos</span>
						          </div>
						        </div>
						        <div class="input-field col s12">
						          <input placeholder="Confirma tu contraseña" name="pass2" id="id_pass2" type="password" class="validate" required>
						          <label for="id_pass2">Confirmación de Contaseña</label>
						          <div id='id_pass_error2' style="display: none;">
						          	<span style="color: red">Las contraseñas deben coincidir</span>
						          </div>
						        </div>

						        <div class="row center"><h5>¿Para qué te gustaría usar tu cuenta?</h5></div>
						        <div class="col s6 center">
						        	<label>
								      <input class="with-gap" name="tipoCuenta" type="radio" value="0"/>
								      <span>Comprar libros</span>
								    </label>
						        </div>
						        <div class="col s6 center">
								    <label>
								      <input class="with-gap" name="tipoCuenta" type="radio" value="1"/>
								      <span>Vender y Comprar libros</span>
								    </label>
						        </div>
						        
						        <div class="row center" id='id_tipo_error' style="display: none;">
						          	<span style="color: red">Debes elegir una opción</span>
						        </div>
						        
						        <div class="col s12 center">
						        	<div id="id_captcha" align="center" class="g-recaptcha" data-sitekey="6LcLefUUAAAAAIR7n2G2ZUp0wIHeZ3r2yrRE52_h" style="margin-top: 50px; margin-bottom: 50px;"></div>

						        	<div class="row" id='id_captcha_error' style="display: none;">
							          	<span style="color: red">Completa el captcha primero</span>
							        </div>
						        </div>
					         </div>
					         <div class="step-actions right">
					            <!-- Here goes your actions buttons -->
						            <button class="waves-effect waves-dark btn previous-step  grey lighten-4  grey-text text-darken-3" >Atrás</button>
						            <button class="waves-effect waves-dark btn next-step light-blue accent-3" data-feedback="someFunction">Siguiente</button>
					         </div>
					      </div>
					   </li>

					   <li class="step">
					      <div class="step-title waves-effect">Finalizar Registro</div>
					      <div class="step-content">
					      	<div class="row center">
					      		<i class="medium material-icons">check_circle</i>
					      	</div>
					         <div class="row center">
					         	<p>Toda la información ha sido validada correctamente. Para terminar solo debes de dar clic en "Completar Registro". Si deseas modificar algo, puedes regresar con el botón "Atrás"</p>
					         </div>
					         <div class="step-actions" id="butons_stepper">
					         		<button class="waves-effect waves-dark btn previous-step  grey lighten-4  grey-text text-darken-3" >Atrás</button>
						            <button class="waves-effect waves-dark btn light-blue accent-3" type="submit" name="enviarRegistro">Completar Registro<i class="material-icons right">send</i></button>
					         </div>
					      </div>
					   </li>
					</ul>
				</form>
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
			        if (tecla == 8 || tecla == 13) {
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
			   firstActive: 0,
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
			   //feedbackPreloader: '<div class="spinner-layer spinner-blue-only"></div>'
			});

			/*Funcion para validación del stepper*/
			function defaultValidationFunction(stepperForm, activeStepContent) {
			   var inputs = activeStepContent.querySelectorAll('input, textarea, select');
			   for (let i = 0; i < inputs.length; i++) if (!inputs[i].checkValidity()) return false;
			   return true;
			}

			function someFunction(destroyFeedback) {

				var currentSteps = stepperInstace.getSteps(); /*Funcion que siver para obtener ls info del stepper y checar en cual va para realizar funciones con fetch dentro del mismo stepper*/
				if (currentSteps.active.index == 0) { //primera parte del registro
					if (document.getElementById('id_tel').value.length == 10) {
						document.getElementById('id_tel_error').style.display = 'none';
						setTimeout(() => {
				        	 destroyFeedback(true);
				      	}, 1000);
					}
					else{
						document.getElementById('id_tel_error').style.display = 'block';
						destroyFeedback(false);
					}
				}
				if (currentSteps.active.index == 1) { //segunda parte, correo y contraseña
					/*Se valida el form mediante fetch*/

					/*
						NOTA IMPORTANTE: esta función fetch solo funciona bien si todas las acciones que deseas realizar despues del mismo estan dentro de la promesa.
						Si usas variables que dependen del fetch y las tratas de evaluar fuera de él, tendras problemas de consistencia ya que es asyincrono y no funcionará correctamente
					*/
					fetchStep2().then(myJson => {
						var band = false;
						
			        
				        if (myJson.correo) document.getElementById('id_correo_error').style.display = 'none';  
				        else document.getElementById('id_correo_error').style.display = 'block';
				        if (myJson.matricula) document.getElementById('id_matri_error').style.display = 'none';  
				        else document.getElementById('id_matri_error').style.display = 'block';
				        if (myJson.captcha) document.getElementById('id_captcha_error').style.display = 'none';  
				        else document.getElementById('id_captcha_error').style.display = 'block';
				        if (myJson.passwd1) document.getElementById('id_pass_error1').style.display = 'none'; 
				        else document.getElementById('id_pass_error1').style.display = 'block';
				        if (myJson.passwd2) document.getElementById('id_pass_error2').style.display = 'none'; 
				        else document.getElementById('id_pass_error2').style.display = 'block';
				        if (myJson.tipoCuenta) document.getElementById('id_tipo_error').style.display = 'none';
				        else document.getElementById('id_tipo_error').style.display = 'block';
				        if (myJson.carrera) document.getElementById('id_carrera_error').style.display = 'none';  
				        else document.getElementById('id_carrera_error').style.display = 'block';

				        band = myJson.correo && myJson.matricula && myJson.captcha && myJson.passwd1 && myJson.passwd2 && myJson.tipoCuenta && myJson.carrera; /*bandera de retorno sel step*/
						if (band) {
							setTimeout(() => {
					        	 destroyFeedback(true);
					      	}, 1000);
						}
						else
						{	
							grecaptcha.reset();
							destroyFeedback(false);
						}
					});
				}
		   	}

		    async function fetchStep2()
		    {
		        const data = new FormData(document.getElementById('form_register'));
		        const response = await fetch('../fetch_files/validaStep2.php', {
									        method: 'POST',
									        body: data
									    });
		        const jsonData = await response.json();
		        return jsonData;
		   	}
		</script>

		<?php
	}

?>


<?php include "templates/end.php";?>



