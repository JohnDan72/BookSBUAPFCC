<?php 
	class HistoryModel 
	{
		public function insertVenta($post){
			include "../config/database.php";		//Conexión a la base de datos
			$sqlAux = "SELECT Id_Libro FROM historial WHERE Id_Libro = ".$post['Id_Libro'].";";
			$vendido = mysqli_query($conexion,$sqlAux)->fetch_all(MYSQLI_ASSOC);

			if (!$vendido) {
				$fecha_hora = mysqli_query($conexion,"SELECT now() as Fecha")->fetch_all(MYSQLI_ASSOC)[0]['Fecha'];

				$sql = "
					INSERT INTO historial (Id_Libro,Id_Vendedor,Id_Cliente,Fecha_Hora)
	       			VALUES(".$post['Id_Libro'].",
	       				   ".$post['Id_Vendedor'].",
	       				   ".$post['Id_Cliente'].",
	       				   '".$fecha_hora."'
	       				  );
					";
				
				$result = mysqli_query($conexion,$sql);

				$updateLibro = mysqli_query($conexion,"UPDATE Libro set Vendido = 1 WHERE Id = ".$post['Id_Libro'].";");
				mysqli_close($conexion);
				return $result;
			}
			else
				return false;
		}

		public function getInfoVenta($id_client,$id_vend,$id_libro){
			include "../config/database.php";		//Conexión a la base de datos
			$sql = "
					SELECT Nombre,Ap_Paterno,Correo,Telefono,Matricula,Carrera
					FROM Usuario
					WHERE Id = $id_client;
				";
			$sql2 = "
					SELECT Nombre,Ap_Paterno,Correo,Telefono,Matricula,Carrera
					FROM Usuario
					WHERE Id = $id_vend;
				";
			$sql3 = "
					SELECT Id,Titulo,Area,Precio,Imagen,Edo_Libro
					FROM Libro
					WHERE Id = $id_libro;
				";
			$datClient = mysqli_query($conexion,$sql)->fetch_all(MYSQLI_ASSOC)[0];
			$datVend = mysqli_query($conexion,$sql2)->fetch_all(MYSQLI_ASSOC)[0];
			$datLibro = mysqli_query($conexion,$sql3)->fetch_all(MYSQLI_ASSOC)[0];



			$result['Nombre1'] = $datClient['Nombre'];
			$result['Ap_Paterno1'] = $datClient['Ap_Paterno'];
			$result['Correo1'] = $datClient['Correo'];
			$result['Tel1'] = $datClient['Telefono'];
			$result['Matri1'] = $datClient['Matricula'];
			$result['Carrera1'] = $datClient['Carrera'];

			$result['Nombre2'] = $datVend['Nombre'];
			$result['Ap_Paterno2'] = $datVend['Ap_Paterno'];
			$result['Correo2'] = $datVend['Correo'];
			$result['Tel2'] = $datVend['Telefono'];
			$result['Matri2'] = $datVend['Matricula'];
			$result['Carrera2'] = $datVend['Carrera'];

			$result['Id_Libro'] = $datLibro['Id'];
			$result['Titulo'] = $datLibro['Titulo'];
			$result['Area'] = $datLibro['Area'];
			$result['Precio'] = $datLibro['Precio'];
			$result['Imagen'] = $datLibro['Imagen'];
			$result['Edo_Libro'] = $datLibro['Edo_Libro'];
			
			mysqli_close($conexion);
			return $result;
		}

		public function generarPDF($post){
			require('../libraries/PDF library/fpdf16/fpdf.php');
			$pdf=new FPDF();
			//Primera página
			$pdf->AddPage();

			$pdf->Image('../../public/img/Logo2.jpg' , 20 ,20, 60 , 30,'JPG');
			$pdf->Image("../../public/img/imgLibros/".$post['Imagen'] , 135,110, 60 , 90,'JPG');

			$pdf->SetFont('Arial','B',16);
			$pdf->Cell(180,40,utf8_decode('Book Store - BUAP'),0,1,'R');
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(190,5,utf8_decode('_____________________________________________________________________________'),0,1,'C');
			$pdf->SetFont('Arial','',14);
			$pdf->Cell(185,20,utf8_decode('COMPROBANTE DE PEDIDO DE LIBRO'),0,1,'C');

			$cadAux = "Gracias por elegir BookS-BUAP, este documento avala tu pedido realizado en la aplicación web. A continuación, se muestra la información acerca del pedido; tales incluyen: su información personal (comprobar que todo esté correctamente), la información del vendedor, y la del libro en sí. Cualquier duda o aclaración puede consultarlo a través del sitio web, en la sección de FAQ\n\n";
			$pdf->SetFont('Arial','',12);
			$pdf->Write(5,utf8_decode($cadAux));
			$pdf->Write(15,utf8_decode(""));

			$pdf->SetFont('Arial','B',12);
			$pdf->Cell(100,15,utf8_decode("Información Acreedor\n"),0,1,'L');
			$pdf->SetFont('Arial','',12);
			$cadAux1 = "Matrícula: ".$post['Matri1'];
			$cadAux2 = "Nombre: ".$post['Nombre1']." ".$post['Ap_Paterno1'];
			$cadAux3 = "Correo: ".$post['Correo1'];
			$cadAux4 = "Carrera: ".$post['Carrera1'];
			$cadAux5 = "Teléfono: ".$post['Tel1'];

			$pdf->Cell(120,5,utf8_decode($cadAux1),0,1);
			$pdf->Cell(120,5,utf8_decode($cadAux2),0,1);
			$pdf->Cell(120,5,utf8_decode($cadAux3),0,1);
			$pdf->Cell(120,5,utf8_decode($cadAux4),0,1);
			$pdf->Cell(120,5,utf8_decode($cadAux5),0,1);
			$pdf->Cell(120,5,utf8_decode(""),0,1);

			$pdf->SetFont('Arial','B',12);
			$pdf->Cell(100,15,utf8_decode("Información Vendedor\n"),0,1,'L');
			$pdf->SetFont('Arial','',12);
			$cadAux1 = "Matrícula: ".$post['Matri2'];
			$cadAux2 = "Nombre: ".$post['Nombre2']." ".$post['Ap_Paterno2'];
			$cadAux3 = "Correo: ".$post['Correo2'];
			$cadAux4 = "Carrera: ".$post['Carrera2'];
			$cadAux5 = "Teléfono: ".$post['Tel2'];

			$pdf->Cell(120,5,utf8_decode($cadAux1),0,1);
			$pdf->Cell(120,5,utf8_decode($cadAux2),0,1);
			$pdf->Cell(120,5,utf8_decode($cadAux3),0,1);
			$pdf->Cell(120,5,utf8_decode($cadAux4),0,1);
			$pdf->Cell(120,5,utf8_decode($cadAux5),0,1);
			$pdf->Cell(120,5,utf8_decode(""),0,1);

			$pdf->SetFont('Arial','B',12);
			$pdf->Cell(100,15,utf8_decode("Información del Libro\n"),0,1,'L');
			$pdf->SetFont('Arial','',12);
			$cadAux1 = "Título: ".$post['Titulo'];
			$cadAux2 = "Área: ".$post['Area'];
			$cadAux3 = "Precio: $".$post['Precio'];
			$cadAux4 = "Estado: ".$post['Edo_Libro'];

			$pdf->Cell(120,5,utf8_decode($cadAux1),0,1);
			$pdf->Cell(120,5,utf8_decode($cadAux2),0,1);
			$pdf->Cell(120,5,utf8_decode($cadAux3),0,1);
			$pdf->Cell(120,5,utf8_decode($cadAux4),0,1);
			$pdf->Cell(120,30,utf8_decode(""),0,1);


			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(190,5,utf8_decode('___________________________                          ____________________________'),0,1,'C');
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(190,10,utf8_decode('                                          Firma Acreedor                                                     Firma Vendedor'),0,1);

			$pdf->Output("../../public/files/pdfs/comprobante_libro_".$post['Id_Libro'].".pdf"); //guardar en carpeta
			//$pdf->Output('doc.pdf','D'); //descargar en el usuario
			return "comprobante_libro_".$post['Id_Libro'].".pdf"; //nombre del file para abrir en navegador
		}

		public function getLibrosComprados($id_comprador){
			include "../config/database.php";

			$sql = "
					SELECT 	historial.Id_Libro,historial.Fecha_Hora,
							libro.Titulo,libro.Area,libro.Precio,libro.Imagen,libro.Edo_Libro,
					        us1.Nombre AS Nom_Client,us1.Correo AS Cor_Client,
					        us2.Nombre AS Nom_Vend,us2.Correo AS Cor_Vend
					FROM historial
					LEFT JOIN usuario AS us1 ON us1.Id = historial.Id_Cliente
					LEFT JOIN usuario AS us2 ON us2.Id = historial.Id_Vendedor
					LEFT JOIN libro ON libro.Id = historial.Id_Libro
					WHERE historial.Id_Cliente = $id_comprador
					ORDER BY Fecha_Hora DESC;
				   ";
			$data = mysqli_query($conexion,$sql)->fetch_all(MYSQLI_ASSOC);
			mysqli_close($conexion);
			return $data;
		}

		public function getLibrosSubidos($id_vend){
			include "../config/database.php";

			$sql = "
					SELECT 	*
					FROM libro
					WHERE Id_Vendedor = $id_vend
					ORDER BY Fecha_Subido DESC;
				   ";
			$data = mysqli_query($conexion,$sql)->fetch_all(MYSQLI_ASSOC);
			mysqli_close($conexion);
			return $data;
		}

		public function getLibrosVendidos($id_vend){
			include "../config/database.php";

			$sql = "
					SELECT 	historial.Id_Libro,historial.Fecha_Hora,
							libro.Titulo,libro.Area,libro.Precio,libro.Imagen,libro.Edo_Libro,
					        us1.Nombre AS Nom_Client,us1.Correo AS Cor_Client,
					        us2.Nombre AS Nom_Vend,us2.Correo AS Cor_Vend
					FROM historial
					LEFT JOIN usuario AS us1 ON us1.Id = historial.Id_Cliente
					LEFT JOIN usuario AS us2 ON us2.Id = historial.Id_Vendedor
					LEFT JOIN libro ON libro.Id = historial.Id_Libro
					WHERE historial.Id_Vendedor = $id_vend
					ORDER BY Fecha_Hora DESC;
				   ";
			$data = mysqli_query($conexion,$sql)->fetch_all(MYSQLI_ASSOC);
			mysqli_close($conexion);
			return $data;
		}


	
	}
?>