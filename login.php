<?php
include 'include/conn.php';
session_start();

// to prevent mysql injection.
$email=stripslashes($email);
$cpassword=stripslashes($cpassword);	 
$email=mysql_real_escape_string($email);
$cpassword=mysql_real_escape_string($cpassword);

if(isset($_POST['submit'])) {
$email = $_POST['email'];
$cpassword = $_POST['cpassword'];

// query database for login.
$sql="SELECT * FROM access WHERE email='".$email."' AND cpassword='".$cpassword."'";
 $query=mysql_query($sql);
 $recordset=mysql_fetch_array($query);
 $row=mysql_num_rows($query);

 if ($recordset['email']!=""){
 	$_SESSION['ID'] = $recordset['ID'];
	$_SESSION['email'] = $recordset['email'];
	$_SESSION['cpassword'] = $recordset['cpassword'];
 	header("Location: project1.php");
 }else if ($recordset['email']==""){
 	$_SESSION['ID'] = $recordset['ID'];
	$_SESSION['email'] = $recordset['email'];
	$_SESSION['cpassword'] = $recordset['cpassword'];
 	header("Location: login.php?attempt=login_failed");
 }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>PROJECT PORTFOLIO</title>
</head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
<link href="css/login.css" rel="stylesheet">

<body>
<div class="login-page">
	<div class="form">
	<img src="assets/img/icon.png" style="width: 60px;">
	<h3>Please Login to Continue.</h3>
	<?php
	// Display error message using PHP url.
	$allurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; 
	if (strpos($allurl, "attempt=login_failed") == true) {
		echo '<p class="err"><i class="fa fa-times" style="color: #f2f2f2; font-size: 20px;"></i> &nbsp; Incorrect UserID or Password.</p>';
	}
	 ?>
	<form method="POST">
		<input type="text" name="email" id="email" autocomplete="off" placeholder="Email" required autofocus />
		<input type="password" name="cpassword" id="cpassword" autocomplete="off" placeholder="Password" required />
		<button name="submit" id="submit" type="submit" >login</button>
			<p class="message">
				<a href="file:///C:/Users/Lenovo/Desktop/portfolio/index.html">Home</a> &nbsp; &nbsp; | &nbsp; &nbsp;
				<a href="register.php">Don't have an account? Register here.</a>
				<p style="color: grey;">- PROJECT PORTFOLIO</p>
			</p>
			
	</form>
	</div>
</div>
</body>
</html>