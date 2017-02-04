<?php



$query_publisher = "SELECT p.pname,SUM(d.total_downloads)
        FROM publisher p, journal j, ".$tableName." d
        WHERE p.pid=j.pid and j.issn=d.issn
        group by p.pid";
$result = mysqli_query($connection,$query_publisher);

$bar1_array=array();
  while($row = mysqli_fetch_row($result)){
    array_push($bar1_array,array($row[0],$row[1]));
  }
  
$count = count($bar1_array);
// $val = "";
// $str = "";
$strp = "";
for($i=0;$i<$count;$i++){
    // $val = $val.$pie1_array[$i][1].",";
    // $str = $str."'".$pie1_array[$i][0]."',";
    $strp = $strp."{label: \"".$bar1_array[$i][0]."\" , y: ".$bar1_array[$i][1].", indexLabel: '".$bar1_array[$i][1]."'},";
}


// echo "
// <script>

// $(document).ready(function(){
        



//         $.jqplot.config.enablePlugins = true;
//         var s1 = [".$val."];
//         var ticks = [".$str."];
         
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
//                         angle: 80
//                     },
//                     label:'Publisher'
//                 },
//                 yaxis:{
//                   labelRenderer: $.jqplot.CanvasAxisLabelRenderer
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
        
//         clickedClassHandler(\"jqplot-xaxis-tick\",function(index){
//             window.open('bargraph2.php?year=".$year."&publisher='+ticks[index],'_self');
//         });

// 		$('#chart1').bind('jqplotDataClick', 
//             function (ev, seriesIndex, pointIndex, data) {        
//                 window.open('bargraph2.php?year=".$year."&publisher='+ticks[pointIndex],'_self');
//             }
//         );

// });
// </script>";


echo '


    var chartp = new CanvasJS.Chart("chart1",
    {
        animationEnabled: true,
      axisX:{
        title: "Publisher",
        labelAngle: 45,
        labelFontSize: 15,
        interval: 1,
        titleFontSize: 20
      },
      data: [
      {
        indexLabelFontColor: "#999",
        indexLabelFontSize: 16,
        cursor: "pointer",
        type: "column",
        click:onClickp,
        dataPoints: [
        '.$strp.'
        ]
      }
      ]
    });

    chartp.render();';


?>