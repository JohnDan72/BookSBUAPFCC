<?php 
	class LibroModel 
	{
		public function insertBook($post,$img_name,$id_vendedor){
			include "../config/database.php";		//Conexión a la base de datos
			$sql = "
				INSERT INTO libro (Titulo,Area,Descripcion,Precio,Edo_Libro,Imagen,Id_Vendedor)
       			VALUES('".$post['titulo']."',
       				   '".$post['area']."',
       				   '".$post['descripcion']."',
       				    ".$post['precio'].",
       				   '".$post['edo_libro']."',
       				   '".$img_name."',
       				    ".$id_vendedor."
       				  );
			";
			
			$result = mysqli_query($conexion,$sql);
			mysqli_close($conexion);
			return $result;
		}

		
	}
?>