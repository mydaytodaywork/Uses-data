<head>
<title>Journals wise</title>
</head>
<?php 
	
	session_start();
  if(isset($_SESSION['user'])){
	  include('header.php');
    include("navbar.php");
  	if($_SESSION['utype']==1)
			adminnav();
		else if($_SESSION['utype']==0)
			usernav();
	}
  else{
    include('publicNavBar.php');
  }
?>
<html>
<style>
.ztable{
  width: 90%;
}
code{
  background-color: white;
}
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
}
th {
    text-align: center;
    background-color: orange;
}
.url{
	text-decoration: none;
}	
.nourl{
  text-align: center;
}
</style>

<body>

<?php
include('customerror.php');
if(isset($_GET['year']) && isset($_GET['publisher'])){

$year = $_GET['year'];
$publisher = $_GET['publisher'];

$tableName = "data".$year;

echo "<div class='cztable'><center><div class='ztable'>";



  // echo "<center><h3>Publisher : ".$publisher."</h3></center>";

  $query_bar1 = "SELECT j.jname, j.url, j.subject, j.school, d.jan ,  d.feb ,  d.march ,  d.april ,  d.may ,  d.june ,  d.july ,  d.aug ,  d.sept ,
          d.oct,    d.nov ,  d.december ,  d.total_downloads
          FROM publisher p, journal j, ".$tableName." d
          WHERE p.pid=j.pid and j.issn=d.issn and p.pname='".$publisher."'";
$tt = 0;
$ts = 0;
  function displayBarData($query) {

      $q = "SELECT sum(d.jan) ,  sum(d.feb) ,  sum(d.march) ,  sum(d.april) ,  sum(d.may) ,  sum(d.june) ,  sum(d.july) ,  sum(d.aug) ,  sum(d.sept),
          sum(d.oct), sum(d.nov) ,  sum(d.december) ,  sum(d.total_downloads)
          FROM publisher p, journal j, ".$GLOBALS['tableName']." d
          WHERE p.pid=j.pid and j.issn=d.issn and p.pname='".$GLOBALS['publisher']."'";

      // $con=mysqli_connect("localhost","root","","journals_data");
          include('connection.php');
          $con = $connection;
      $r = mysqli_query($con,$q);
      $p = mysqli_fetch_row($r);

    $re = "<table id='table'><thead class=\"thead\">
      <tr>
      <th>Sl. No</th>
      <th>JOURNAL</th>
      <th>SUBJECT</th>
      <th>SCHOOL</th>
      <th>JAN</th>
      <th>FEB</th>
      <th>MAR</th>
      <th>APRIL</th>
      <th>MAY</th>
      <th>JUNE</th>
      <th>JULY</th>
      <th>AUG</th>
      <th>SEPT</th>
      <th>OCT</th>
      <th>NOV</th>
      <th>DEC</th>
      <th>TOTAL<br>DOWNLOADS</th>
      </tr>
    </thead>
    <tbody class=\"tbody\">";     // starts html table
  
    // $connection=mysqli_connect("localhost","root","","journals_data");
    include('connection.php');
    $result=mysqli_query($connection,$query);
    $c=0;
    
    while ($row = mysqli_fetch_row($result)) {
    $re .= "<tr>\n";
      $c++;
      $i=0;    

      $re .= " <td class=\"nourl\">".$c."</td><td><a class='url' href=".$row[1].">".$row[0]."</a></td>";
      $re .= "<td class=\"nourl\">".$row[2]."</td><td class=\"nourl\">".$row[3]."</td>";

      while($i<12){
        if($p[$i]==0){
          $re .= "<td class=\"nourl\"> - </td>";
        }
        else{
          $re .= "<td class=\"nourl\">".$row[($i+4)]."</td>";
        }
        $i++;
      }
      $re.="<td class=\"nourl\">".$row[16]."</td>";

    $re .= "</tr>\n";
    }

    $GLOBALS['ts']=$c;

      $q = "SELECT sum(d.jan) ,  sum(d.feb) ,  sum(d.march) ,  sum(d.april) ,  sum(d.may) ,  sum(d.june) ,  sum(d.july) ,  sum(d.aug) ,  sum(d.sept),
          sum(d.oct), sum(d.nov) ,  sum(d.december) ,  sum(d.total_downloads)
          FROM publisher p, journal j, ".$GLOBALS['tableName']." d
          WHERE p.pid=j.pid and j.issn=d.issn and p.pname='".$GLOBALS['publisher']."'";

      // $con=mysqli_connect("localhost","root","","journals_data");
          include('connection.php');
          $con = $connection;
      $r = mysqli_query($con,$q);
      
      if($p = mysqli_fetch_row($r)){
      $re.="<tr style=\"background-color:orange;\"><th></th><th></th><th></th><th>Total</th> <th>".$p[0]."</th><th>".$p[1]."</th><th>".$p[2]."</th><th>".$p[3]."</th><th>".$p[4]."</th>
      <th>".$p[5]."</th><th>".$p[6]."</th><th>".$p[7]."</th><th>".$p[8]."</th><th>".$p[9]."</th><th>".$p[10]."</th><th>".$p[11]."</th>
      <th>".$p[12]."</th></tr>";
      $GLOBALS['tt']=$p[12];
    }

    return $re .'</tbody>
    </table>';
  
  }

  $showTable = displayBarData($query_bar1);
  // echo "<center><h3>Publisher : ".$publisher." (".$ts." Journals) (".$tt." Downloads)</h3></center>";
  echo "<center><h3 style='margin-top:50px;margin-bottom:20px;font-size:20px;'>Publisher : ".$publisher." (".$ts;
    if($ts>1){
      echo" Resources with ";  
    }
    else{
      echo" Resource with ";
    }
    echo $tt;
    if($tt>1){
      echo" Downloads";
    }
    else{
      echo" Download";
    }

    echo")</h3></center>";



  
  echo "<code style='font-family:Times;'>".$showTable."</code>";


echo "</div></center></div>";

}

?>

</body>
</html>