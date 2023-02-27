<?php 
session_start();



unset($_SESSION['user']);
$_SESSION = array();


header('location: ../Accueil.php');
?>
