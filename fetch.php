<?php
include 'include/conn.php';

$output="";
$sql="SELECT * FROM info WHERE fullname LIKE '%".$_POST["searchQ"]."%'" or die("could not search");
$result=mysql_query($sql);
if(mysql_num_rows($result) > 0)
{	
		 	$output .='<table style="width: 100%;" >
					<tr>
					<th>Account</th>
					<th>Fullname</th>
					<th>Contact</th>
					<th>Email</th>
					</tr>';		

		 			while($row = mysql_fetch_array($result)){
			$output .='<tr>
					<td>'.$row['account'].'</td>
					<td>'.$row['fullname'].'</td>
					<td>'.$row['contact'].'</td>
					<td>'.$row['email'].'</td>';
		 }
					echo $output;
}
else
{
	echo '<p class="err">No search results found.</p>';  
}
?>