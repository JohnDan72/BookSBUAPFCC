<?php 
	class LibroModel 
	{	

		public function getInfoLibro($id_libro,$id_owner){
			include "../config/database.php";
			$sql1 = "
					SELECT * FROM libro WHERE Id = $id_libro AND Id_Vendedor = $id_owner AND Vendido = 0;
					";
			$data = mysqli_query($conexion,$sql1)->fetch_all(MYSQLI_ASSOC);

			if ($data)
				return $data[0];

			return false;
		}

		public function getMyBooks($id_user){
			include "../config/database.php";
			$sql = "
					SELECT * FROM libro WHERE Id_Vendedor = $id_user  AND Vendido = 0;
					";
			$data = mysqli_query($conexion,$sql)->fetch_all(MYSQLI_ASSOC);
			return $data;
		}

		public function insertBook($post,$img_name,$id_vendedor){
			include "../config/database.php";		//Conexión a la base de datos
			$fecha = mysqli_query($conexion,"SELECT now() as Fecha")->fetch_all(MYSQLI_ASSOC)[0]['Fecha'];
			$sql = "
				INSERT INTO libro (Titulo,Area,Descripcion,Precio,Edo_Libro,Imagen,Id_Vendedor,Fecha_Subido)
       			VALUES('".$post['titulo']."',
       				   '".$post['area']."',
       				   '".$post['descripcion']."',
       				    ".$post['precio'].",
       				   '".$post['edo_libro']."',
       				   '".$img_name."',
       				    ".$id_vendedor.",
       				    '".$fecha."'
       				  );
			";
			
			$result = mysqli_query($conexion,$sql);
			mysqli_close($conexion);
			return $result;
		}

		public function updateLibro1($post,$img_name){
			include "../config/database.php";		//Conexión a la base de datos
			$sql = "
				UPDATE libro 
				SET 	Titulo 		= '".$post['titulo']."',
						Area		= '".$post['area']."',
				        Descripcion	= '".$post['descripcion']."',
				        Edo_Libro	= '".$post['edo_libro']."',
				        Imagen		= '".$img_name."',
				        Precio		=  ".$post['precio']."
				WHERE   Id = ".$post['id_libro_anterior'].";
			";
			
			$result = mysqli_query($conexion,$sql);
			mysqli_close($conexion);
			return $result;
		}
		public function updateLibro2($post,$postAnt){
			//se checa cambios
			if ($post['titulo']==$postAnt['Titulo'] && $post['area']==$postAnt['Area'] && $post['descripcion']==$postAnt['Descripcion'] && $post['edo_libro']==$postAnt['Edo_Libro'] && $post['precio']==$postAnt['Precio']) {
				return 0;

			}
			//con cambios
			include "../config/database.php";		//Conexión a la base de datos
			$sql = "
				UPDATE libro 
				SET 	Titulo 		= '".$post['titulo']."',
						Area		= '".$post['area']."',
				        Descripcion	= '".$post['descripcion']."',
				        Edo_Libro	= '".$post['edo_libro']."',
				        Precio		=  ".$post['precio']."
				WHERE   Id = ".$post['id_libro_anterior'].";
			";
			
			$result = mysqli_query($conexion,$sql);
			mysqli_close($conexion);
			if ($result)
				return 1;
			return -1;
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
			if ($filtro!=8)
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
				case '8':$whereSentence = " AND Vendido = 1 ORDER BY Titulo ";break;
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