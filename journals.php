<style>
.jtable{
	width: 70%;
	text-align: center;
}
.jtable, .jtable thead tr th, .jtable tbody tr td{
	border: 1px solid black;
	border-collapse: collapse;
}
.jtable thead tr th, .jtable tbody tr td{
	padding: 5px;
}
.jtable thead{
	background-color: orange;
}
.jdata{
	text-align: left;
}
.pub{
	width: 70%;
	margin-top: 30px;
	margin-left: 15%;
	margin-bottom: 10px;
	font-size: 25px;
	border-bottom: 1px solid black;
}
</style>

<?php
if(!isset($_SESSION['user'])){
	include('publicNavBar.php');
}
if(isset($_GET['publisher'])){
	// $con = mysqli_connect('localhost','root','','journals_data');
	include('connection.php');
	$con = $connection;
	$query = "select j.jname,j.subject,j.mode_type,a.perpetual,a.backfile,j.url from publisher p,journal j, access a where j.ac_id=a.ac_id and p.pid=j.pid and p.pname='".$_GET['publisher']."'";
	$r = mysqli_query($con,$query);

	$table = "<center><code style='font-family:Times;'><table class='jtable'><thead>
		<tr>
		<th>Sr. No.</th>
		<th>Journal</th>
		<th>Subject</th>
		<th>Status</th>
		<th>Perpetual Access Details</th>
		<th>Current Access Details</th>
		</tr>
		</thead>
		<tbody>";
		$x=0;
	while($row = mysqli_fetch_row($r)){
		
		$mode = ($row[2]==0)?'Subscribed':'Complementary';

		$table.="<tr>
		<td>".($x+1)."</td>
		<td class='jdata'><a href='".$row[5]."'>".$row[0]."</a></td>
		<td>".$row[1]."</td>
		<td>".$mode."</td>
		<td>".$row[3]."</td>
		<td>".$row[4]."</td>
		</tr>";

		$x++;	
	}

	$table.="</tbody></table></code></center>";
	echo "<div class='pub'>".$_GET['publisher']."</div>";
	echo $table;

}




?>