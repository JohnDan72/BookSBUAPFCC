<?php 
	class UserModel 
	{
		
		public function insertUser($nombre,$ap1,$ap2,$tel,$correo,$pass1,$tipo){
			include "../config/database.php";		//Conexión a la base de datos
			$sqlAux = "SELECT correo 
			           from usuario 
			           WHERE correo = '$correo'
			           ;";
			$existeCorreo = mysqli_query($conexion,$sqlAux)->fetch_all(MYSQLI_ASSOC);
			if (!($existeCorreo)) {
				$sql = "
					INSERT INTO usuario (Nombre,Ap_Paterno,Ap_Materno,Correo,Passwd,Telefono,Tipo)
	       			VALUES('$nombre','$ap1','$ap2','$correo',AES_ENCRYPT('$pass1','$ClaveEncrypt'),'$tel',$tipo);
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