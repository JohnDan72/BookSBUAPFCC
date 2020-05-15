<?php
$ClaveEncrypt = "books_buap_12321";
$conexion = mysqli_connect("localhost","root","");
mysqli_select_db( $conexion, "books_buap" ) or die ( "Upps! Pues va a ser que no se ha podido conectar a la base de datos" );
mysqli_set_charset($conexion, "utf8");	//Establecer recuperacion de info en utf8 para acentos y tildes

?>