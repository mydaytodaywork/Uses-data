<head>
<title>CostWise Data</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
  <script src="bootstrap/jquery.min.js"></script>
  <script src="bootstrap/bootstrap.min.js"></script>
</head>
<style>
th{
	background-color:orange;	
}
</style>
<?php
	session_start();
	if(!isset($_SESSION['utype']))
		header("location:process1.php");
	include("header.php");
	$year=date("Y");
	if(isset($_GET['year']))
		$year=$_GET['year'];
	
	include("navbar.php");
	if($_SESSION['utype']==1)
		adminnav();
	else
		usernav();
		
		
	function showpub(){
		// $connection=mysqli_connect("localhost","root","","journals_data");
		include('connection.php');
		$package="package".$GLOBALS['year'];
		$tablename="data".$GLOBALS['year'];
		$re = "<table class='table table-striped table-bordered' class='headcolor'><thead>
		  <tr>
			<th>PUBLISHER</th>
			<th>JOURNAL</th>
			<th>ISSN</th>
			<th>SUBJECT</th>
			<th>SCHOOL</th>
			<th> Recommended by</th>
			<th>MODE</th>
			<th>TOTAL DOWNLOADS</th>
			<th>SUBSCRIPTION PRICE</th>
			<th>SUBSCRIPTION DOWNLOADS</th>
			<th>SUBS. CPA</th>
			<th>COMPLEMENTARY DOWNLOADS</th>
			<th>COMP. CPA</th>		
		  </tr>
		</thead>
		<tbody>";     // starts html table
	
	$start=0;
	$end=99;
	if(isset($_GET['start']) && isset($_GET['end'])){
		$start=$_GET['start'];
		$end=$_GET['end'];	
	}
	$offset=$end-$start+1;
	$query="select pname,jname,j.issn,url,subject,school,recby,mode_type,total_downloads,subprice,stotal,scpa,ctotal,ccpa,j.gid from journal j,$package p,$tablename d,publisher pub where pub.pid=j.pid AND j.gid=p.gid AND j.issn=d.issn limit $start,$offset";
	$result=mysqli_query($connection,$query);
	if(!$result)
			die("Error!");
	$previd=2000;
	
		
		while ($row = mysqli_fetch_row($result)) {
			$re .= "<tr>\n";
			$i=0;
			$finish=14;
			$url=$row[3];
			$gid=$row[14];
			if($previd!=$gid)
				$previd=$gid;
			else
				$finish=9;
				
			while($i < $finish){
				if($i==1){
					$re .= " <td><a class='links' href='".$url."'>".$row[$i]."</a></td>\n";
				}
				else if($i==7){
					$mode="Subscription";
					if($mode==1)
						$mode="Complementary";
					$re .= " <td>".$mode."</td>\n";
				}
				else if($i!=3){
					$re .= " <td>".$row[$i]."</td>\n";
				}
				$i++;  
			}
		$re .= "</tr>\n";
		}
		return $re .'</tbody>
		</table>';
	}
	$run=showpub();
	echo $run;
	echo "<center>";
	include("paginnation.php");
	echo "</center>";
?>