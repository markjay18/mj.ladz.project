<?php
session_start();
if(!empty($_SESSION['ID'])) {
$ID = $_SESSION['ID'];
$email = $_SESSION['email'];
$cpassword = $_SESSION['cpassword'];
}else{
		header("Location: login.php");	
}
?>
