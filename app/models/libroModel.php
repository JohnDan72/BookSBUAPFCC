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


		/*	FILTROS
			1 - Nombre
			2 - Computación
			3 - Física
			4 - Hardware
			5 - Matemáticas
			6 - Otros
			7 - Precio
			8 - Vendidos
		*/
		public function getTotalPages($no_of_records_per_page,$filtro){
			include "../config/database.php";		//Conexión a la base de datos
			$whereSentence = "";
			//se cuentan los registros dependiendo del filtro
			switch ($filtro) {
				case '2':$whereSentence = "WHERE Area = 'Computación'";break;
				case '3':$whereSentence = "WHERE Area = 'Física'";break;
				case '4':$whereSentence = "WHERE Area = 'Hardware'";break;
				case '5':$whereSentence = "WHERE Area = 'Matemáticas'";break;
				case '6':$whereSentence = "WHERE Area = 'Otros'";break;
				case '8':$whereSentence = "WHERE Vendido = 1";break;
				
			}
			//echo "$whereSentence<br>";
			$sql_total_pages = "SELECT COUNT(*) FROM libro $whereSentence";
		    $result = mysqli_query($conexion,$sql_total_pages);
		    $total_rows = mysqli_fetch_array($result)[0];
		    $total_pages = ceil($total_rows / $no_of_records_per_page);
			
			mysqli_close($conexion);
			return $total_pages;
		}

		public function getDataCurrentPage($offset,$no_of_records_per_page,$filtro){
			include "../config/database.php";		//Conexión a la base de datos

			$whereSentence = "";
			//se cuentan los registros dependiendo del filtro
			switch ($filtro) {
				case '1':$whereSentence = " ORDER BY Titulo ";break;
				case '2':$whereSentence = " AND Area = 'Computación'  ORDER BY Titulo ";break;
				case '3':$whereSentence = " AND Area = 'Física'  ORDER BY Titulo ";break;
				case '4':$whereSentence = " AND Area = 'Hardware'  ORDER BY Titulo ";break;
				case '5':$whereSentence = " AND Area = 'Matemáticas'  ORDER BY Titulo ";break;
				case '6':$whereSentence = " AND Area = 'Otros'  ORDER BY Titulo ";break;
				case '7':$whereSentence = " ORDER BY Precio ";break;
				case '8':$whereSentence = " AND Vendido = 1  ORDER BY Titulo ";break;
			}

			$sql = "
					SELECT libro.*,usuario.Nombre,usuario.Ap_Paterno,usuario.Correo,usuario.Telefono 
					from libro,usuario 
					WHERE usuario.Id = libro.Id_Vendedor $whereSentence
					LIMIT $offset,$no_of_records_per_page;
					";

			$data = mysqli_query($conexion,$sql)->fetch_all(MYSQLI_ASSOC);
    		return $data;
		}

		
	}
?>