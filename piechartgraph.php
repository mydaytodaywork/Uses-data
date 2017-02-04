<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="jquery.jqplot/jquery.jqplot.js"></script>
<script type="text/javascript" src="jquery.jqplot/plugins/jqplot.pieRenderer.js"></script>
<link rel="stylesheet" type="text/css" href="jquery.jqplot/jquery.jqplot.css" />
<script type="text/javascript" src="jquery.jqplot/plugins/jqplot.barRenderer.js"></script>
<script type="text/javascript" src="jquery.jqplot/plugins/jqplot.categoryAxisRenderer.js"></script>
<script type="text/javascript" src="jquery.jqplot/plugins/jqplot.pointLabels.js"></script>
<link rel="stylesheet" type="text/css" href="jquery.jqplot/jquery.jqplot.css" />

<script type="text/javascript" src="jquery.jqplot/plugins/jqplot.highlighter.js"></script>
<script type="text/javascript" src="http://cdn.jsdelivr.net/jqplot/1.0.8/plugins/jqplot.dateAxisRenderer.min.js"></script>

<script type="text/javascript" src="jquery.jqplot/plugins/jqplot.dateAxisRenderer.js"></script>
<script type="text/javascript" src="jquery.jqplot/plugins/jqplot.canvasTextRenderer.js"></script>
<script type="text/javascript" src="jquery.jqplot/plugins/jqplot.canvasAxisTickRenderer.js"></script>
<script type="text/javascript" src="jquery.jqplot/plugins/jqplot.barRenderer.js"></script>

<script type="text/javascript" src="jquery.jqplot/src/plugins/jqplot.canvasAxisLabelRenderer.js"></script>
<script type="text/javascript" src="jquery.jqplot/plugins/jqplot.cursor.js"></script>
<script type="text/javascript" src="jquery.jqplot/plugins/jqplot.highlighter.js"></script>
<script type="text/javascript" src="jquery.jqplot/plugins/jqplot.dragable.js"></script>
<script type="text/javascript" src="jquery.jqplot/plugins/jqplot.trendline.js"></script>
<link rel="stylesheet" type="text/css" href="jquery.jqplot/jquery.jqplot.css" />


<script>
$(document).ready(function(){
 
    data1 = [[['Apples', 210],['Oranges', 111], ['Bananas', 74], ['Grapes', 72],['Pears', 49]]];
    toolTip1 = ['Red Delicious Apples', 'Parson Brown Oranges', 'Cavendish Bananas', 'Albaranzeuli Nero Grapes', 'Green Anjou Pears'];
 
    var plot1 = jQuery.jqplot('chart1', 
        data1,
        {
            title: 'Pie Chart', 
            seriesDefaults: {
                shadow: false, 
                renderer: jQuery.jqplot.PieRenderer, 
                rendererOptions: { padding: 2, sliceMargin: 2, showDataLabels: true }
            },
		grid: {
            drawBorder: false, 
            drawGridlines: false,
            background: '#ffffff',
            shadow:false
        },
		highlighter: {
        show: true,
        useAxesFormatters: false,
        tooltipFormatString: '%s',
        sizeAdjust: 7.5
      	},
		cursor: {
         show: true
     },
         legend: {
                show: true,
                location: 'e',
                renderer: $.jqplot.EnhancedPieLegendRenderer,
                rendererOptions: {
                    numberColumns: 1,
                    toolTips: toolTip1
                }
            },
			rendererOptions: {
				// speed up the animation a little bit.
				// This is a number of milliseconds.
				// Default for a line series is 2500.
				animation: {
					speed: 2000
				}
			}
       
        }
    );
	
	$('#chart1').bind('jqplotDataClick',
    function (ev, seriesIndex, pointIndex, data) {
      alert("data = " + data[0]);
		});
	});
	
	
</script>

<link rel="stylesheet" type="text/css" href="jquery.jqplot//jquery.jqplot.css" />

<body>
Hi
<div id="chart1" ></div>
</body>