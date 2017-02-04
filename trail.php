<?php


$qt = "SELECT SUM(".$tableName.".total_downloads) FROM ".$tableName." INNER JOIN journal ON journal.issn=".$tableName.".issn";
$rt = mysqli_query($connection,$qt);
$tdown = mysqli_fetch_row($rt);

$query_pie1 = "SELECT journal.school,SUM(".$tableName.".total_downloads) FROM ".$tableName." INNER JOIN journal ON journal.issn=".$tableName.".issn GROUP by journal.school";
$result = mysqli_query($connection,$query_pie1);

// {  y: 83.24, legendText:"Google", label: "Google" },
$pie1_array=array();
  while($row = mysqli_fetch_row($result)){
  	// $val0 = ((float)$row[0]/(float)$tdown)*100;
  	$val1 = round(((float)$row[1]/(float)$tdown[0])*100,2);
    array_push($pie1_array,array($row[0],$val1));
  }
  

$count = count($pie1_array);
$str = "";
for($i=0;$i<$count;$i++){
    $str = $str."{  y: ".$pie1_array[$i][1].", legendText:\"".$pie1_array[$i][0]."\",label:\"".$pie1_array[$i][0]."\"},";
}

?>


<script type="text/javascript">

function onClick(e) {
	document.getElementById("ag1").style.backgroundColor = "orange";
	document.getElementById("ag2").style.backgroundColor = "black";
	document.getElementById("ag3").style.backgroundColor = "black";
	document.getElementById("ag4").style.backgroundColor = "black";
		<?php
		echo "window.open('bargraph.php?year=".$year."&data=download&school='+e.dataPoint.label,'_self');";
        ?>
	}

function onClick2(e) {
	<?php
		echo "window.open('bargraph.php?year=".$year."&data=subdownload&subject='+e.dataPoint.label,'_self');";
    ?>
}

function onClick3(e) {
		<?php
		echo "window.open('bargraph2.php?year=".$year."&publisher='+e.dataPoint.label,'_self');";
        ?>
	}

function onClick4(e) {
	<?php
		echo "window.open('graph.php?year='+e.dataPoint.label,'_self');";
    ?>
}

function onClickp(e) {
	<?php
		echo "window.open('bargraph2.php?year=".$year."&publisher='+e.dataPoint.label,'_self');";
    ?>
}

