<?php
include 'include/conn.php';
include 'session.php';
$record_per_page = 5;
$ID=0;
if(isset($_GET['ID'])){
 $ID = $_GET['ID'];
}else{
	$ID=1;
}

if(isset($_POST['submit'])){
		$account = $_POST['account'];
		$fullname = $_POST['fullname'];
		$contact = $_POST['contact'];
		$email = $_POST['email'];


	/*insert data from table rows.*/
	foreach ($account as $key => $value) {

		$sql = "INSERT INTO info (account, fullname, contact, email) VALUES ('".$value."', '".$fullname[$key]."', '".$contact[$key]."', '".$email[$key]."')"; 
		$insertl = mysql_query($sql) or die(mysql_error());

		header('Location: project1.php?succ=account_successfully_added');

		}
	}

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
	$(document).ready(function (){
		var html = '<tr><td><input type="text" name="account[]" class="account" autofocus></td><td><input type="text" name="fullname[]"></td><td><input type="number" name="contact[]" value="09"></td><td><input type="text" name="email[]"></td><td><button class="add" name="add" id="remove"><i class="fa fa-trash"></i></button></td></tr>';


		$('#add').click(function(){
			$('#tbl').append(html);
		});
		$('#tbl').on('click','#remove', function(){
			$(this).closest('tr').remove();
		});
	});
</script>
<script type="text/javascript">
	/*Delete record onclick.*/
		function popDelete(url){
			if(confirm("Do you really want to delete this data?")){
				window.location.href=url;
			}
			return false;
		}
</script>
<script type="text/javascript">
	/*close*/
	$(document).ready(function (){
		$('#close').click(function (){
		$('.succ').hide();
	});
});
</script>
<body>
	<div class="header">
		<p class="logo"><img src="assets/img/icon.png" style="width: 40px;"> &nbsp; &nbsp;<strong>|PORT</strong> FOLIO</p>
			
		
	</div>

	<div class="menu">
		<p class="colour">Project #1 Demo</p><br>
		<p class="color">This features allows the user to insert multiple records in single form submit and view all records at the same page with pagination.</p>
		<p class="color procedures">Record per page (5).</p>
		<p class="color">Add row, Remove row, Delete row.</p>
		<p class="line"></p>
		<p class="logout color">Sign out<a href="logout.php" onclick="return confirm('Are you sure you want to logout?')"><i class="fa fa-sign-out" style="font-size: 20px; margin-left: 80px;"></i></a></p>
	</div>

	<div class="container">
		<div class="add-container">
			<?php
				// display success message using PHP with url.
				$allurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; 
					if (strpos($allurl, "succ=account_successfully_added") == true) {
						echo '<p class="succ"><i class="fa fa-check" style="color: #f2f2f2; font-size: 20px;"></i> &nbsp; Data has been successfully inserted. <i class="fa fa-times" id="close" style="color: #f2f2f2; font-size: 20px; margin-left: 71%;"></i></p>';
					}
			?>
		<form method="POST" onsubmit="return confirmSubmit('ARE YOU SURE YOU WANT TO CONTINUE?')">
			<table id="tbl">
				<tr>
					<th>Account</th>
					<th>Full Name</th>
					<th>Contact</th>
					<th>Email</th>
					<th>Action</th>
				</tr>
				<tr>
					<td><input type="text" name="account[]" class="account" autofocus required/></td>
					<td><input type="text" name="fullname[]" required/></td>
					<td><input type="number" name="contact[]" value="09" required/></td>
					<td><input type="text" name="email[]" required/></td>
					<td><a href="#" id="add" class="btn"><i class="fa fa-plus"></i></a></td>
				</tr>
			</table>
			<button class="submit" name="submit"><i class="fa fa-save"></i> Post</button>
		</form>
		</div>

		<div class="table-container">
			<table>
				<tr>
					<th>Account</th>
					<th>Full Name</th>
					<th>Contact</th>
					<th>Email</th>
					<th>Action</th>
				</tr>
				<?php  
					$start_from = ($ID-1) * $record_per_page;
					$sql="SELECT * FROM info ORDER BY ID ASC LIMIT $start_from, $record_per_page";
	 				$query=mysql_query($sql);
	 				while($recordset=mysql_fetch_array($query)){
	 					$num++;
				?>
				<tr>
					<td><?php echo $recordset['account'];?></td>
					<td><?php echo $recordset['fullname'];?></td>
					<td><?php echo $recordset['contact'];?></td>
					<td><?php echo $recordset['email'];?></td>
					<td><a href="#tbl_data" onclick="popDelete('delete.php?ID=<?php echo $recordset['ID'];?>')" ><button class="del"><i class="fa fa-trash"></i></button></a></td>
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
			<?php
				$total_records = mysql_num_rows($query);
				$total_pages = ceil($total_records/$record_per_page);
				$start_loop = $ID;
				$difference = $total_pages - $ID;
				if($difference <= 5){
					$start_loop - 5;
				}
					$end_loop = $start_loop + 2;

				if($ID > 1){
					echo "<a href='project1.php?ID=".($ID - 1)."'><button style='border: 1px solid rgb(228 222 222); width: 90px; height: 30px; font-size: 16px; cursor: pointer; line-height: 15px; background: rgb(245 245 245); color: grey;  border-radius: 4px 0px 0px 4px;'>Previous</button></a>";
				}
				for($i=$start_loop; $i<=$end_loop; $i++)
				{
					echo "<a href='project1.php?ID=".$i."'><button style='border: 1px solid rgb(228 222 222); width: 30px; height: 30px; font-size: 16px; cursor: pointer; line-height: 15px; background: rgb(245 245 245); color: grey;'>".$i."</button></a>";
				}
				if($ID <= $end_loop){
					echo "<a href='project1.php?ID=".($ID + 1)."'><button style='border: 1px solid rgb(228 222 222); width: 60px; height: 30px; font-size: 16px; cursor: pointer; line-height: 15px; background: rgb(245 245 245); color: grey; border-radius: 0px 4px 4px 0px;'>Next</button></a>";

				}
			?>
			<p style="color: grey; float: left; margin-right: 58%;">Showing page <?php echo $total_pages = $ID;?> of <?php echo $num; ?> entries </p><br><br>
		</div>
		</div>

	</div>	
</body>
</html>