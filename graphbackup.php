<?php
echo "
<script type=\"text/javascript\" src=\"http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js\"></script>
<script type=\"text/javascript\" src=\"jquery.jqplot/jquery.jqplot.js\"></script>
<script type=\"text/javascript\" src=\"jquery.jqplot/plugins/jqplot.pieRenderer.js\"></script>
<link rel=\"stylesheet\" type=\"text/css\" href=\"jquery.jqplot/jquery.jqplot.css\" />

<script>
$(document).ready(function(){
    var plot1 = $.jqplot('pie1', [[['".$pie1_array[0][0]."',".$pie1_array[0][1]."],['".$pie1_array[1][0]."',".$pie1_array[1][1]."],['".$pie1_array[2][0]."',".$pie1_array[2][1]."]]], {
        gridPadding: {top:0, bottom:38, left:0, right:0},
        seriesDefaults:{
            renderer:$.jqplot.PieRenderer, 
            trendline:{ show:false }, 
            rendererOptions: { padding: 8, showDataLabels: true }
        },
        legend:{
            show:true, 
            placement: 'outside', 
            rendererOptions: {
                numberRows: 1
            }, 
            location:'s',
            marginTop: '15px'
        }       
    });

    var plot2 = $.jqplot('pie2', [[['".$pie2_array[0][0]."',".$pie2_array[0][1]."],['".$pie2_array[1][0]."',".$pie2_array[1][1]."],['".$pie2_array[2][0]."',".$pie2_array[2][1]."]]], {
        gridPadding: {top:0, bottom:38, left:0, right:0},
        seriesDefaults:{
            renderer:$.jqplot.PieRenderer, 
            trendline:{ show:false }, 
            rendererOptions: { padding: 8, showDataLabels: true }
        },
        legend:{
            show:true, 
            placement: 'outside', 
            rendererOptions: {
                numberRows: 1
            }, 
            location:'s',
            marginTop: '15px'
        }       
    });
});

</script>
";?>