<?php


$query_pie2 = "select j.school,sum(pack.subprice) from publisher p, journal j, ".$tableName." d, package".$year." pack 
where p.pid=j.pid and j.issn=d.issn and j.gid=pack.gid group by j.school";
$result = mysqli_query($connection,$query_pie2);

$pie2_array=array();
  while($row = mysqli_fetch_row($result)){
    array_push($pie2_array,array($row[0],$row[1]));
  }
  

$count = count($pie2_array);
$str = "";


for($i=0;$i<$count;$i++){
    $str = $str."['".$pie2_array[$i][0]."',".$pie2_array[$i][1]."],";
}

echo "
<script>
$(document).ready(function(){
    var label1 = [".$str."];
    var plot1 = $.jqplot('pie2', [[".$str."]], {
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
            marginLeft: '20px'
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

    $('#pie2').bind('jqplotDataClick', 
            function (ev, seriesIndex, pointIndex, data) {
                window.open('bargraph.php?year=".$year."&data=price&school='+data[0],'_self');
            }
        );

    $('#pie2').on('jqplotDataHighlight',
        function (ev, seriesIndex, pointIndex, data) {
            $('.jqplot-event-canvas').css( 'cursor', 'pointer' );
        }
    );

    $('#pie2').on('jqplotDataUnhighlight', function() {
        $('.jqplot-event-canvas').css('cursor', 'auto');
    });

    $('.jqplot-table-legend')
        .css({ cursor: \"pointer\", zIndex: \"100\" })
        
	
	

});
</script>
";
?>