window.onload = function () {

document.getElementById('pie3').style.display = 'none';
document.getElementById('pie5').style.display = 'none';
document.getElementById('pie4').style.display = 'none';
document.getElementById('pie1').style.display = 'block';

CanvasJS.addColorSet("greenShades",
                [//colorSet Array
                "#4661EE",
			    "#EC5657",
			    "#1BCDD1",
			    "#B08BEB",
			    "#3EA0DD",
			    "#F5A52A",
			    "#23BFAA",
			    "#F5DEB3",
                "#2F4F4F",
                "#008080",
                "#2E8B57",
                "#3CB371",
                "#90EE90"                
                ]);

	var chart = new CanvasJS.Chart("pie1",
	{
        animationEnabled: true,
        colorSet: "greenShades",
		legend:{
			verticalAlign: "center",
			horizontalAlign: "right",
			fontSize: 15,
			cursor: "pointer" ,
			itemclick:onClick,
			fontFamily: "Helvetica"        
		},
		theme: "theme2",
		data: [
		{        
			type: "pie",       
			indexLabelFontFamily: "Garamond",       
			indexLabelFontSize: 15,
			indexLabel: "{label} {y}%",
			startAngle:-20,
			cursor: "pointer" ,      
			showInLegend: true,
			click:onClick,
			toolTipContent:"{legendText} {y}%",
			dataPoints: [<?php echo $str;?>]
		}
		]
	});
	chart.render();


<?php

$qt = "SELECT SUM(".$tableName.".total_downloads) FROM ".$tableName." INNER JOIN journal ON journal.issn=".$tableName.".issn";
$rt = mysqli_query($connection,$qt);
$tdown = mysqli_fetch_row($rt);

$query_pie1 = "SELECT journal.subject,SUM(".$tableName.".total_downloads) FROM ".$tableName." INNER JOIN journal ON journal.issn=".$tableName.".issn GROUP by journal.subject";
$result = mysqli_query($connection,$query_pie1);

// {  y: 83.24, legendText:"Google", label: "Google" },
$pie2_array=array();
  while($row = mysqli_fetch_row($result)){
  	// $val0 = ((float)$row[0]/(float)$tdown)*100;
  	$val1 = round(((float)$row[1]/(float)$tdown[0])*100,2);
    array_push($pie2_array,array($row[0],$val1));
  }
  

$count = count($pie2_array);
$str2 = "";
for($i=0;$i<$count;$i++){
    $str2 = $str2."{  y: ".$pie2_array[$i][1].", legendText:\"".$pie2_array[$i][0]."\",label:\"".$pie2_array[$i][0]."\"},";
}
?>




	var chart3 = new CanvasJS.Chart("pie3",
	{
        animationEnabled: true,
        colorSet: "greenShades",
		legend:{
			verticalAlign: "center",
			horizontalAlign: "right",
			fontSize: 15,
			cursor: "pointer" ,
			itemclick:onClick2,
			fontFamily: "Helvetica"        
		},
		theme: "theme2",
		data: [
		{        
			type: "pie",       
			indexLabelFontFamily: "Garamond",       
			indexLabelFontSize: 15,
			indexLabel: "{label} {y}%",
			startAngle:-20,
			cursor: "pointer" ,      
			showInLegend: true,
			click:onClick2,
			toolTipContent:"{legendText} {y}%",
			dataPoints: [<?php echo $str2;?>]
		}
		]
	});
	chart3.render();







<?php

$qt = "select sum(d.total_downloads) from publisher p, journal j, data".$year." d where p.pid=j.pid and j.issn=d.issn group by p.pid ORDER BY sum(d.total_downloads) DESC LIMIT 5";
$rt = mysqli_query($connection,$qt);
$tdown1 = 0;
while($x = mysqli_fetch_row($rt)){
	$tdown1 = $tdown1 + $x[0];
}

$query_pie1 = "select p.pname, sum(d.total_downloads) from publisher p, journal j, data".$year." d where p.pid=j.pid and j.issn=d.issn group by p.pid ORDER BY sum(d.total_downloads) DESC LIMIT 5";
$result = mysqli_query($connection,$query_pie1);

// {  y: 83.24, legendText:"Google", label: "Google" },
$pie3_array=array();
  while($row = mysqli_fetch_row($result)){
  	// $val0 = ((float)$row[0]/(float)$tdown)*100;
  	$val1 = round(((float)$row[1]/(float)$tdown1)*100,2);
    array_push($pie3_array,array($row[0],$val1));
  }
  

$count = count($pie3_array);
$str3 = "";
for($i=0;$i<$count;$i++){
    $str3 = $str3."{  y: ".$pie3_array[$i][1].", legendText:\"".$pie3_array[$i][0]."\",label:\"".$pie3_array[$i][0]."\"},";
}
?>




	var chart4 = new CanvasJS.Chart("pie4",
	{
        animationEnabled: true,
        colorSet: "greenShades",
		legend:{
			verticalAlign: "center",
			horizontalAlign: "right",
			fontSize: 15,
			cursor: "pointer" ,
			itemclick:onClick3,
			fontFamily: "Helvetica"        
		},
		theme: "theme2",
		data: [
		{        
			type: "pie",       
			indexLabelFontFamily: "Garamond",       
			indexLabelFontSize: 15,
			indexLabel: "{label} {y}%",
			startAngle:-20,
			cursor: "pointer" ,      
			showInLegend: true,
			click:onClick3,
			toolTipContent:"{legendText} {y}%",
			dataPoints: [<?php echo $str3;?>]
		}
		]
	});
	chart4.render();





// <?php

// $lastyears=5;
// $tdown2 = 0;
// while($lastyears){
// 	$qt = "select sum(d.total_downloads) from data".($year-$lastyears+1)." d";
// 	$rt = mysqli_query($connection,$qt);
// 	$x = mysqli_fetch_row($rt);
// 	$tdown2 += $x[0];

// 	$lastyears -= 1;
// }

// $lastyears=5;
// $pie4_array=array();
// while($lastyears){

// 	$qt = "select sum(d.total_downloads) from data".($year-$lastyears+1)." d";
// 	$rt = mysqli_query($connection,$qt);
// 	$x = mysqli_fetch_row($rt);

//   	$val1 = round(((float)$x[0]/(float)$tdown2)*100,2);
//     array_push($pie4_array,array(($year-$lastyears+1),$val1));
	
// 	$lastyears -= 1;
// }

// $count = count($pie4_array);
// $str4 = "";
// for($i=0;$i<$count;$i++){
//     $str4 = $str4."{  y: ".$pie4_array[$i][1].", legendText:\"".$pie4_array[$i][0]."\",label:\"".$pie4_array[$i][0]."\"},";
// }
// ?>

<?php
$startindex = 0;
$endindex = 0;
$minindex = 1;
$yearindex=0;
$query = "select year_data from year";
$run = mysqli_query($connection,$query);
$maxindex = mysqli_num_rows($run);
while($row = mysqli_fetch_row($run)){
	$yearindex++;
	if($row[0] == $year){
		break;
	}
}

if($maxindex<=5){
	$startindex = $minindex;
	$endindex = $maxindex;
}
else{
	if($yearindex+2 > $maxindex){
		$startindex = $maxindex-4;
		$endindex = $maxindex;
	}
	else if($yearindex-2 < $minindex){
		$startindex = $minindex;
		$endindex = $minindex+4;
	}
	else{
		$startindex = $yearindex-2;
		$endindex = $yearindex+2;
	}

}

$query = "select year_data from year";
$run = mysqli_query($connection,$query);
$cr=0;
$tdown2 =0;
while($row = mysqli_fetch_row($run)){
	$cr++;
	if($cr >= $startindex && $cr <= $endindex){
		$qt = "select sum(d.total_downloads) from data".$row[0]." d";
		$rt = mysqli_query($connection,$qt);
		$x = mysqli_fetch_row($rt);
		$tdown2 += $x[0];
	}
}


$pie4_array=array();
$query = "select year_data from year";
$run = mysqli_query($connection,$query);
$cr=0;
while($row = mysqli_fetch_row($run)){
	$cr++;
	if($cr >= $startindex && $cr <= $endindex){

		$qt = "select sum(d.total_downloads) from data".$row[0]." d";
		$rt = mysqli_query($connection,$qt);
		$x = mysqli_fetch_row($rt);
	  	$val1 = round(((float)$x[0]/(float)$tdown2)*100,2);
	    array_push($pie4_array,array($row[0],$val1));
		
	}
}


$count = count($pie4_array);
$str4 = "";
for($i=0;$i<$count;$i++){
    $str4 = $str4."{  y: ".$pie4_array[$i][1].", legendText:\"".$pie4_array[$i][0]."\",label:\"".$pie4_array[$i][0]."\"},";
}

?>


	var chart5 = new CanvasJS.Chart("pie5",
	{
        animationEnabled: true,
        colorSet: "greenShades",
		legend:{
			verticalAlign: "center",
			horizontalAlign: "right",
			fontSize: 15,
			cursor: "pointer" ,
			itemclick:onClick4,
			fontFamily: "Helvetica"        
		},
		theme: "theme2",
		data: [
		{        
			type: "pie",       
			indexLabelFontFamily: "Garamond",       
			indexLabelFontSize: 15,
			indexLabel: "{label} {y}%",
			startAngle:-20,
			cursor: "pointer" ,      
			showInLegend: true,
			click:onClick4,
			toolTipContent:"{legendText} {y}%",
			dataPoints: [<?php echo $str4;?>]
		}
		]
	});
	chart5.render();



<?php
	include('graphpublisher.php');
?>


}







