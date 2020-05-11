<?php $BASE_PATH = "/AppsWeb/ProyectoFinal/";?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="<?= $BASE_PATH;?>public/css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</head>
<body id="fondoLogin" class="responsive-img valign-wrapper">


	<div class="container">
		<div class="row">
			<div class="col s12 m8 l8 card-panel grey lighten-4" >
		      		<div class="container" style="margin-top: 30px;">
		      			<div class="row">
		      				<a href="index.php" class="brand-logo"><img id="id_logo" src="<?= $BASE_PATH;?>public/img/Logo.png" height="60px" width="140px"></a>
		      			</div>
		      			<div class="divider"></div>
		      			<div class="row"><h4>Inicio de Sesión</h4></div>
		      			<div class="row">
		      				<form class="col s12">
		      					<div class="row">
							        <div class="input-field col s12">
							          <input placeholder="Ingresa tu correo" id="id_correo" type="text" class="validate">
							          <label for="id_correo">Correo</label>
							        </div>
							        <div class="input-field col s12">
							          <input placeholder="Ingresa la Contraseña" id="id_pass" type="password" class="validate">
							          <label for="id_pass">Contraseña</label>
							        </div>
							        <div class="clearfix"></div>
							        <a class="col s12 m5 l5 offset-m7 offset-l7" href="forgotPassword.php"><span>¿Olvidaste tu contraseña?</span></a>
							        <div class="clearfix"></div>
							        
							    </div>
							    <div class="row">
							    	<button class="btn waves-effect waves-light light-blue accent-3 col s12 m4 l4">Iniciar Sesión</button>
							    </div>
							    

		      				</form>
		      			</div>
		      		</div>	
      		</div>
      		<div id="panelDer" class="col s12 m4 l4 card-panel blue responsive-img hide-on-small-only" >
      			DER
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
		});
    </script>
</body>
</html>