<?php
if(isset($_GET['srch'])){
	$default=$_GET['srch'];
}
else{
	$default="Publisher";
}
$year=isset($_GET['year'])?$_GET['year']:"";
$keyWord=isset($_GET['keyWord'])?$_GET['keyWord']:"";

// $conn=mysqli_connect("localhost","root","","Journals_data");
include('connection.php');

?>

<html>
<head></head>
<body>

<?php
    $srch="";
	$Publisher="";
	$Journal="";
	$Issn="";
	$Subject="";
	$School="";
	$Mode="";
    if(isset($_GET['srch'])) 
    switch ($_GET['srch']) {
     	case 'Publisher':
     		$Publisher="selected";
     		$srch = "pname";
     		break;
     	case 'Journal':
     		$Journal="selected";
     		$srch = "jname";
     		break;
   		case 'Issn':
     		$Issn="selected";
     		$srch = "issn";
 	  		break;
   		case 'Subject':
     		$Subject="selected";
     		$srch = "subject";
    		break;
   		case 'School':
     		$School="selected";
     		$srch = "school";
     		break;
   		case 'Mode':
     		$Mode="selected";
     		$srch = "mode";
     		break;
     	default:
     		break;
    }


echo'<div>
  <form id="form" name="form" action="search.php" method="get">
  	';
     echo '<input type="text" id="year" placeholder="Year" value="'.$year.'" name="year"/>';

    echo '<select name="srch" id="column" value="Journal" onchange=\'if(this.value != 0) { this.form.submit(); }\'>
      <option value="0">-SELECT-</option>
      <option value="Publisher"'.$Publisher.'>publisher</option>
      <option value="Journal" '.$Journal.'>journal</option>
      <option value="Issn" '.$Issn.'>issn</option>
      <option value="Subject" '.$Subject.'>subject</option>
      <option value="School" '.$School.'>school</option>
      <option value="Mode" '.$Mode.'>mode</option>
    </select>';
   	
// if(isset($_GET['srch']) && isset($_GET['year'])){
   echo "</form><form action=\"search.php?".$_SERVER['QUERY_STRING']."\" method=\"get\">";
// }

    if(isset($_GET['srch'])){
    	if($_GET['srch']=="Journal" || $_GET['srch']=="Issn"){
    		echo "<input type=\"text\" name=\"keyWord\" placeholder='".$_GET['srch']."' value='".$keyWord."' onchange='if(this.value != 0) { this.form.submit();}'/>";
    	}
    	else{

    		if($srch=="pname"){
    			$query="select distinct ".$srch." from `publisher`";
    		}
    		if($srch=="subject" || $srch=="school" || $srch=="mode"){
    			$query="select distinct ".$srch." from `journal`";
    		}

    		$result = mysqli_query($conn,$query);
    		$str = "<select name='sub_srch' onchange='if(this.value != 0) { this.form.submit();}'>
    		<option value=\"0\">All</option>";
    		while ($row = mysqli_fetch_row($result)) {
    			$str = $str.'<option value="'.$row[0].'">'.$row[0].'</option>';
    		}
    		$str=$str."</select>";
    		echo $str;		
    	}
    	
	}
	
    ?>


  </form>
</div>

</body>
</html>