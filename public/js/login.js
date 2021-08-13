
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
	            document.getElementById('id_pass').value = "";
	            $("#panelDer").css({
		            "height": $(".card-panel").height() + "px"
		        });
	        }
	    })
	    .catch(function(err) {
	       console.log(err);
	    });
	}

	function inputKey(e){
	  		tecla = (document.all) ? e.keyCode : e.which;
	        //checa fetch si se teclea enter
	        if (tecla == 13) {
	            return fetchLogin();
	        }
	}