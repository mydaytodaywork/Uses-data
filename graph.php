<head>
<title>Graphs</title>
</head>
<?php 
	session_start();
	if(isset($_SESSION['user'])){
    include('header.php');
    include("navbar.php");
		if($_SESSION['utype']==1)
			adminnav();
		else if($_SESSION['utype']==0){
			usernav();
    }
	}
  // else
  //   echo "<ul class='ul'><li><a href='graph.php'>Graph</a></li><li><a href='process1.php'>Data</a></li></ul>";
?>

<?php
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
//include('customerror.php');

$tableName = "data".$year;


echo "
<script type=\"text/javascript\" src=\"http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js\"></script>
<script type=\"text/javascript\" src=\"jquery.jqplot/jquery.jqplot.js\"></script>
<script type=\"text/javascript\" src=\"jquery.jqplot/plugins/jqplot.pieRenderer.js\"></script>
<link rel=\"stylesheet\" type=\"text/css\" href=\"jquery.jqplot/jquery.jqplot.css\" />

<script type=\"text/javascript\" src=\"http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js\"></script>
<script type=\"text/javascript\" src=\"jquery.jqplot/jquery.jqplot.js\"></script>
<script type=\"text/javascript\" src=\"jquery.jqplot/plugins/jqplot.barRenderer.js\"></script>
<script type=\"text/javascript\" src=\"jquery.jqplot/plugins/jqplot.pieRenderer.js\"></script>
<script type=\"text/javascript\" src=\"jquery.jqplot/plugins/jqplot.categoryAxisRenderer.js\"></script>
<script type=\"text/javascript\" src=\"jquery.jqplot/plugins/jqplot.pointLabels.js\"></script>
<link rel=\"stylesheet\" type=\"text/css\" href=\"jquery.jqplot/jquery.jqplot.css\" />

<script type=\"text/javascript\" src=\"jquery.jqplot/plugins/jqplot.highlighter.js\"></script>





<script type=\"text/javascript\" src=\"http://cdn.jsdelivr.net/jqplot/1.0.8/plugins/jqplot.dateAxisRenderer.min.js\"></script>

<script type=\"text/javascript\" src=\"jquery.jqplot/plugins/jqplot.dateAxisRenderer.js\"></script>
<script type=\"text/javascript\" src=\"jquery.jqplot/plugins/jqplot.canvasTextRenderer.js\"></script>
<script type=\"text/javascript\" src=\"jquery.jqplot/plugins/jqplot.canvasAxisTickRenderer.js\"></script>
<script type=\"text/javascript\" src=\"jquery.jqplot/plugins/jqplot.barRenderer.js\"></script>

<script type=\"text/javascript\" src=\"jquery.jqplot/src/plugins/jqplot.canvasAxisLabelRenderer.js\"></script>





<script>

function clickedClassHandler(name,callback) {

    // apply click handler to all elements with matching className
    var allElements = document.body.getElementsByTagName(\"*\");

    for(var x = 0, len = allElements.length; x < len; x++) {
        if(allElements[x].className == name) {
            allElements[x].onclick = handleClick;
        }
    }

    function handleClick() {
        var elmParent = this.parentNode;
        var parentChilds = elmParent.childNodes;
        var index = 0;

        for(var x = 0; x < parentChilds.length; x++) {
            if(parentChilds[x] == this) {
                break;
            }

            if(parentChilds[x].className == name) {
                index++;
            }
        }
        if(elmParent.className!='jqplot-target')
          callback.call(this,index);
        
    }
}
</script>
";

// include('graphschool.php');
include('trail.php');
// include('graphprice.php');
// include('graphsub.php');
// include('trail2.php');


?>

<html>
<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
    text-align: center;
}
th {
    background-color: orange;
}
.linksa a{
  text-decoration: none;
}
.linksa{
  border: 0;
}
.ul{
  background-color: black;
}
.ul li{  
  display: inline-block;
  padding: 10px;
}
.ul li a{
  color: white;
  font-size: 18px;
  text-decoration: none;
}
#form1{
  display: inline-block;
  margin-bottom: 0px;
}
#showtable{
  margin-top: 2px;
  background-color: orange;
}



.box{
  width: 70%;
  height: 60%;
  border: 2px solid black;
  border-radius: 5px;
  margin-bottom: 50px;
  margin-top: 50px;
}
.boxbar{
  width: 100%;
  height: 10%;
}
.boxdata{
  width: 100%;
  height: 90%;
}
.boxbar {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: orange;
}
.boxbar li {
    float: left;
}

