<?php
session_start();
unset($_SESSION['userdata']);
unset($_SESSION['filtro_actual']);
header("Location: index.php");
//exit();
?>