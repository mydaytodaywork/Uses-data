<head>
<title>Logout</title>
</head>
<style>
#logout{
text-align:center;
 font-size:30px;
 margin-top:6%;
 background-color:#CCC;
 width:500px;
 padding:5px;
 
}
</style>
<?php
	session_start();
	if(!isset($_SESSION['user']))
		header("location:process1.php");
	include('header.php');
	session_unset();
	session_destroy();
?>
<center>
<div id="logout">
	<?php echo "You have Successfully logged out"; ?>
</div>
</center>