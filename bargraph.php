<head>
<title>Details</title>
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
<?php

$year = isset($_GET['year'])?$_GET['year']:2016;
$school = isset($_GET['school'])?$_GET['school']:'';
$subject = isset($_GET['subject'])?$_GET['subject']:'';
$data = isset($_GET['data'])?$_GET['data']:'download';
$tableName = "data".$year;

// include('customerror.php');

// $connection=mysqli_connect("localhost","root","","journals_data");
include('connection.php');
if($data=='download'){
$query_bar1 = "SELECT p.pname,SUM(d.total_downloads)
        FROM publisher p, journal j, ".$tableName." d
        WHERE p.pid=j.pid and j.issn=d.issn and j.school='".$school."'
        group by p.pid";
}
if($data=='subdownload'){
$query_bar1 = "SELECT p.pname,SUM(d.total_downloads)
        FROM publisher p, journal j, ".$tableName." d
        WHERE p.pid=j.pid and j.issn=d.issn and j.subject='".$subject."'
        group by p.pid";
}
if($data=='price'){
$query_bar1 = "SELECT p.pname,SUM(pack.subprice)
        FROM publisher p, journal j, ".$tableName." d, package".$year." pack
        WHERE p.pid=j.pid and j.issn=d.issn and j.gid=pack.gid and j.school='".$school."'
        group by p.pid";
}
$result = mysqli_query($connection,$query_bar1);

$pie1_array=array();
  while($row = mysqli_fetch_row($result)){
    array_push($pie1_array,array($row[0],$row[1]));
  }
  
$count = count($pie1_array);
$val = "";
$str = "";
$str3 = "";
for($i=0;$i<$count;$i++){
    $val = $val.$pie1_array[$i][1].",";
    $str = $str."'".$pie1_array[$i][0]."',";
    $str3 = $str3."{label: \"".$pie1_array[$i][0]."\" , y:".$pie1_array[$i][1].", indexLabel:'".$pie1_array[$i][1]."'},";
}
$str2 = "";
for($i=0;$i<$count;$i++){
    $val = $val.$pie1_array[$i][1].",";
    $str2 = $str2."'".$pie1_array[$i][0]."',";
}

// echo "
// <script type=\"text/javascript\" src=\"http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js\"></script>";
echo "

<script type=\"text/javascript\" src=\"jquery.jqplot/plugins/jqplot.pieRenderer.js\"></script>
<link rel=\"stylesheet\" type=\"text/css\" href=\"jquery.jqplot/jquery.jqplot.css\" />

<script type=\"text/javascript\" src=\"http://cdn.jsdelivr.net/jqplot/1.0.8/plugins/jqplot.dateAxisRenderer.min.js\"></script>

<script type=\"text/javascript\" src=\"jquery.jqplot/jquery.jqplot.js\"></script>
<script type=\"text/javascript\" src=\"jquery.jqplot/plugins/jqplot.dateAxisRenderer.js\"></script>
<script type=\"text/javascript\" src=\"jquery.jqplot/plugins/jqplot.canvasTextRenderer.js\"></script>
<script type=\"text/javascript\" src=\"jquery.jqplot/plugins/jqplot.canvasAxisTickRenderer.js\"></script>
<script type=\"text/javascript\" src=\"jquery.jqplot/plugins/jqplot.categoryAxisRenderer.js\"></script>
<script type=\"text/javascript\" src=\"jquery.jqplot/plugins/jqplot.barRenderer.js\"></script>
<link rel=\"stylesheet\" type=\"text/css\" href=\"jquery.jqplot/jquery.jqplot.css\" />
<script type=\"text/javascript\" src=\"jquery.jqplot/plugins/jqplot.pointLabels.js\"></script>

<script type=\"text/javascript\" src=\"jquery.jqplot/src/plugins/jqplot.canvasAxisLabelRenderer.js\"></script>


<script type=\"text/javascript\" src=\"canvas/canvasjs.min.js\"></script>

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

        callback.call(this,index);
    }
}
</script>";


//  echo "
// $(document).ready(function(){";

//         $.jqplot.config.enablePlugins = true;
//         var s1 = [".$val."];
//         var ticks = [".$str."];
//         var cticks = [".$str2."];
         
//         plot1 = $.jqplot('chart1', [s1], {
            
//             animate: !$.jqplot.use_excanvas,
//             seriesDefaults:{
//                 renderer:$.jqplot.BarRenderer,
//                 pointLabels: { show: true }
//             },
//             axes: {
//                 xaxis: {
//                     renderer: $.jqplot.CategoryAxisRenderer,
//                     ticks: ticks,
//                     labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
//                     tickRenderer: $.jqplot.CanvasAxisTickRenderer,
//                     tickOptions: {
//                         angle: 30
//                     },
//                     label:'Publisher'
//                 },
//                 yaxis:{
//                   labelRenderer: $.jqplot.CanvasAxisLabelRenderer,";
//                   if($data == 'download' || $data == 'subdownload'){
//                     echo "label:'Downloads'";
//                   }
//                   if($data == 'price'){
//                     echo "label:'Price'";
//                   }

