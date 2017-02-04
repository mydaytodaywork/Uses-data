<?php
	if(!isset($_SESSION['user']))
		header("location:process1.php");
?>
<head>
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
<body>
<br/><br/><br/>
<div class="container">
  <div class="table-responsive">          
  	<table class="table table-bordered">
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Acess Type</th>
        <th>Remove</th>
      </tr>
    </thead>
    <tbody>
      <?php 
	  	// $connection=mysqli_connect("localhost","root","","journals_data");
      	include('connection.php');
		$query="select name,type,email from admin";
		$result=mysqli_query($connection,$query);
	  	if(!$result)
			die("Error!");
		while($row=mysqli_fetch_row($result)){
			$type="User";
			echo "<tr>";
			if($row[1]==1){
				$type="Master";
				echo "<td>".$row[0]."</td><td>".$row[2]."</td><td>".$type."</td><td>Cant Remove</td>";	
			}
			else{
				echo "<td>".$row[0]."</td><td>".$row[2]."</td><td>".$type."</td><td>
				<a href='newadmin.php?remove=1&email=".$row[2]."'>Remove</a></td>";
			}
			echo "</tr>";
		}
	  ?>
    </tbody>
  </table>
  </div>
</div>

</body>