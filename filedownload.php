<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment;Filename=document_name.xls");
?>

<?php
	// $connection=mysqli_connect("localhost","root","","journals_data");
	include('connection.php');
	$result=mysqli_query($connection,"select * from publisher");
	while($row=mysqli_fetch_row($result)){
		$i=0;
		while($i<2){
			echo $row[$i]."  ";
			$i++;	
		}
		echo "<br/>";
	}
?>