//                   echo "
//                 }
//             },
//             highlighter: {
//               show: false
//             }
//         });

//         $('#chart1').on('jqplotDataHighlight',
//             function (ev, seriesIndex, pointIndex, data) {
//                 $('.jqplot-event-canvas').css( 'cursor', 'pointer' );
//             }
//         );

//         $('#chart1').on('jqplotDataUnhighlight', function() {
//             $('.jqplot-event-canvas').css('cursor', 'auto');
//         });

//          $('.jqplot-xaxis-tick')
//         .css({ cursor: \"pointer\", zIndex: \"1\" })
        
//         clickedClassHandler(\"jqplot-xaxis-tick\",function(index){";

//           if($data=='subdownload')    
//                 echo "window.open('bargraph.php?year=".$year."&subject=".$subject."&data=".$data."&publisher='+ticks[index],'_self')";
//               else            
//                 echo "window.open('bargraph.php?year=".$year."&school=".$school."&data=".$data."&publisher='+ticks[index],'_self')";
            
//         echo"});


//         $('#chart1').bind('jqplotDataClick', 
//             function (ev, seriesIndex, pointIndex, data) {";
              
//               if($data=='subdownload')    
//                 echo "window.open('bargraph.php?year=".$year."&subject=".$subject."&data=".$data."&publisher='+ticks[pointIndex],'_self')";
//               else            
//                 echo "window.open('bargraph.php?year=".$year."&school=".$school."&data=".$data."&publisher='+ticks[pointIndex],'_self')";
//             echo"}
//         );";
      


?>
<script>
function onClickp2(e) {
  <?php
    if($data=='subdownload')    
      echo "window.open('bargraph.php?year=".$year."&subject=".$subject."&data=".$data."&publisher='+e.dataPoint.label,'_self')";
    else            
      echo "window.open('bargraph.php?year=".$year."&school=".$school."&data=".$data."&publisher='+e.dataPoint.label,'_self')";
    ?>
}
</script>

<script>
function aaa(){
  $('html, body').animate({
    scrollTop: $("#dtable").offset().top
    }, 1500);
}
</script>


<?php

echo '
<script>
window.onload = function () {
    var chartp2 = new CanvasJS.Chart("chart1",
    {
        animationEnabled: true,
      axisX:{
        title: "publisher",
        labelAngle: 45,
        labelFontSize: 15,
        titleFontSize: 20,
        interval: 1,
      },
      axisY:{
        title: "Downloads",
        labelFontSize: 15,
        titleFontSize: 20,
      },
      data: [
      {
        indexLabelFontColor: "#999",
        indexLabelFontSize: 16,
        cursor: "pointer",
        type: "column",
        click: onClickp2,
        dataPoints: ['.$str3.']
      }
      ]
    });

    chartp2.render();
aaa();
// var myDiv = document.getElementById(\'dtable\');
// myDiv.scrollTop = 0;

  }
  </script>';












// if(isset($_GET('publisher'))){
  
// }



//     echo "});
// </script>";



?>

<html>
<style>

table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
}
th {
    text-align: center;
}

#dtable{
  width: 80%;
  margin-top: 100px;
  margin-left: 10%;
  margin-bottom: 50px;
}
#table{
  width: 100%;
}
.url{
  text-decoration: none;
}
.thead tr th{
  background-color: orange;
}
.tbody{

}
.nourl{
  text-align: center;
}
tr:hover{
  background-color: #dddddd;
}
</style>


<body>
<?php 


if($data=='subdownload'){
  $query = "SELECT count(*), sum(d.total_downloads) from journal j, data".$year." d where d.issn=j.issn and j.subject='".$subject."'";
  $result = mysqli_query($connection,$query);
  $row = mysqli_fetch_row($result);
  // echo "<center><h3 style='margin-top:50px;'>Subject : ".$subject." (".$row[0]." Journals) (".$row[1]." Downloads)</h3></center>";
  echo "<center><h3 style='margin-top:50px;margin-bottom:20px;font-size:20px;'>Subject : ".$subject." (".$row[0];
    if($row[0]>1){
      echo" Resources with ";  
    }
    else{
      echo" Resource with ";
    }
    echo $row[1];
    if($row[1]>1){
      echo" Downloads";
    }
    else{
      echo" Download";
    }

    echo")</h3></center>";
}
if($data == 'download'){
  $query = "SELECT count(*), sum(d.total_downloads) from journal j, data".$year." d where d.issn=j.issn and j.school='".$school."'";
  $result = mysqli_query($connection,$query);
  $row = mysqli_fetch_row($result);
  echo "<center><h3 style='margin-top:50px;margin-bottom:20px;font-size:20px;'>School : ".$school." (".$row[0];
    if($row[0]>1){
      echo" Resources with ";  
    }
    else{
      echo" Resource with ";
    }
    echo $row[1];
    if($row[1]>1){
      echo" Downloads";
    }
    else{
      echo" Download";
    }

    echo")</h3></center>";
}





