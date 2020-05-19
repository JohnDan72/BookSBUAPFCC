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
		public function getTotalPages($no_of_records_per_page,$filtro,$id_user = 0){
			include "../config/database.php";		//Conexión a la base de datos
			$whereSentence = "";
			//se cuentan los registros dependiendo del filtro
			switch ($filtro) {
				case '1':$whereSentence = "WHERE Vendido = 0";break;
				case '2':$whereSentence = "WHERE Area = 'Computación' AND Vendido = 0";break;
				case '3':$whereSentence = "WHERE Area = 'Física' AND Vendido = 0";break;
				case '4':$whereSentence = "WHERE Area = 'Hardware' AND Vendido = 0";break;
				case '5':$whereSentence = "WHERE Area = 'Matemáticas' AND Vendido = 0";break;
				case '6':$whereSentence = "WHERE Area = 'Otros' AND Vendido = 0";break;
				case '7':$whereSentence = "WHERE Vendido = 0";break;
				case '8':$whereSentence = "WHERE Vendido = 1";break;
				
			}
			$whereSentence.= " AND Id_Vendedor <> $id_user";
			//echo "$whereSentence<br>";
			$sql_total_pages = "SELECT COUNT(*) FROM libro $whereSentence";
		    $result = mysqli_query($conexion,$sql_total_pages);
		    $total_rows = mysqli_fetch_array($result)[0];
		    $total_pages = ceil($total_rows / $no_of_records_per_page);
			
			mysqli_close($conexion);
			return $total_pages;
		}

		public function getDataCurrentPage($offset,$no_of_records_per_page,$filtro,$id_user = 0){
			include "../config/database.php";		//Conexión a la base de datos

			$whereSentence = "";
			//se cuentan los registros dependiendo del filtro
			switch ($filtro) {
				case '1':$whereSentence = " AND Vendido = 0 AND Id_Vendedor <> $id_user ORDER BY Titulo ";break;
				case '2':$whereSentence = " AND Vendido = 0 AND Area = 'Computación'AND Id_Vendedor <> $id_user  ORDER BY Titulo ";break;
				case '3':$whereSentence = " AND Vendido = 0 AND Area = 'Física'AND Id_Vendedor <> $id_user  ORDER BY Titulo ";break;
				case '4':$whereSentence = " AND Vendido = 0 AND Area = 'Hardware'AND Id_Vendedor <> $id_user  ORDER BY Titulo ";break;
				case '5':$whereSentence = " AND Vendido = 0 AND Area = 'Matemáticas'AND Id_Vendedor <> $id_user  ORDER BY Titulo ";break;
				case '6':$whereSentence = " AND Vendido = 0 AND Area = 'Otros'AND Id_Vendedor <> $id_user  ORDER BY Titulo ";break;
				case '7':$whereSentence = " AND Vendido = 0 AND Id_Vendedor <> $id_user ORDER BY Precio ";break;
				case '8':$whereSentence = " AND Vendido = 1 AND Id_Vendedor <> $id_user ORDER BY Titulo ";break;
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