<?php
session_start(); 
unset($_SESSION['entrato']);
unset($_SESSION['username']);
header("Location: home.php");
?>
