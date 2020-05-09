	<footer class="page-footer grey darken-3">
	    <div class="container">
	        <div class="row">
	          <div class="col l6 s12">
	            <h5 class="white-text">Contacto</h5>
	            <p class="grey-text text-lighten-4">Para más información acerca del desarrollador consulta su link</p>
	          </div>
	          <div class="col l4 offset-l2 s12">
	          	<div class="row">
	          		<h5 class="white-text">Redes Sociales</h5>
	          	</div>
	            

	            <div class="row">
	            	<div class="col s2">
	            		<a href="https://www.facebook.com/jony.garcia.752/" target="blank">
	            			<img src="https://image.flaticon.com/icons/png/512/1384/1384021.png" width="50px" height="50px">
	            		</a>
	            	</div>
	            </div>
	          </div>
	        </div>
	    </div>
	    <div class="footer-copyright">
	        <div class="container">
	        Hecho por: Juan Daniel García López
	        </div>
	    </div>
    </footer>
	<!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script type="text/javascript">
    	M.AutoInit();

    	$(document).ready(function(){
    		$("#imgIndex").css({
	            "height": $(window).height() + "px"
	        });
    		$('.sidenav').sidenav();
		    $(".dropdown-trigger").dropdown({
		    	inDuration: 500,
				outDuration: 500,
				hover: true,
				coverTrigger: false
		    });
		    $('.parallax').parallax();
		});
    </script>