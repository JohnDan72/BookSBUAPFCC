<?php 
	class FAQModel 
	{	

		public function getFaqs(){
			include "../config/database.php";
			$sql1 = "
					SELECT * FROM faq;
					";
			$data = mysqli_query($conexion,$sql1)->fetch_all(MYSQLI_ASSOC);

			return $data;
		}

	}
?>