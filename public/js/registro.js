
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
						Si usas variables que dependen del fetch y las tratas de evaluar fuera de él, tendras problemas de consistencia ya que es asyincrono y no 
						funcionará correctamente
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