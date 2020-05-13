<?php $BASE_PATH = "/AppsWeb/ProyectoFinal/";
	session_start();
	if (isset($_SESSION['userdata'])) {
		header("Location: index.php");
		exit();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
	<!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="<?= $BASE_PATH;?>public/css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</head>
<body id="fondoLogin" class="responsive-img valign-wrapper">


	<div class="container">
		<div class="row">
			<div class="col s12 m8 l5 offset-m2 offset-l2 card-panel grey lighten-4" >
		      		<div class="container" style="margin-top: 40px;">
		      			<div class="row center hide-on-large-only">
	      					<a href="index.php" class="brand-logo"><img id="id_logo" src="<?= $BASE_PATH;?>public/img/Logo.png" height="70px" width="150px"></a>
	      					<div class="divider"></div>
	      				</div>
		      			<div class="row center">
		      				<h4>Inicio de Sesión</h4>
		      			</div>
		      			<div class="divider hide-on-med-and-down"></div>
		      			<div class="row center grey-text text-darken-2" style="margin-top: 20px;">Ingrese su correo y contraseña para acceder</div>
		      			<div class="row">
		      				<form class="col s12">
		      					<div class="row">
							        <div class="input-field col s12">
							          <input placeholder="Ingresa tu correo" id="id_correo" name="correo" type="text" class="validate" required>
							          <label for="id_correo">Correo</label>
							        </div>
							        <div class="input-field col s12">
							          <input placeholder="Ingresa la Contraseña" id="id_pass" name="passwd" type="password" class="validate" required>
							          <label for="id_pass">Contraseña</label>
							        </div>
							        <div class="clearfix"></div>
							        <div id="id_mensaje_error" class="col s12 center" style="color: red; display: none; margin-bottom: 30px;">
							        	<!--Aquí va el mensaje de error del login-->
							        	
							        </div>
							        <a class="col s12 center" href="forgotPassword.php"><span>¿Olvidaste tu contraseña?</span></a>
							        <div class="clearfix"></div>
							        <div class="col s12 center">
							        	¿No tienes una cuenta? 
							        	<a href="registro.php"><span>Crea una</span></a>
							        </div>
							        
							        
							    </div>
		      				</form>
		      				<div class="row">
						    	<button onclick="return fetchLogin();" class="btn waves-effect waves-light light-blue accent-3 col s12 m6 l6 offset-m3 offset-l3">Iniciar Sesión</button>
						    </div>
		      			</div>
		      		</div>	
      		</div>
      		<div id="panelDer" class="col l3 card-panel blue responsive-img hide-on-med-and-down valign-wrapper" >
      			<div class="container center">
      				<div class="row">
      					<a href="index.php" class="brand-logo"><img id="id_logo" src="<?= $BASE_PATH;?>public/img/Logo.png" height="70px" width="150px"></a>
      				</div>
      				<div id="logoDer" class="row grey darken-1 grey-text text-lighten-5">
      					<h6>Book Store - BUAP</h6>
      				</div>
      			</div>
      		</div> 
		</div>
	</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script type="text/javascript">
    	M.AutoInit();

    	$(document).ready(function(){
    		$("#fondoLogin").css({
	            "height": $(window).height() + "px"
	        });
	        $("#panelDer").css({
	            "height": $(".card-panel").height() + "px"
	        });
		});
    </script>

<script type="text/javascript">
	function fetchLogin()
	{	
		var correo = document.getElementById('id_correo').value;
		var passwordU = document.getElementById('id_pass').value;

		var data = new FormData();
            data.append('correo', correo);
            data.append('passwd', passwordU);

		fetch('../fetch_files/validaLogin.php', {
	        method: 'POST',
	        body: data
	    })
	    .then(function(response) {
	        if(response.ok) {
	            return response.json()
	        } else {
	            throw "Error en la llamada Ajax";
	        }
	    })
	    .then(function(myJson) {
	        if (!((typeof myJson) == "string")) 
	        {
	          	window.location.replace("index.php");   
	        }
	        else
	        { 	

	            var cadResponse = myJson.replace("Error/","");
	            var auxError = document.getElementById('id_mensaje_error');
	            auxError.textContent = cadResponse;
	            auxError.style.display = 'block';
	            $("#panelDer").css({
		            "height": $(".card-panel").height() + "px"
		        });
	        }
	    })
	    .catch(function(err) {
	       console.log(err);
	    });
	}

</script>
</body>
</html>
