<head>
<title>ADD USERS</title>
</head>

<?php
	include("header.php");
	// $connection=mysqli_connect("localhost","root","","journals_data");
	include('connection.php');
	session_start();
	if(!isset($_SESSION['user'])){
		header("location:process1.php");	
	}
	else if($_SESSION['utype']==0)
		header("location:admin.php");
	include("navbar.php");
	if($_SESSION['utype']==1)
		adminnav();
	else if($_SESSION['utype']==0)
		usernav();
	
	if(isset($_GET['remove'])){
		$email=$_GET['email'];
		$query="delete from admin where email='".$email."'";
		$result=mysqli_query($connection,$query);	
		if(!$result)
			die("Error!");
	}
	
	else if(isset($_POST['email']) && isset($_POST['name']) && isset($_POST['userid']) && isset($_POST['pass'])){
		$email=$_POST['email'];
		$name=$_POST['name'];
		$userid=$_POST['userid'];
		$pass=$_POST['pass'];
		
		$query="insert into admin values ('".$name."','".$userid."','".$email."','".$pass."',0)";
		$result=mysqli_query($connection,$query);
		if(!$result)
			die("Error!");
	}
	include("admin_table.php");
	include("admin_modal.php");
?>