.boxbar li a {
    display: block;
    color: black;
    font-weight: bold;
    text-align: center;
    padding: 10px 16px;
    text-decoration: none;
}

.boxbar li a:hover {
  cursor: pointer;
    background-color: #FF8C00;
}

#pie1, #pie3, #pie4, #pie5{
  height: 100%;
  width: 100%;
}
#g1,#g2,#g3{
  width: 25%;
  border-right: 1px solid black;
}
#g4{
  width: 24%;
}
</style>

<body>
<?php 
if(!isset($_SESSION['user'])){
  include('publicNavBar.php');
}
?>
</br>
<center><h2>Downloaded Data of <?php echo $year;?></h2></center>
  <center>
<div><!-- 
  <form action="graph.php" method="GET">
      <input type="text" name="year">
      <input type="submit"/>
    </form> -->
    <?php
    $opt='<form id="form1" action="graph.php" method="GET"><select name="year" onchange="this.form.submit()">';
    $q1 = 'select year_data from year';
    $r1 = mysqli_query($connection,$q1);    
    while($t1 = mysqli_fetch_row($r1)){
      if($t1[0]!=$GLOBALS['year'])
        $opt.="<option value=".$t1[0].">".$t1[0]."</option>";
      else
        $opt.="<option value=".$t1[0]." selected>".$t1[0]."</option>";
    }
    $opt.="</select></form>";

    
    echo "<table><thead><tr><th>Year</th><th>Resources</th><th>Downloads</th></tr></thead><tbody>";
    
      $querystable = "select count(j.issn), sum(d.total_downloads) from journal j, data".$GLOBALS['year']." d where j.issn=d.issn";
      $result1 = mysqli_query($GLOBALS['connection'],$querystable);
      if($r = mysqli_fetch_row($result1)){
        // echo "<tr><td class='linksa'><a href='graph.php?year=".$row[0]."'>".$row[0]."</a></td><td> ".$r[0]."</td> <td>".$r[1]."</td></tr>";
        echo "<tr><td class='linksa'>".$GLOBALS['opt']."</td><td> ".$r[0]."</td> <td>".$r[1]."</td></tr>";
      }

    echo "</tbody></table>";


    if(isset($_SESSION['user'])){
      if($_SESSION['utype']==1)
      echo "<input id=\"showtable\" type=\"button\" name=\"btn\" value=\"Show Table\" onclick=\"window.open('admintable.php','_self');\"/>";
    }

    ?>
</div>
  </center>




<div>
  <center>
    <!-- <div id="pie1" style="padding-right:10%;width:30%;height:400px;display:inline-block;"></div> -->
  <!-- <div id="pie1" style="width:49%;height:400px;display:inline-block;"></div> -->
  <!-- <div id="pie3" style="padding-right:10%;margin-left:5%;width:30%;height:400px;display:inline-block;"></div> -->
  <!-- <div id="pie3" style="width:49%;height:400px;display:inline-block;"></div> -->
  
  <div class='box'>
  <ul class='boxbar'>
    <li id='g1'><a id='ag1' onclick='graph1();'>School Wise</a></li>
    <li id='g2'><a id='ag2' onclick='graph3();'>Subject Wise</a></li>
    <li id='g3'><a id='ag3' onclick='graph4();'>Top 5 Publishers</a></li>
    <li id='g4'><a id='ag4' onclick='graph5();'>Last <?php echo ($endindex-$startindex+1);?> Years</a></li>
  </ul>

  <div class='boxdata'>
  <div id='pie1'></div>
  <div id='pie3'></div>
  <div id='pie4'></div>
  <div id='pie5'></div>
  </div>
  </div>

  </center>


<!--   <center style="margin-top:-10px;font-size:18px;">
    <div style="margin-bottom:3%;width:49%;display:inline-block;">School VS Downloads</div>
    <div style="margin-bottom:3%;width:49%;display:inline-block;">Subject VS Downloads</div>
  </center>
 -->
<!-- 
  <center>
  <div id="pie3" style="padding-right:10%;width:30%;height:400px;display:inline-block;"></div>
  </center> -->


<?php echo "<center><h3 style='font-size:20px;'>Publishers VS Downloads<h3><center>";?>
  <div style="width:100%;height:500px;display:inline-block;overflow-x:scroll">
    <div id="chart1" style="width:200%;height:400px;">
    </div>
  </div>

</div>

</body>
</html>
