<?php 
	class UserModel 
	{
		
		public function insertUser($nombre,$ap1,$ap2,$tel,$correo,$pass1,$tipo,$matri,$carrera){
			include "../config/database.php";		//Conexión a la base de datos
			//comprobar correo
			$sqlAux = "SELECT correo 
			           from usuario 
			           WHERE correo = '$correo'
			           ;";
			//comprobar matrícula
			$sqlAux2 = "SELECT matricula 
			           from usuario 
			           WHERE matricula = $matri
			           ;";
			$existeCorreo = mysqli_query($conexion,$sqlAux)->fetch_all(MYSQLI_ASSOC);
			$existeMatri  = mysqli_query($conexion,$sqlAux2)->fetch_all(MYSQLI_ASSOC);
			if (!($existeCorreo) && !($existeMatri)) {
				$sql = "
					INSERT INTO usuario (Nombre,Ap_Paterno,Ap_Materno,Correo,Passwd,Telefono,Tipo,Matricula,Carrera)
	       			VALUES('$nombre','$ap1','$ap2','$correo',AES_ENCRYPT('$pass1','$ClaveEncrypt'),'$tel',$tipo,$matri,'$carrera');
				";
				
				$result = mysqli_query($conexion,$sql);
				mysqli_close($conexion);
				return $result;
			}
			mysqli_close($conexion);
			return false;
		}

	}
?>