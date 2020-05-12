<?php
  $usu=$_POST['correo'];
  $pas=$_POST['passwd'];

  $conexion = mysqli_connect("localhost","root","");
  mysqli_select_db( $conexion, "books_buap" ) or die ( "Upps! Pues va a ser que no se ha podido conectar a la base de datos" );
  mysqli_set_charset($conexion, "utf8");  //Establecer recuperacion de info en utf8 para acentos y tildes
  
  $claveSQL = "books_buap_12321";
  $sql = "SELECT * 
          FROM usuario 
          WHERE Correo = '$usu' AND Passwd = AES_ENCRYPT('$pas','$claveSQL')
          ;";
  $result = mysqli_query($conexion,$sql);
  $data = $result->fetch_all(MYSQLI_ASSOC);
  mysqli_close($conexion);


  if ($data) {
    session_start();
    $_SESSION['userdata'] = $data[0];
    echo json_encode($data);
  }
  else{
    echo json_encode("Error/Error, correo y/o contraseña incorrecto(s)");
  }
?>