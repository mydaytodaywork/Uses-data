  <head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
  <script src="bootstrap/jquery.min.js"></script>
  <script src="bootstrap/bootstrap.min.js"></script>
</head>
<?php
	$year=date("Y");
	if(isset($_GET['year']))
		$year=$_GET['year'];
	
	$package="package".$year;
	$tablename="data".$year;	
	// $connection=mysqli_connect("localhost","root","","journals_data");
	include('connection.php');
	$query="select jname from journal j,$package p,$tablename d,publisher pub where pub.pid=j.pid AND j.gid=p.gid AND j.issn=d.issn";
	$result=mysqli_query($connection,$query);
	if(!$result)
			die("Error!");
	$count=mysqli_num_rows($result);
	$limit=100;
	$pages=$count/$limit;
	settype($pages,"integer");
	if(($count%$limit)!=0)
		$pages=$pages+1;
	$ending=$count%$limit;
	echo "<ul class='pagination'>";
	$start=-100;
	$end=-1;
	
	for($i=0;$i<$pages;$i++){
		$start=$start+100;
		if($i<$pages-1 || $ending==0){
			$end=$end+100;
		}
		else
			$end=$end+$ending;
		$pno=$i+1;
		echo "<li><a href='printcost.php?start=".$start."&end=".$end."'>".$pno."</a></li>";		
	}
	echo "</ul>";
?>