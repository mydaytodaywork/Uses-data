<?php


$query_pie1 = "SELECT journal.school,SUM(".$tableName.".total_downloads) FROM ".$tableName." INNER JOIN journal ON journal.issn=".$tableName.".issn GROUP by journal.school";
$result = mysqli_query($connection,$query_pie1);

$pie1_array=array();
  while($row = mysqli_fetch_row($result)){
    array_push($pie1_array,array($row[0],$row[1]));
  }
  

$count = count($pie1_array);
$str = "";
for($i=0;$i<$count;$i++){
    $str = $str."['".$pie1_array[$i][0]."',".$pie1_array[$i][1]."],";
}

echo "
<script>
var label1 = '';
$(document).ready(function(){
    label1 = [".$str."];
    var plot1 = $.jqplot('pie1', [[".$str."]], {
        gridPadding: {top:0, bottom:38, left:0, right:0},
        seriesDefaults:{
            renderer:$.jqplot.PieRenderer, 
            trendline:{ show:false }, 
            rendererOptions: { padding: 8, showDataLabels: true },
        },
        // seriesColors:['#0072BB', '#FF4C3B', '#FFD034', '#00749F', '#73C774', '#C7754C', '#17BDB8'],
        grid: {
            drawBorder: false, 
            drawGridlines: false,
            background: '#ffffff',
            shadow:false
        },
        legend:{
            show:true, 
            placement: 'outside', 
            rendererOptions: {
                numberRows: ".$count."
            }, 
            location:'e',
            marginLeft: '10px'
        },

      highlighter: {
        show: true,
        useAxesFormatters: false,
        tooltipFormatString: '%s',
        sizeAdjust: 7.5
      },
      cursor: {
        show: false
      }
    });

    $('#pie1').bind('jqplotDataClick', 
            function (ev, seriesIndex, pointIndex, data) {
                window.open('bargraph.php?year=".$year."&data=download&school='+data[0],'_self');
            }
        );

    $('#pie1').on('jqplotDataHighlight',
        function (ev, seriesIndex, pointIndex, data) {
            $('.jqplot-event-canvas').css( 'cursor', 'pointer' );
        }
    );

    $('#pie1').on('jqplotDataUnhighlight', function() {
        $('.jqplot-event-canvas').css('cursor', 'auto');
    });

    $('.jqplot-table-legend')
        .css({ cursor: \"pointer\", zIndex: \"100\" })
        
    clickedClassHandler(\"jqplot-table-legend\",function(index){
        if ( $(\".jqplot-table-legend\").parents(\"#pie1\").length == 1 ) 
        window.open('bargraph.php?year=".$year."&data=download&school='+label1[index][0],'_self');
    });

});
</script>
";
?>