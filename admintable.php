<?php

include('header.php');
session_start();
	include("navbar.php");
	if(isset($_SESSION['user'])){
		if($_SESSION['utype']==1){
			adminnav();
		    // echo "<a style=\"float:left;\" href='graph.php'>back</a>";
    	}
		else if($_SESSION['utype']==0){
			usernav();
    	}
	}
    else{
        die('Error!');
    }

// $connection=mysqli_connect("localhost","root","","journals_data");
    include('connection.php');
if(isset($_GET['year'])){
    $year=$_GET['year'];
}
else{
    $qq = "select max(year_data) from year";
    $rr1 = mysqli_query($connection,$qq);
    $tt = mysqli_fetch_row($rr1);
    $year=$tt[0];
}



//add title
//check session 


$conn = $connection;

//tables
//table1
$query = "SELECT j.school,count(d.issn),SUM(pack.subprice)
        FROM journal j, package".$year." pack, data".$year." d
        WHERE j.gid=pack.gid and d.issn=j.issn
        group by j.school";

$result = mysqli_query($conn,$query);

$table1="<table>
<thead>
<tr><th>School</th><th>Resources</th><th>Expenditure</th></tr>
</thead>
<tbody>";
while($row=mysqli_fetch_row($result)){
	$table1 .= "<tr><td>".$row[0]."</td><td style='text-align: center;'>".$row[1]."</td><td style='text-align: right;'>&#8377;".$row[2]."</td></tr>";
}

$table1 .= "</tbody></table>"; 



//table2
$query = "SELECT j.school,sum(j.mode_type),count(j.school),SUM(d.total_downloads)
        FROM journal j, data".$year." d
        WHERE j.issn=d.issn
        group by j.school";

$result = mysqli_query($conn,$query);

$table2="<table>
<thead>
<tr><th>School</th><th>Subscribed</th><th>Complimentary</th><th>Downloads</th></tr>
</thead>
<tbody>";
while($row=mysqli_fetch_row($result)){
	$table2 .= "<tr><td>".$row[0]."</td><td style='text-align: center;'>".$row[1]."</td><td style='text-align: center;'>".($row[2]-$row[1])."</td><td style='text-align: center;'>".$row[3]."</td></tr>";
}

$table2 .= "</tbody></table>"; 


//table3
$query = "SELECT distinct school from journal";

$result = mysqli_query($conn,$query);

$table3="<table>
<thead>
<tr><th>School</th><th>Publisher</th></tr>
</thead>
<tbody>";
$str='';
while($row=mysqli_fetch_row($result)){

	$query2= "SELECT p.pname,count(j.issn)
        FROM publisher p,journal j, data".$year." d
        WHERE j.pid=p.pid and j.issn=d.issn and j.school='".$row[0]."'
        group by j.pid";

    $result2 = mysqli_query($GLOBALS['conn'],$query2);
    $c=0;
    $str='';
    while($subrow=mysqli_fetch_row($result2)){

		$str.=$subrow[0]."(".$subrow[1]."), ";
		$c++;
	}

$table3 .= "<tr><td>".$row[0]."</td><td>".$str.$c."</td></tr>";

}

$table3 .= "</tbody></table>"; 



//table4
$query = "SELECT j.subject, SUM(d.total_downloads)
        FROM journal j, data".$year." d
        WHERE j.issn=d.issn
        group by j.subject";

$result = mysqli_query($conn,$query);

$table4="<table>
<thead>
<tr><th>Subject</th><th>Downloads</th></tr>
</thead>
<tbody>";
while($row=mysqli_fetch_row($result)){
	$table4 .= "<tr><td>".$row[0]."</td><td style='text-align: center;'>".$row[1]."</td></tr>";
}

$table4 .= "</tbody></table>"; 



?>
<html>
<head>
</head>
<style>
table, th, td {
    padding: 5px;
    border: 1px solid black;
    border-collapse: collapse;
    font-size: 18px;
}
th{
    text-align: center;
}
table thead{
	background-color: orange;
	text-align: center;
}
.table1, .table2, .table3, .table4{
	margin: 1%;
}
.table1 table{
	width: 30%;
}
.table2 table{
    width: 40%;
}
.table3{
	vertical-align: top;
	width: 50%;
}
.table4{
    width: 20%;
}
.table1, .table2{
	display: inline-block;
}
.table3, .table4{
	display: inline-block;
}
.tall{
    width: 100%;
    margin-top: 100px;
}
</style>
<body>

<div class='tall'>
<center>
<div class='table1'>
<?php echo $table1; ?>
</div>
<div class='table2'>
<?php echo $table2; ?>
</div>
</center>

<center>
<div class='table3'>
<?php echo $table3; ?>
</div>
<div class='table4'>
<?php echo $table4; ?>
</div>
</center>
</div>

</body>
</html>