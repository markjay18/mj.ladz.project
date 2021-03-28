<?php
include 'include/conn.php';
include 'session1.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>PORTFOLIO</title>
</head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="jquery-ui-1.10.4.customs/themes/base/jquery.ui.all.css">
	<script src="js/jquery-1.10.2.js"></script>
	<script src="jquery-ui-1.10.4.customs/ui/jquery.ui.core.js"></script>
	<script src="jquery-ui-1.10.4.customs/ui/jquery.ui.widget.js"></script>
	<script src="jquery-ui-1.10.4.customs/ui/jquery.ui.tabs.js"></script>
	<script src="jquery-ui-1.10.4.customs/ui/jquery.ui.datepicker.js"></script>
	<script src="jquery-ui-1.10.4.customs/ui/jquery.ui.dialog.js"></script>
	<script src="js/jquery-1.10.2.js"></script>
	<script src="js/bootstrap.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
<link href="css/index.css" rel="stylesheet">

<script type="text/javascript">
	$(document).ready(function(){
	$('.search').keyup(function(){
		$('#tbl').hide();
	});
});
</script>

<script type="text/javascript">
	$(document).ready(function(){
	$('.search').keyup(function(){
		var txt=$(this).val();
		if (txt!='')
		{
		$.ajax({
			url:"fetch.php",
			method:"post",
			data:{searchQ:txt},
			dataType:"text",
			success:function(data)
			{
			$('#results').html(data);	
			}
		});
		}	
		else
		{
			$('#results').html('');
			$('#tbl').show();
		}
	});
});
</script>

<body>
	<div class="header">
		<p class="logo"><img src="assets/img/icon.png" style="width: 40px;"> &nbsp; &nbsp;<strong>|PORT</strong> FOLIO</p>
		<i class="fa fa-search" style="color: rgb(228 222 222); display: inline-block; font-size: 30px; margin-left: 260px; margin-top: 5px;"></i><input type="text" class="search" name="fetch" value="" placeholder="Search name">
		
	</div>

	<div class="menu">
		<p class="colour">Project #2 Demo</p><br>
		<p class="color">The power of autocomplete features. Automated filtering data from database shown in table format. It allows the user easy to monitor data.</p>
		<p class="line"></p>
		<p class="logout color">Sign out<a href="logout1.php" onclick="return confirm('Are you sure you want to logout?')"><i class="fa fa-sign-out" style="font-size: 20px; margin-left: 80px;"></i></a></p>
	</div>

	<div class="container">
		<div class="add-container">
			<table id="tbl">
				<tr>
					<th>Account</th>
					<th>Full Name</th>
					<th>Contact</th>
					<th>Email</th>
				</tr>
				<?php
					$sql="SELECT * FROM info";
	 				$query=mysql_query($sql);
	 				while($recordset=mysql_fetch_array($query)){
				?>
				<tr>
					<td><?php echo $recordset['account'];?></td>
					<td><?php echo $recordset['fullname'];?></td>
					<td><?php echo $recordset['contact'];?></td>
					<td><?php echo $recordset['email'];?></td>
				</tr>
				<?php	
				}
				?>
					<?php
						$sql="SELECT * FROM info";
						$query=mysql_query($sql);
						$recordset=mysql_fetch_array($query);
						$row = mysql_num_rows($query);
							if($row == 0){
								echo '<td colspan="6"><p style="width: 95.7%; text-align:center; color:#e56b62;">No record found in the table.</p></td>';
					}else{
								echo '';
					}
					?>
			</table>
			<div id="results"></div>
		</div>
	</div>	
</body>
</html>