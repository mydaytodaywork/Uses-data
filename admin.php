<head>
<title>Admin Login</title>
</head>
<?php
include('header.php');
session_start();
if(isset($_SESSION['user'])){
	header("location:upload.php");	
}
?>
<style>
.input{
	border-radius:5px;
	height:60px;
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
}
#wpass{
	font-size:25px;	
	text-align:center;
}
</style>
<body>
<div id="wpass">

<?php 
if(isset($_GET['msg'])){
	if($_GET['msg']=="Wrong Password! Please Try Again")
		echo $_GET['msg'];
	else
		header("location:error.php");
}
?>

</div>
<center>
<div id="login">
<form action="upload.php" method="post">
	<input id="emaili" class="input" type="text" placeholder="EMAIL" name="email" required/>
    <br/>
    <input class="input" type="password" placeholder="PASSWORD" name="pass" required/>
    <br/>
    <input type="submit" id="submit"/>
</form>
</div>
</center>

</body>