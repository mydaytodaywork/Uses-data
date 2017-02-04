<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
  <script src="bootstrap/jquery.min.js"></script>
  <script src="bootstrap/bootstrap.min.js"></script>
</head>

<style>
#logged{
	float:right;	
	font-size:18px;
}
#navbar{
	margin-top:0px;
	background-color:black;
	padding:8px;
	font-size:23px;
	color:white;
}
.links{
	margin-left:4%;
	display:inline;
}
a{
	text-decoration:none;	
}
</style>
<?php
/* <div id="navbar">
    	<li class="links"><a href="upload.php">Home</a></li>
        <li class="links"><a href="process1.php">View</a></li>
        <li class="links"><a href="newadmin.php">Super User</a></li>
        <li class="links"><a id='log' href='logout.php'>Logout</a></li>
    </div>
	<div id="logged">
    <?php
    	echo $_SESSION['user'];
	?>
	</div>
</div>*/
function adminnav()
{
	echo "
	<body>
	<nav class='navbar navbar-inverse'>
  	<div class='container-fluid'>
    <ul class='nav navbar-nav'>
      <li><a href='upload.php' style='font-size:23px; margin-left:10px;'>Home</a></li>
      <li><a href='process1.php' style='font-size:23px; margin-left:10px;'>View </a></li>
	  <li><a href='graph.php' style='font-size:23px; margin-left:10px;'>Graph </a></li>
      <li><a href='newadmin.php' style='font-size:23px; margin-left:10px;'>SuperUser</a></li>
	  <li><a href='printcost.php' style='font-size:23px; margin-left:10px;'>Price Wise</a></li>
	  <li><a href='topaper.php' style='font-size:23px; margin-left:10px;'>Download</a></li>
      <li><a href='changepass.php' style='font-size:23px; margin-left:10px;'> Change Password </a></li>
	</ul>
    <ul class='nav navbar-nav navbar-right'>
       <li><a href='logout.php' style='font-size:23px;'>Logout</a></li>
    </ul>
  	</div>
	</nav>
	<div id='logged'> <span style='margin-right:10px;'>". $_SESSION['user']."</span>
	</div>
	</body>";
}
function usernav()
{
	echo "
	<body>
	<nav class='navbar navbar-inverse'>
  	<div class='container-fluid'>
    <ul class='nav navbar-nav'>
      <li><a href='upload.php' style='font-size:23px; margin-left:10px;'>Home</a></li>
      <li><a href='process1.php' style='font-size:23px; margin-left:10px;'>View </a></li>
	  <li><a href='graph.php' style='font-size:23px; margin-left:10px;'>Graph </a></li>
	  <li><a href='printcost.php' style='font-size:23px; margin-left:10px;'>Price Wise</a></li>
	  <li><a href='topaper.php' style='font-size:23px; margin-left:10px;'>Download</a></li>
	  <li><a href='changepass.php' style='font-size:23px; margin-left:10px;'> Change Password </a></li>
    </ul>
    <ul class='nav navbar-nav navbar-right'>
       <li><a href='logout.php' style='font-size:23px;'>Logout</a></li>
    </ul>
  	</div>
	</nav>
	<div id='logged'> <span style='margin-right:10px;'>". $_SESSION['user']."</span>
	</div>
	</body>";
}
?>
	