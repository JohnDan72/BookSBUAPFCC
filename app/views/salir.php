<?php
session_start();
unset($_SESSION['userdata']);
header("Location: index.php");
//exit();
?>