	<footer>
		
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
		});
    </script>