function graph1(){
	document.getElementById('pie3').style.display = 'none';
	document.getElementById('pie5').style.display = 'none';
	document.getElementById('pie4').style.display = 'none';
	document.getElementById('pie1').style.display = 'block';
	
	
	var chart = new CanvasJS.Chart("pie1",
	{
        animationEnabled: true,
        colorSet: "greenShades",
		legend:{
			verticalAlign: "center",
			horizontalAlign: "right",
			fontSize: 15,
			cursor: "pointer" ,
			itemclick:onClick,
			fontFamily: "Helvetica"        
		},
		theme: "theme2",
		data: [
		{        
			type: "pie",       
			indexLabelFontFamily: "Garamond",       
			indexLabelFontSize: 15,
			indexLabel: "{label} {y}%",
			startAngle:-20,
			cursor: "pointer" ,      
			showInLegend: true,
			click:onClick,
			toolTipContent:"{legendText} {y}%",
			dataPoints: [<?php echo $str;?>]
		}
		]
	});

	chart.render();
}  
function graph3(){
	document.getElementById('pie1').style.display = 'none';
	document.getElementById('pie5').style.display = 'none';
	document.getElementById('pie4').style.display = 'none';
	document.getElementById('pie3').style.display = 'block';
	

	var chart3 = new CanvasJS.Chart("pie3",
	{
        animationEnabled: true,
        colorSet: "greenShades",
		legend:{
			verticalAlign: "center",
			horizontalAlign: "right",
			fontSize: 15,
			cursor: "pointer",
			itemclick:onClick2,
			fontFamily: "Helvetica"        
		},
		theme: "theme2",
		data: [
		{        
			type: "pie",       
			indexLabelFontFamily: "Garamond",       
			indexLabelFontSize: 15,
			indexLabel: "{label} {y}%",
			startAngle:-20,
			cursor: "pointer" ,      
			showInLegend: true,
			click:onClick2,
			toolTipContent:"{legendText} {y}%",
			dataPoints: [<?php echo $str2;?>]
		}
		]
	});

	
	chart3.render();
}

