<?php
include 'include/conn.php';

if(isset($_POST['submit'])){
$email = mysql_real_escape_string($_POST['email']);
$cpassword = mysql_real_escape_string($_POST['cpassword']);

$sql = "INSERT INTO access(email, cpassword) VALUES ('".$email."', '".$cpassword."')";
$insert = mysql_query($sql) or die(mysql_error());

header('Location: register.php?succ=account_successfully_added');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>PROJECT PORTFOLIO</title>
</head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="js/jquery-1.10.2.js"></script>
	<script src="jquery-ui-1.10.4.customs/ui/jquery.ui.core.js"></script>
	<script src="jquery-ui-1.10.4.customs/ui/jquery.ui.widget.js"></script>
	<script src="jquery-ui-1.10.4.customs/ui/jquery.ui.tabs.js"></script>
	<script src="jquery-ui-1.10.4.customs/ui/jquery.ui.datepicker.js"></script>
	<script src="jquery-ui-1.10.4.customs/ui/jquery.ui.dialog.js"></script>
	<script src="js/jquery-1.10.2.js"></script>
	<script src="js/bootstrap.js"></script>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
<link href="css/dashboard.css" rel="stylesheet">

<link href="css/login.css" rel="stylesheet">

<script type="text/javascript">
	function validate(){
		var password = document.getElementById('password').value;
		var cpassword = document.getElementById('cpassword').value;

		if (password != cpassword){
			alert("Password Mismatch. Please try again!");
			document.getElementById('password').style.boxShadow = "0 0 5px rgba(81, 203, 238, 1)";
			document.getElementById('cpassword').style.boxShadow = " 0 0 5px rgba(81, 203, 238, 1)";
			document.getElementById('show').style.display = "block";
			return false
		}else{
			alert('Account successfully added ready, to use for login portal.')
		}
		
	}
</script>
<body>
<div class="login-page">
	<div class="form">
		<img src="assets/img/icon.png" style="width: 60px;">
		<h3>Please Register.</h3>
		<p id="show" class="err" style="display:none;">Password mismatch! Please try again.</p>
		<?php
			// display success message using PHP with url.
			$allurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; 
				if (strpos($allurl, "succ=account_successfully_added") == true) {
					echo '<p class="succ"><i class="fa fa-check" style="color: #f2f2f2; font-size: 20px;"></i> &nbsp; Congratulations! Account successfully added! You can now Login to your account.</p>';
				}
		?>
		<form method="POST"  onsubmit="return validate()">
			<input type="text" name="email" id="email" autocomplete="off" placeholder="Email" required autofocus />
			<input type="password" name="password" id="password" autocomplete="off" placeholder="Password" required />
			<input type="password" name="cpassword" id="cpassword" autocomplete="off" placeholder="Confirm Password" title="rpassword" required />
			<button name="submit" id="submit" type="submit" >Confirm</button>
				<p class="message">
					<a href="./">Home</a> &nbsp; &nbsp; | &nbsp; &nbsp;
					<a href="login.php">Already have an account? Login</a>
					<p style="color: grey;">- PROJECT PORTFOLIO</p>
				</p>	
		</form>
	</div>
</div>
</body>
</html>