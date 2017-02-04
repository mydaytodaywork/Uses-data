<style type="text/css">
table {
 border-collapse: collapse;
}        
td {
 border: 1px solid black;
 padding: 0 0.5em;
}        
#pageno{
	text-decoration:none;
	margin-right:10px;
	color:black;
	padding:5px;
	border: 2px solid black;
	text-align:center;
	background-color:#ff6600;
}
</style>

<?php
	function display($query1,$query2,$month){
		// $connection=mysqli_connect("localhost","root","","journals_data");
		include('connection.php');
		$perpage=100;
		
		if(!isset($_GET['sort']))
			$sort="issn";
		else
			$sort=htmlentities($_GET['sort']);
		
		$excel_data=displayData($query1);	//exact data printing-query1
		echo $excel_data;
		
		$result=mysqli_query($connection,$query2);	//query-2 maintaining count
		if(!$result)
			die("Error!");
		$count=mysqli_num_rows($result);

		$start=0;
		if($count>=$perpage)
			$end=$perpage-1;
		else
			$end=$count;
			
		$ending=$count;
			
		echo "<br/><br/>";
		if(isset($_GET['column']) && isset($_GET['data'])){
				echo "<a id='pageno' href='process1.php?start=0&end=99&sort=".$sort."
				&column=".htmlentities($_GET['column'])."&data=".htmlentities($_GET['data'])."&month=".$month.".'>&lt; &lt; &nbsp; &nbsp;</a>";
			}
			else{
				echo "<a id='pageno' href='process1.php?start=0&end=99&sort=".$sort."&month=".$month."'>&lt; &lt; &nbsp; &nbsp;</a>";
			}
		$tst=0;
		$tend=99;
		//echo $tst." ".$tend;
		if(isset($_GET['start']) && isset($_GET['end'])){
			$tst=$_GET['start'];
			$tend=$_GET['start']-1;
		}
		$tst=$tst-$perpage;
		if($tst>=0){
			if(isset($_GET['column']) && isset($_GET['data'])){
				echo "<a id='pageno' href='process1.php?start=".$tst."&end=".$tend."&sort=".$sort."
				&column=".htmlentities($_GET['column'])."&data=".htmlentities($_GET['data'])."&month=".$month.".'>&lt; &nbsp &nbsp</a>";
			}
			else{
				echo "<a id='pageno' href='process1.php?start=".$tst."&end=".$tend."&sort=".$sort."&month=".$month."'>&lt;"."&nbsp &nbsp</a>";
			}	
		}
		
		
		$pages=1;
		while($count>0){
			if($count>$perpage){
				if(isset($_GET['column']) && isset($_GET['data'])){
					echo "<a id='pageno' href='process1.php?start=".$start."&end=".$end."&sort=".$sort."
					&column=".htmlentities($_GET['column'])."&data=".htmlentities($_GET['data'])."&month=".$month.".'>".$pages."&nbsp &nbsp</a>";
				}
				else{
					echo "<a id='pageno' href='process1.php?start=".$start."&end=".$end."&sort=".$sort."&month=".$month."'>".$pages."&nbsp &nbsp</a>";
				}
				$start=$start+$perpage;
				$end=$end+$perpage;
				$count=$count-$perpage;
				$pages++;
			}
			else{
				$end=$start+$count;
				if(isset($_GET['column']) && isset($_GET['data'])){
					echo "<a id='pageno' href='process1.php?start=".$start."&end=".$end."&sort=".$sort."
					&column=".htmlentities($_GET['column'])."&data=".htmlentities($_GET['data'])."&month=".$month."'>".$pages."&nbsp &nbsp</a>";
				}
				else{
					echo "<a id='pageno' href='process1.php?start=".$start."&end=".$end."&sort=".$sort."&month=".$month."'>".$pages."</a>";
				}
				$count=0;
			}
		}
		
		
		$tend=99;
		$tst=100;
		$curr_start=0;
		if(isset($_GET['end']) && isset($_GET['start'])){
			$tend=$_GET['end'];
			$tst=$_GET['end']+1;
			$curr_start=$_GET['start'];
		}
		if($tend+$perpage<$ending)
			$tend=$tend+$perpage;
		else 
			$tend=$ending;
		if($curr_start+$perpage<$ending){
			if(isset($_GET['column']) && isset($_GET['data'])){
				echo "<a id='pageno' href='process1.php?start=".$tst."&end=".$tend."&sort=".$sort."
				&column=".htmlentities($_GET['column'])."&data=".htmlentities($_GET['data'])."&month=".$month.".'>&gt; &nbsp &nbsp</a>";
			}
			else{
				echo "<a id='pageno' href='process1.php?start=".$tst."&end=".$tend."&sort=".$sort."&month=".$month."'>&gt;"."&nbsp &nbsp</a>";
			}
		}
		
		
		
		$starting=$ending-($ending%$perpage);
			if(isset($_GET['column']) && isset($_GET['data'])){
				echo "<a id='pageno' href='process1.php?start=".$starting."&end=".$ending."&sort=".$sort."
				&column=".htmlentities($_GET['column'])."&data=".htmlentities($_GET['data'])."&month=".$month.".'>&gt; &gt; &nbsp; &nbsp;</a>";
			}
			else{
				echo "<a id='pageno' href='process1.php?start=".$starting."&end=".$ending."&sort=".$sort."&month=".$month."'>&gt; &gt; &nbsp; &nbsp;</a>";
			}	
	}

?>