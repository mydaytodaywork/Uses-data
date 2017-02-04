<head>
<title>Data</title>
</head>
<style>
	#dnld{
		height:35px;
		float:right;
		margin-top:2%;	
	}

.ul{
  background-color: black;
}
.ul li{  
  display: inline-block;
  padding: 10px;
}
.ul li a{
  color: white;
  font-size: 18px;
  text-decoration: none;
}
</style>
    
<?php 
	// $connection=mysqli_connect("localhost","root","","journals_data");
include('connection.php');
	session_start();
	if(isset($_SESSION['utype'])){
		include("header.php");
		include("navbar.php");
		if($_SESSION['utype']==1)
			adminnav();
		else if($_SESSION['utype']==0){
			usernav();
		}
	}
	else{
		include("publicNavBar.php");
	}
 //    	echo "<ul class='ul'><li><a href='graph.php'>Graph</a></li><li><a href='process1.php'>Data</a></li></ul>";
	


	include("checking.php");
	include("display.php");
	include("displaydata.php");

	$perpage=100;
	// $year=date("Y");
	$start=0;




	if(isset($_GET['year'])){
	    $year=$_GET['year'];
	}
	else{
	    $qq = "select max(year_data) from year";
	    $rr1 = mysqli_query($connection,$qq);
	    $tt = mysqli_fetch_row($rr1);
	    $year=$tt[0];
	}






	$tablename="data".$year;
	$query2="";
	$count=0;
	//Cases: (1) Search by publisher (2) search by other modes in journal (3)sort by months
	// Search is possible only by publisher,journal,mode,school,subject,issn
	//CASE 1: PUBLISHER
	if(isset($_GET['column']) && isset($_GET['data']) && $_GET['column']=="publisher"){
		//$query2="select issn from `".$tablename."`where `".$_GET['column']."` like '%".$_GET['data']."%'";
		$query2="select issn from journal where pid in (select pid from publisher where pname='".$_GET['data']."')"; 
		$result=mysqli_query($connection,$query2);	//query-2 maintaining count
		if(!$result)
			die("Error!");
		$count=mysqli_num_rows($result);
	}
	else if(isset($_GET['column']) && isset($_GET['data'])){
		$query2="select jname from journal where ".$_GET['column']." like '%".$_GET['data']."%'";
		$result=mysqli_query($connection,$query2);	//query-2 maintaining count
		if(!$result)
			die("Error!");
		$count=mysqli_num_rows($result);	
	}
	//CASE 3:
	else{
		$query2="select issn from `".$tablename."`";
		$result=mysqli_query($connection,$query2);	//query-2 maintaining count
		if(!$result)
			die("Error!");
		$count=mysqli_num_rows($result);
	}
	
	$tend=0;
	if($count>=$perpage){
		$end=$perpage-1;
		$tend=$end+1;
	}
	else{
		$end=$count;
		$tend=$end;
	}
	
	
	if(isset($_GET['start']) && ($_GET['end']) && $_GET['start']!=0){
		$start=$_GET['start'];
		$end=$_GET['end'];
		$tend=$end+1;
	}
	
	$offset=$tend-$start;
	$tstart=$start+1;
	if($count==0)
		$tstart=0;
	echo "<br/><br/>";
	echo "(Showing results from ".$tstart."-".$tend;
	echo ")<br/><br/>";

	$sortorder="";
	if(!isset($_GET['sort']))
		$sortorder="issn";
	else
		$sortorder=$_GET['sort'];
	
	$month="abs";
	if(isset($_GET['month'])){
		$month=$_GET['month'];
	}
	
	$query1="";
	if(isset($_GET['column']) && isset($_GET['data']) && $_GET['column']=="publisher"){
		$query1="select pname,jname,j.issn,url,subject,school,mode_type,
		jan,feb,march,april,may,june,july,aug,sept,oct,nov,december,
		total_downloads from journal j,publisher p,".$tablename." d where j.issn in 
		(select issn from journal where pid in (select pid from publisher 
		where pname='".$_GET['data']."')) and j.issn=d.issn and p.pid=j.pid LIMIT ".$start.", ".$offset; 
		display($query1,$query2,$month);
	}
	else if(isset($_GET['column']) && isset($_GET['data'])){
		if($_GET['column']!="issn")
			$query1="select pname,jname,j.issn,url,subject,school,mode_type,
			jan,feb,march,april,may,june,july,aug,sept,oct,nov,december,
			total_downloads from journal j,publisher p,".$tablename." d where ".$_GET['column']." like '%".$_GET['data']."%' and p.pid=j.pid and j.issn=d.issn LIMIT ".$start.", ".$offset;
		else 
			$query1="select pname,jname,j.issn,url,subject,school,mode_type,
			jan,feb,march,april,may,june,july,aug,sept,oct,nov,december,
			total_downloads from journal j,publisher p,".$tablename." d where j.".$_GET['column']." like '%".$_GET['data']."%' and p.pid=j.pid and j.issn=d.issn LIMIT ".$start.", ".$offset;
		
		display($query1,$query2,$month);
	}
	else if($month!="abs"){
		$query1="select pname,jname,j.issn,url,subject,school,mode_type,
		jan,feb,march,april,may,june,july,aug,sept,oct,nov,december,
		total_downloads from journal j,publisher p,".$tablename." d where p.pid=j.pid and j.issn=d.issn order by "
		.$sortorder." desc LIMIT ".$start.", ".$offset;
		display($query1,$query2,$month);	
	}
	else{
		if($sortorder=="publisher")
			$sortorder="pname";
		else if($sortorder=="journal")
			$sortorder="jname";
		$query1="select pname,jname,j.issn,url,subject,school,mode_type,
		jan,feb,march,april,may,june,july,aug,sept,oct,nov,december,
		total_downloads from journal j,publisher p,".$tablename." d where p.pid=j.pid and j.issn=d.issn order by "
		.$sortorder." LIMIT ".$start.", ".$offset;

		display($query1,$query2,$month);	
	}
	echo '</br></br></br></br>';
?>