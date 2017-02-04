<?php
	include("display.php");
	include("displaydata.php");
	// $connection=mysqli_connect("localhost","root","","journals_data");
	include('connection.php');
	$perpage=100;
	$year=date("Y");
	$start=0;
	if(isset($_GET['year']))
		$year=$_GET['year'];
	$tablename="data".$year;
	
	$query2="";
	$count=0;
	if(isset($_GET['column']) && isset($_GET['data']) && $_GET['column']=="Publisher"){
		//$query2="select issn from `".$tablename."`where `".$_GET['column']."` like '%".$_GET['data']."%'";
		$query2="select jname from journal j, data2016 d where j.issn in (select issn from journal where pid in (select pid from publisher where pname='AAAS')) and j.issn=d.issn"; 
		$result=mysqli_query($connection,$query2);	//query-2 maintaining count
		$count=mysqli_num_rows($result);
	}
	else if(isset($_GET['column']) && isset($_GET['data'])){
		$query2="select issn from `".$tablename."`where `".$_GET['column']."` like '%".$_GET['data']."%'";
		$result=mysqli_query($connection,$query2);	//query-2 maintaining count
		$count=mysqli_num_rows($result);	
	}
	else{
		$query2="select issn from `".$tablename."`";
		$result=mysqli_query($connection,$query2);	//query-2 maintaining count
		$count=mysqli_num_rows($result);
	}
	
	if($count>=$perpage)
		$end=$perpage-1;
	else
		$end=$count-1;
	
	if(isset($_GET['start']) && ($_GET['end']) && $_GET['start']!=0){
		$start=$_GET['start']-1;
		$end=$_GET['end'];
	}
	
	$tablename="data".$year;
	$offset=$end-$start;
	//$query="select * from `".$tablename."` LIMIT ".$start.", ".$offset;
	
	$start=$start+1;
	echo "<br/><br/>";
	echo "(Showing results from ".$start."-".$end;
	echo ")<br/><br/>";
	
	if(!isset($_GET['sort']))
		$sortorder="issn";
	else
		$sortorder=$_GET['sort'];
		
	$query1="";
	if(isset($_GET['column']) && isset($_GET['data'])){
	  	//$query1 = "SELECT * FROM `".$tablename."` where `".$_POST['column']."` like '%".$_POST['data']."%' LIMIT ".$start.", ".$offset;
		$query1="select jname,j.issn,url,subject,school,recby,mode,jan,feb,march,april,may,june,july,aug,sept,oct,nov,december,total_downloads from journal j,".$tablename." d where j.issn in (select issn from journal where pid in (select pid from publisher where pname='".$_GET['data']."')) and j.issn=d.issn LIMIT ".$start.", ".$offset; 
		display($query1,$query2);
	}
	/*else if(isset($_GET['sort']) && isset($_GET['month'])){
		$query1 = "SELECT * FROM `".$tablename."` order by `".$sortorder."` DESC LIMIT ".$start.", ".$offset;
		display($query1,$query2);
	}*/
	else{
		$query1 = "select pname,jname,j.issn,url,subject,school,recby,mode,
		jan,feb,march,april,may,june,july,aug,sept,oct,nov,december,
		total_downloads from journal j,publisher p,".$tablename." d where p.pid=j.pid and j.issn=d.issn order by ".$sortorder." desc";
		display($query1,$query2);	
	}
?>