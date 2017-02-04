<head>
<title>Change Password</title>
</head>
<?php
	session_start();
	if(!isset($_SESSION['user'])){
		header("location:process1.php");	
	}
	include("header.php");
	include("navbar.php");
	if($_SESSION['utype']==1)
		adminnav();
	else if($_SESSION['utype']==0)
		usernav();
		
	$oldpass="";
	$newpass="";
	$newpassr="";
	
	if(isset($_POST['oldpass']) && ($_POST['newpass']) && ($_POST['newpassr'])){
		$oldpass=htmlentities($_POST['oldpass']);
		$newpass=htmlentities($_POST['newpass']);
		$newpassr=htmlentities($_POST['newpassr']);
		if($newpass!=$newpassr){
			header("location:changepass.php?error=Passwords do not match");	
		}
		else{
			// $connection=mysqli_connect("localhost","root","","journals_data");
			include('connection.php');
			$query="select type from admin where email='".$_SESSION['email']."' AND password='".mysqli_real_escape_string($connection,$oldpass)."'";
			$result=mysqli_query($connection,$query);
			if(!$result)
				die("Error!");
			$count=mysqli_num_rows($result);
			if($count>0)
				echo "<center><h3>PASSWORD UPDATED</h3></center>";
			else
				echo "<center><h3>Old password is INCORRECT</h3></center>";	
			
			$query="update admin set password='".$newpass."' where email='".$_SESSION['email']."' AND password='".mysqli_real_escape_string($connection,$oldpass)."'";	
			$result=mysqli_query($connection,$query); 
			if(!$result)
				die("Error!");
		}
	}
?>
<style>
.input{
	border-radius:5px;
	height:50px;
	width:500px;
	margin-top:2%;
	padding:2%;
	font-size:20px;
}
#emaili{
	margin-top:16%;	
}
#submit{
	margin-top:4%;
	height:40px;
	width:500px;	
}
#login{
	align:center;
	background-color:#CCC;
	height:400px;
	width:600px;
	margin-top:3%;
	padding-top:1.4%;
}
#wpass{
	font-size:25px;	
	text-align:center;
}
</style>

<div id="wpass">

<?php 
if(isset($_GET['error'])){
	if($_GET['error']=="Passwords do not match")
		echo $_GET['error'];
	else header("location:error.php");
}
?>

</div>

<body>
<center>
<div id="login">
<h2>Change Password</h2>
<form action="changepass.php" method="post">
	<input type="password" class="input" name="oldpass" placeholder="OLD PASSWORD"/><br/>
    <input type="password" class="input" name="newpass" placeholder="NEW PASSWORD"/><br/>
    <input type="password" class="input" name="newpassr" placeholder="REPEAT PASSWORD"/><br/>
	<input type="submit" id="submit"/>
</form>

</div>
</center>

</body>
