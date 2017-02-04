<html>
	<head>
		 <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
  <script src="bootstrap/bootstrap.min.js"></script>
  <script src="bootstrap/tableHeadFixer.js"></script>
		<style>
			a{
	text-decoration:none;	
}
/* unvisited link */
a:link {
    color: blue;
}

/* visited link */
a:visited {
    color: blue;
}

/* mouse over link */
a:hover {
    color: blue;
}

/* selected link */
a:active {
    color:blue;
}
.headcolor{
	background-color:orange;	
}
th{
	background-color:orange;	
}
tr:hover td {
    background-color:#ddd; /* or #000 */
}
#parent {
	height: 800px;
	overflow-y: auto;
}
.table2{
	width: 70%;
}
td{
	border: 1px solid black;
	text-align: center;
}
th{
	border: 1px solid black;
	font-size: 14px;
	padding-right: 5px;
	padding-left: 5px;
	text-align: center;
}
</style>

<script>
	$(document).ready(function() {
		$("#fixtable2").tableHeadFixer(); 
	});
</script>

</head>
<!-- table table-bordered  -->
<?php 	
	function displaydata($query){	
		$re="<center><div id='parent'>
		<table id='fixtable2' class='table2'>
			<thead id='nav'>
		  <tr>
			<th class='col1'><a href=process1.php?sort=publisher&year=".$GLOBALS['year'].">PUBLISHER</a></th>
			<th class='col2'><a href=process1.php?sort=journal&year=".$GLOBALS["year"].">JOURNAL</a></th>
			<th class='col3'><a href=process1.php?sort=issn&year=".$GLOBALS["year"].">ISSN</a></th>
			<th class='col4'><a href=process1.php?sort=subject&year=".$GLOBALS["year"].">SUBJECT</a></th>
			<th class='col5'><a href=process1.php?sort=school&year=".$GLOBALS["year"].">SCHOOL</a></th>
			<th class='col6'><a href=process1.php?sort=mode&year=".$GLOBALS["year"].">MODE</a></th>
			<th class='col7'><a href=process1.php?sort=jan&month=1&year=".$GLOBALS["year"].">JAN</a></th>
			<th class='col8'><a href=process1.php?sort=feb&month=1&year=".$GLOBALS["year"].">FEB</a></th>
			<th class='col9'><a href=process1.php?sort=march&month=1&year=".$GLOBALS["year"].">MAR</a></th>
			<th class='col10'><a href=process1.php?sort=april&month=1&year=".$GLOBALS["year"].">APR</a></th>
			<th class='col11'><a href=process1.php?sort=may&month=1&year=".$GLOBALS["year"].">MAY</a></th>
			<th class='col12'><a href=process1.php?sort=june&month=1&year=".$GLOBALS["year"].">JUN</a></th>
			<th class='col13'><a href=process1.php?sort=july&month=1&year=".$GLOBALS["year"].">JUL</a></th>
			<th class='col14'><a href=process1.php?sort=aug&month=1&year=".$GLOBALS["year"].">AUG</a></th>
			<th class='col15'><a href=process1.php?sort=sept&month=1&year=".$GLOBALS["year"].">SEP</a></th>
			<th class='col16'><a href=process1.php?sort=oct&month=1&year=".$GLOBALS["year"].">OCT</a></th>
			<th class='col17'><a href=process1.php?sort=nov&month=1&year=".$GLOBALS["year"].">NOV</a></th>
			<th class='col18'><a href=process1.php?sort=december&month=1&year=".$GLOBALS["year"].">DEC</a></th>
			<th class='col19'><a href=process1.php?sort=total_downloads&month=1&year=".$GLOBALS['year'].">TOTAL DOWNLOADS</a></th>
			
		  </tr>
		</thead><tbody>";     // starts html table
	
	  // $connection=mysqli_connect("localhost","root","","journals_data");
		include('connection.php');
	  $result=mysqli_query($connection,$query);
	  if(!$result)
	  	die("Error!");
		while ($row = mysqli_fetch_row($result)) {
			$url=$row[3];
			$mode="Subscription";
			if($row[6]==1)
				$mode="Complementary";
			$re .= "<tr>\n";
			$re.="<td class='col1'>".$row[0]."</td>\n";
			$re .= "<td class='col2'><a class='links' href='".$url."'>".$row[1]."</a></td>\n";
			$re.="<td class='col3'>".$row[2]."</td>\n";
			$re.="<td class='col4'>".$row[4]."</td>\n";
			$re.="<td class='col5'>".$row[5]."</td>\n";
			$re.="<td class='col6'>".$mode."</td>\n";
			$re.="<td class='col7'>".$row[7]."</td>\n";
			$re.="<td class='col8'>".$row[8]."</td>\n";
			$re.="<td class='col9'>".$row[9]."</td>\n";
			$re.="<td class='col10'>".$row[10]."</td>\n";
			$re.="<td class='col11'>".$row[11]."</td>\n";
			$re.="<td class='col12'>".$row[12]."</td>\n";
			$re.="<td class='col13'>".$row[13]."</td>\n";
			$re.="<td class='col14'>".$row[14]."</td>\n";
			$re.="<td class='col15'>".$row[15]."</td>\n";
			$re.="<td class='col16'>".$row[16]."</td>\n";
			$re.="<td class='col17'>".$row[17]."</td>\n";
			$re.="<td class='col18'>".$row[18]."</td>\n";
			$re.="<td class='col19'>".$row[19]."</td>\n";
			$re .= "</tr>\n";
		}
		return $re .'</tbody>
		</table></div><center>';	
	}
?>
</html>