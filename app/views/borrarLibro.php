<?php
session_start();
if (!isset($_SESSION['userdata'])) {
	header("Location: libros.php");
	exit();
}
if (!isset($_REQUEST['id_libro'])) {
	header("Location: index.php");
	exit();
}

//BORRAR LIBRO ENVIADO POR DELETE
require("../models/libroModel.php");	//cargamos model
$model = new LibroModel();				//instanciamos model

$success = $model->deleteLibroById($_REQUEST['id_libro'],$_SESSION['userdata']['Id']); //intentamos borrar
if ($success) {
	header("Location: gestionLibros.php?response=2");
	exit();
}
else{
	header("Location: gestionLibros.php?response=-1");
	exit();
}
?>