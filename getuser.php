<?php
	// $connection=mysqli_connect("localhost","root","","journals_data");
include('connection.php');
	$query="";
	$str=$_GET['q'];
	if($str=="publisher")
		$query="select distinct `pname` from `publisher`";
	else if($str=="subject")
		$query="select distinct `subject` from `journal`";
	else if($str=="school")
		$query="select distinct `school` from `journal`";
	else if($str=="mode_type")
		$query="select distinct `mode_type` from `journal`";

	$result=mysqli_query($connection,$query);	
	if(!$result)
			die("Error!");
	echo "<select id='inp' style='margin-top:5px; font-size: 15px;height: 30px;' name='data'>";
	while ($row = mysqli_fetch_row($result)) {
		if($str!='mode_type')
			echo "<option value='".$row[0]."'>".$row[0]."</option>";
		else{
			if($row[0]==0){
				echo "<option value='".$row[0]."'>Subscription</option>";
			}
			if($row[0]==1){
				echo "<option value='".$row[0]."'>Complementary</option>";
			}
		}
	}
//	echo "<br/>";
?>