
	function soloNumeros(e){
		var precioCant = document.getElementById('id_precio');

	  		tecla = (document.all) ? e.keyCode : e.which;
	  		//console.log(e.keyCode+"  --  "+e.which);

	        // Patron de entrada, en este caso solo acepta numeros
	        patron = /[0-9]/;
	        tecla_final = String.fromCharCode(tecla);
	        if (patron.test(tecla_final)) {
	        	if (precioCant.value.length == 3) {
	        		precioCant.value = precioCant.value.slice(0,1)+","+precioCant.value.slice(1)+tecla_final;
	        		return false;
	        	}
	        	else return true;
	        }
	        return false;
	}
	function soloRetroceso(e){
		var precioCant = document.getElementById('id_precio');
		
		tecla = (document.all) ? e.keyCode : e.which;

		//Tecla de retroceso para borrar, siempre la permite
        if (tecla == 8) {
            if (precioCant.value.length >= 4) {
            	precioCant.value = precioCant.value.slice(0,1)+precioCant.value.slice(2,4);
            	return false;
        	}
        	else
        		return true;
        }
	}

	
	function fetchUploadLibro(){
		var formdat = new FormData(document.getElementById('id_form_Libro'));
		
		fetch("../fetch_files/validaActualizarLibro.php",{
			method: 'POST',
			body: formdat
		})
		.then((response) => {
			if (response.ok) {
				return response.json();
			}
			else{
				throw "Error al llamar fetch";
			}
		})
		.then((myJson) => {
			if (!myJson.titulo) {document.getElementById('id_titulo_error').style.display='block';}
			else{document.getElementById('id_titulo_error').style.display='none';}
			if (!myJson.area) {document.getElementById('id_area_error').style.display='block';}
			else{document.getElementById('id_area_error').style.display='none';}
			if (!myJson.descripcion) {document.getElementById('id_descrip_error').style.display='block';}
			else{document.getElementById('id_descrip_error').style.display='none';}
			if (!myJson.precio) {document.getElementById('id_precio_error').style.display='block';}
			else{document.getElementById('id_precio_error').style.display='none';}
			if (!myJson.edo_libro) {document.getElementById('id_edo_libro_error').style.display='block';}
			else{document.getElementById('id_edo_libro_error').style.display='none';}
			if (!myJson.foto) {document.getElementById('id_foto_error').style.display='block';}
			else{document.getElementById('id_foto_error').style.display='none';}
			
			if (myJson.titulo && myJson.area && myJson.descripcion && myJson.precio && myJson.edo_libro && myJson.foto) {
				

				
				document.getElementById('id_form_Libro').submit();
			}

		})
		.catch((exception) =>{
			console.log(exception);
		})
	}
	