// if($data=='subdownload')
//   echo "<center><h3 style='margin-top:50px;'>Subject : ".$subject."</h3></center>";
// else            
//   echo "<center><h3 style='margin-top:50px;'>School : ".$school."</h3></center>";

// echo "<a href='graph.php?year=".$year."'>back</a>";
?>
<div>
  <div id="chart1" style="margin-left:10%;width:80%;height:500px"></div>
</div>


<div id="dtable">
<?php
$tt=0;
$ts=0;
if(isset($_GET['publisher'])){
  $publisher = $_GET['publisher'];

  // echo "<center><h3>Publisher : ".$publisher."</h3></center>";

if($data == 'download'){
  $query_bar1 = "SELECT j.jname, j.url, j.subject, d.jan ,  d.feb ,  d.march ,  d.april ,  d.may ,  d.june ,  d.july ,  d.aug ,  d.sept ,
          d.oct,    d.nov ,  d.december ,  d.total_downloads
          FROM publisher p, journal j, ".$tableName." d
          WHERE p.pid=j.pid and j.issn=d.issn and j.school='".$school."' and p.pname='".$publisher."'";
}
if($data == 'subdownload'){
  $query_bar1 = "SELECT j.jname, j.url, j.school, d.jan ,  d.feb ,  d.march ,  d.april ,  d.may ,  d.june ,  d.july ,  d.aug ,  d.sept ,
          d.oct,    d.nov ,  d.december ,  d.total_downloads
          FROM publisher p, journal j, ".$tableName." d
          WHERE p.pid=j.pid and j.issn=d.issn and j.subject='".$subject."' and p.pname='".$publisher."'";
}
if($data == 'price'){
  $query_bar1 = "SELECT p.pname,j.url,sum(pack.subprice), sum(pack.stotal), sum(pack.scpa), sum(pack.ctotal), sum(pack.ccpa), sum(d.total_downloads)
          FROM publisher p, journal j, ".$tableName." d, package".$year." pack
          WHERE p.pid=j.pid and j.issn=d.issn and j.gid=pack.gid and j.school='".$school."' and p.pname='".$publisher."'";
}
  function displayBarData($query) {
    

if($GLOBALS['data'] == 'download'){
      $q = "SELECT sum(d.jan) ,  sum(d.feb) ,  sum(d.march) ,  sum(d.april) ,  sum(d.may) ,  sum(d.june) ,  sum(d.july) ,  sum(d.aug) ,  sum(d.sept),
          sum(d.oct), sum(d.nov) ,  sum(d.december) ,  sum(d.total_downloads)
          FROM publisher p, journal j, ".$GLOBALS['tableName']." d
          WHERE p.pid=j.pid and j.issn=d.issn";

      // $con=mysqli_connect("localhost","root","","journals_data");
          include('connection.php');
          $con = $connection;
      $r = mysqli_query($con,$q);
      $p = mysqli_fetch_row($r);
    }
    if($GLOBALS['data'] == 'subdownload'){
      $q = "SELECT sum(d.jan) ,  sum(d.feb) ,  sum(d.march) ,  sum(d.april) ,  sum(d.may) ,  sum(d.june) ,  sum(d.july) ,  sum(d.aug) ,  sum(d.sept),
          sum(d.oct), sum(d.nov) ,  sum(d.december) ,  sum(d.total_downloads)
          FROM publisher p, journal j, ".$GLOBALS['tableName']." d
          WHERE p.pid=j.pid and j.issn=d.issn";

      // $con=mysqli_connect("localhost","root","","journals_data");
          include('connection.php');
          $con = $connection;
      $r = mysqli_query($con,$q);
      $p = mysqli_fetch_row($r);
    }



    if($GLOBALS['data']=='download'){
    $re = "<table id='table'><thead class=\"thead\">
      <tr>
      <th>Sl. No</th>
      <th>JOURNAL</th>
      <th>SUBJECT</th>
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
    }
    if($GLOBALS['data']=='subdownload'){
    $re = "<table id='table'><thead class=\"thead\">
      <tr>
      <th>Sl. No</th>
      <th>JOURNAL</th>
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
    }
    if($GLOBALS['data']=='price'){
      $re = "<table id='table'><thead class=\"thead\">
      <tr>
      <th>Sl. No</th>
      <th>AUTHOR</th>
      <th>SUB PRICE</th>
      <th>TOTAL PRICE<br>(SUBSCRIBED)</th>
      <th>COST PER ARTICLE<br>(SUBSCRIBED)</th>
      <th>TOTAL PRICE<br>(COMPLEMENTARY)</th>
      <th>COST PER ARTICLE<br>(COMPLEMENTARY)</th>
      <th>TOTAL<br>DOWNLOADS</th>
      </tr>
    </thead>
    <tbody class=\"tbody\">";
    }
    // $connection=mysqli_connect("localhost","root","","journals_data");
    include('connection.php');
    $result=mysqli_query($connection,$query);
    $c=0;

    if($GLOBALS['data']=='download' ||$GLOBALS['data']=='subdownload'){
      $count=16;
    }
    if($GLOBALS['data']=='price'){
      $count=8;
    }

    while ($row = mysqli_fetch_row($result)) {
    $re .= "<tr>\n";
      $c++;
      $i=0;    
      // while($i < $count){
        
      //   if($i==0){
      //     $re .= " <td class=\"nourl\">".$c."</td><td><a class='url' href=".$row[$i+1].">".$row[$i]."</a></td>\n";  
      //     $i++;
      //   }
      //   else{
      //     $re .= " <td class=\"nourl\">".$row[$i]."</td>\n";
      //   }
        
      //   $i++;
      // }



      $re .= " <td class=\"nourl\">".$c."</td><td><a class='url' href=".$row[1].">".$row[0]."</a></td>";
      $re .= "<td class=\"nourl\">".$row[2]."</td>";

      while($i<12){
        if($p[$i]==0){
          $re .= "<td class=\"nourl\"> - </td>";
        }
        else{
          $re .= "<td class=\"nourl\">".$row[($i+3)]."</td>";
        }
        $i++;
      }
      $re.="<td class=\"nourl\">".$row[15]."</td>";



    $re .= "</tr>\n";
    }

    $GLOBALS['ts'] = $c;

    if($GLOBALS['data'] == 'download'){
      $q = "SELECT sum(d.jan) ,  sum(d.feb) ,  sum(d.march) ,  sum(d.april) ,  sum(d.may) ,  sum(d.june) ,  sum(d.july) ,  sum(d.aug) ,  sum(d.sept),
          sum(d.oct), sum(d.nov) ,  sum(d.december) ,  sum(d.total_downloads)
          FROM publisher p, journal j, ".$GLOBALS['tableName']." d
          WHERE p.pid=j.pid and j.issn=d.issn and j.school='".$GLOBALS['school']."' and p.pname='".$GLOBALS['publisher']."'";

      // $con=mysqli_connect("localhost","root","","journals_data");
          include('connection.php');
          $con = $connection;
      $r = mysqli_query($con,$q);
      
      if($p = mysqli_fetch_row($r)){
      $re.="<tr style=\"background-color:orange;\"><th></th><th></th><th>Total</th> <th>".$p[0]."</th><th>".$p[1]."</th><th>".$p[2]."</th><th>".$p[3]."</th><th>".$p[4]."</th>
      <th>".$p[5]."</th><th>".$p[6]."</th><th>".$p[7]."</th><th>".$p[8]."</th><th>".$p[9]."</th><th>".$p[10]."</th><th>".$p[11]."</th>
      <th>".$p[12]."</th></tr>";
      $GLOBALS['tt'] = $p[12];
      }
    }
    if($GLOBALS['data'] == 'subdownload'){
      $q = "SELECT sum(d.jan) ,  sum(d.feb) ,  sum(d.march) ,  sum(d.april) ,  sum(d.may) ,  sum(d.june) ,  sum(d.july) ,  sum(d.aug) ,  sum(d.sept),
          sum(d.oct), sum(d.nov) ,  sum(d.december) ,  sum(d.total_downloads)
          FROM publisher p, journal j, ".$GLOBALS['tableName']." d
          WHERE p.pid=j.pid and j.issn=d.issn and j.subject='".$GLOBALS['subject']."' and p.pname='".$GLOBALS['publisher']."'";

      // $con=mysqli_connect("localhost","root","","journals_data");
          include('connection.php');
          $con = $connection;
      $r = mysqli_query($con,$q);
      
      if($p = mysqli_fetch_row($r)){
      $re.="<tr style=\"background-color:orange;\"><th></th><th></th><th>Total</th> <th>".$p[0]."</th><th>".$p[1]."</th><th>".$p[2]."</th><th>".$p[3]."</th><th>".$p[4]."</th>
      <th>".$p[5]."</th><th>".$p[6]."</th><th>".$p[7]."</th><th>".$p[8]."</th><th>".$p[9]."</th><th>".$p[10]."</th><th>".$p[11]."</th>
      <th>".$p[12]."</th></tr>";
      $GLOBALS['tt'] = $p[12];
      }
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
}


?>

</div>

</body>
</html>