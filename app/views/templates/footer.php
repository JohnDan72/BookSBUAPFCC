	<footer>
		
	</footer>
	<!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script type="text/javascript">
    	M.AutoInit();

    	

    	$('.pushpin-demo-nav').each(function() {
		    var $this = $(this);
		    var $target = $('#' + $(this).attr('data-target'));
		    $this.pushpin({
		      top: $target.offset().top,
		      bottom: $target.offset().top + $target.outerHeight() - $this.height()
		    });
		});


    	$(document).ready(function(){
    		$('.pushpin').pushpin();
		    $(".dropdown-trigger").dropdown();
		});
    </script>