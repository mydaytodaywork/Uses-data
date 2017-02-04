<?php

$qt = "SELECT SUM(".$tableName.".total_downloads) FROM ".$tableName." INNER JOIN journal ON journal.issn=".$tableName.".issn";
$rt = mysqli_query($connection,$qt);
$tdown = mysqli_fetch_row($rt);

$query_pie1 = "SELECT journal.school,SUM(".$tableName.".total_downloads) FROM ".$tableName." INNER JOIN journal ON journal.issn=".$tableName.".issn GROUP by journal.school";
$result = mysqli_query($connection,$query_pie1);

// {  y: 83.24, legendText:"Google", label: "Google" },
$pie2_array=array();
  while($row = mysqli_fetch_row($result)){
  	// $val0 = ((float)$row[0]/(float)$tdown)*100;
  	$val1 = ((float)$row[1]/(float)$tdown[0])*100;
    array_push($pie2_array,array($row[0],$val1));
  }
  

$count = count($pie2_array);
$str2 = "";
for($i=0;$i<$count;$i++){
    $str2 = $str2."{  y: ".$pie2_array[$i][1].", legendText:\"".$pie2_array[$i][0]."\",label:\"".$pie2_array[$i][0]."\"},";
}
?>


<script type="text/javascript">
window.onload = function () {
	var chart = new CanvasJS.Chart("pie3",
	{
		title:{
			text: "Subject VS Download"
		},
                animationEnabled: true,
		legend:{
			verticalAlign: "center",
			horizontalAlign: "left",
			fontSize: 15,
			cursor: "pointer" ,
			itemclick:onClickt,
			fontFamily: "Helvetica"        
		},
		theme: "theme2",
		data: [
		{        
			type: "pie",       
			indexLabelFontFamily: "Garamond",       
			indexLabelFontSize: 20,
			indexLabel: "{label} {y}%",
			startAngle:-20,
			cursor: "pointer" ,      
			showInLegend: true,
			click:onClickt,
			toolTipContent:"{legendText} {y}%",
			// dataPoints: [<?php echo $str2;?>]
			dataPoints: [
				{  y: 83.24, legendText:"Google", label: "Google" },
				{  y: 8.16, legendText:"Yahoo!", label: "Yahoo!" },
				{  y: 4.67, legendText:"Bing", label: "Bing" },
				{  y: 1.67, legendText:"Baidu" , label: "Baidu"},       
				{  y: 0.98, legendText:"Others" , label: "Others"}
			]
		}
		]
	});
	chart.render();
	chart = {};
	function onClickt(e) {
		// alert(  e.dataSeries.type + ", dataPoint { x:" + e.dataPoint.label + ", y: "+ e.dataPoint.y + " }" );
		<?php echo "window.open('bargraph.php?year=".$year."&data=subdownload&subject='e.dataPoint.label,'_self');";?>
	}
}
</script>
<script type="text/javascript" src="canvas/canvasjs.min.js"></script> 