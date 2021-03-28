<?php
include 'include/conn.php';
include 'session2.php';
$record_per_page = 5;
$ID=0;
if(isset($_GET['ID'])){
 $ID = $_GET['ID'];
}else{
	$ID=1;
}

if(isset($_POST['submit'])){
		$item = $_POST['item'];
		$quantity = $_POST['quantity'];
		$price = $_POST['price'];
		$total = $_POST['total'];

		$sql = "INSERT INTO shofify (item, quantity, price, total) VALUES ('".$item."', '".$quantity."', '".$price."', '".$total."')"; 
		$insertl = mysql_query($sql) or die(mysql_error());

		header('Location: project3.php?succ=account_successfully_added');

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
	/*autocomplete product.*/
$(document).ready(function (){
$('#price').change(function (){
		var price = ($(this).val());
		var quantity = $('#quantity').val();  
		var total = parseFloat(price) * parseFloat(quantity);
		$("#total").val(total);
	});		
});
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
		<p class="colour">Project #3 Demo</p><br>
		<p class="color">Autocomplete calculation fields. Whatever the user input numbers the fields will automatically give the answer without calculator.</p>
		<p class="line"></p>
		<p class="logout color">Sign out<a href="logout2.php" onclick="return confirm('Are you sure you want to logout?')"><i class="fa fa-sign-out" style="font-size: 20px; margin-left: 80px;"></i></a></p>
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
		<form method="POST">	
			<table id="tbl">
				<tr>
					<th>Item</th>
					<th>Quantity</th>
					<th>Price</th>
					<th>Item Total</th>
				</tr>
				<tr>
					<td><input type="text" name="item" class="item" autofocus required></td>
					<td><input type="number" class="account" name="quantity" id="quantity" required></td>
					<td><input type="number" name="price" class="account" id="price" required></td>
					<td><input type="text" class="account" name="total" id="total" readonly></td>
				</tr>
			</table>
			<button class="submit" name="submit"><i class="fa fa-save"></i> Post</button>
		</form>
		</div>

		<div class="table-container">
			<table>
				<tr>
					<th>Item</th>
					<th>Quantity</th>
					<th>Price</th>
					<th>Item Total</th>
				</tr>
				<?php  
					$start_from = ($ID-1) * $record_per_page;
					$sql="SELECT * FROM shofify ORDER BY ID ASC LIMIT $start_from, $record_per_page";
	 				$query=mysql_query($sql);
	 				while($recordset=mysql_fetch_array($query)){
	 					$total+=$recordset['total'];
				?>
				<tr>
					<td><?php echo $recordset['item'];?></td>
					<td><?php echo $recordset['quantity'];?></td>
					<td><?php echo $recordset['price'];?></td>
					<td><?php echo $recordset['total'];?></td>
				</tr>
				<?php
				}
				?>
					<?php
						$sql="SELECT * FROM shofify";
						$query=mysql_query($sql);
						$recordset=mysql_fetch_array($query);
						$row = mysql_num_rows($query);
							if($row == 0){
								echo '<td colspan="6"><p style="width: 95.7%; text-align:center; color:#e56b62;">No record found in the table.</p></td>';
					}else{
								echo '';
					}
					?>
				<tr>
					<td colspan="3" class="subtotal">Subtotal</td>
					<td class="tot"><?php echo number_format($total, 2);?></td>
				</tr>
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
					echo "<a href='project3.php?ID=1'><button style='border: 1px solid rgb(228 222 222); border-radius: 2px; width: 40px; height: 30px; font-size: 16px; cursor: pointer; line-height: 15px; background: rgb(245 245 245); color: grey;'>first</button></a>";
					echo "<a href='project3.php?ID=".($ID - 1)."'><button style='border: 1px solid rgb(228 222 222); width: 30px; height: 30px; font-size: 16px; cursor: pointer; line-height: 15px; background: rgb(245 245 245); color: grey;'><<</button></a>";
				}
				for($i=$start_loop; $i<=$end_loop; $i++)
				{
					echo "<a href='project3.php?ID=".$i."'><button style='border: 1px solid rgb(228 222 222); width: 30px; height: 30px; font-size: 16px; cursor: pointer; line-height: 15px; background: rgb(245 245 245); color: grey;'>".$i."</button></a>";
				}
				if($ID <= $end_loop){
					echo "<a href='project3.php?ID=".($ID + 1)."'><button style='border: 1px solid rgb(228 222 222); width: 30px; height: 30px; font-size: 16px; cursor: pointer; line-height: 15px; background: rgb(245 245 245); color: grey;'>>></button></a>";
					echo "<a href='project3.php?ID=".$total_pages."'><button style='border: 1px solid rgb(228 222 222); border-radius: 2px; width: 40px; height: 30px; font-size: 16px; cursor: pointer; line-height: 15px; background: rgb(245 245 245); color: grey;'>last</button></a>";

				}
			?>

		</div>



	</div>	
</body>
</html>