function graph4(){
	document.getElementById('pie1').style.display = 'none';
	document.getElementById('pie3').style.display = 'none';
	document.getElementById('pie5').style.display = 'none';
	document.getElementById('pie4').style.display = 'block';


	//5 publisher

	var chart4 = new CanvasJS.Chart("pie4",
	{
        animationEnabled: true,
        colorSet: "greenShades",
		legend:{
			verticalAlign: "center",
			horizontalAlign: "right",
			fontSize: 15,
			cursor: "pointer",
			itemclick:onClick3,
			fontFamily: "Helvetica"        
		},
		theme: "theme2",
		data: [
		{        
			type: "pie",       
			indexLabelFontFamily: "Garamond",       
			indexLabelFontSize: 15,
			indexLabel: "{label} {y}%",
			startAngle:-20,
			cursor: "pointer" ,
			click:onClick3,      
			showInLegend: true,
			toolTipContent:"{legendText} {y}%",
			dataPoints: [<?php echo $str3;?>]
		}
		]
	});
	chart4.render();


}

function graph5(){
	document.getElementById('pie1').style.display = 'none';
	document.getElementById('pie3').style.display = 'none';
	document.getElementById('pie4').style.display = 'none';
	document.getElementById('pie5').style.display = 'block';

	//5 years

	var chart5 = new CanvasJS.Chart("pie5",
	{
        animationEnabled: true,
        colorSet: "greenShades",
		legend:{
			verticalAlign: "center",
			horizontalAlign: "right",
			fontSize: 15,
			cursor: "pointer",
			itemclick:onClick4,
			fontFamily: "Helvetica"        
		},
		theme: "theme2",
		data: [
		{        
			type: "pie",       
			indexLabelFontFamily: "Garamond",       
			indexLabelFontSize: 15,
			indexLabel: "{label} {y}%",
			startAngle:-20,
			cursor: "pointer" ,
			click:onClick4,      
			showInLegend: true,
			toolTipContent:"{legendText} {y}%",
			dataPoints: [<?php echo $str4;?>]
		}
		]
	});
	chart5.render();


}

</script>
<script type="text/javascript" src="canvas/canvasjs.min.js"></script> 