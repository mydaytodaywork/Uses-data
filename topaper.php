<?php

include('connection.php');
if(isset($_POST['sel_pub']) && isset($_POST['sel_sch']) && isset($_POST['sel_sub']) && isset($_POST['sel_mode']) && isset($_POST['tdown']) && isset($_POST['sel_rec']) && isset($_POST['sel_year'])){

$head = array(array("Publisher","Journal","ISSN","URL","Subject","School","Recommended By","Mode of Access",
	"Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sept","Oct","Nov","Dec","Total Downloads"));

	$sel_pub = $_POST['sel_pub'];
	$sel_sch = $_POST['sel_sch'];
	$sel_sub = $_POST['sel_sub'];
	$sel_rec = $_POST['sel_rec'];
	$sel_mode = $_POST['sel_mode'];
	$sel_year = $_POST['sel_year'];
	$tdown = $_POST['tdown'];

	if($sel_year!=''){
		$mainQuery="select p.pname,j.jname,j.issn,j.url,j.subject,j.school,j.recby,j.mode_type,
		d.jan,d.feb,d.march,d.april,d.may,d.june,d.july,d.aug,d.sept,d.oct,d.nov,d.december,d.total_downloads
		 from publisher p,journal j,data".$sel_year." d where p.pid=j.pid and j.issn=d.issn";

		 if($sel_pub!=''){
		 	$mainQuery .= " and p.pname='".$sel_pub."'";
		 }
		 if($sel_sch!=''){
		 	$mainQuery .= " and j.school='".$sel_sch."'";
		 }
		 if($sel_sub!=''){
		 	$mainQuery .= " and j.subject='".$sel_sub."'";
		 }
		 if($sel_rec!=''){
		 	$mainQuery .= " and j.recby like '%".$sel_rec."%'";
		 }
		 if($sel_mode!=''){
		 	$mainQuery .= " and j.mode_type ='".$sel_mode."'";
		 }
		 if($tdown!=''){
		 	$mainQuery .= " and d.total_downloads".$tdown;
		 }
		 
		$result = mysqli_query($connection,$mainQuery);
		include('download.php');
	}
	else{

		$all_years = "select year_data from year";
		$result = mysqli_query($connection,$all_years);
		$sel_jan="";
		$sel_feb="";
		$sel_march="";
		$sel_april="";
		$sel_may="";
		$sel_june="";
		$sel_july="";
		$sel_aug="";
		$sel_sept="";
		$sel_oct="";
		$sel_nov="";
		$sel_dec="";
		$sel_tot="";
		$datayear="";
		$yearcond="";
		while($row = mysqli_fetch_row($result)){
			$sel_jan .= "+data".$row[0].".jan";
			$sel_feb .= "+data".$row[0].".feb";
			$sel_march .= "+data".$row[0].".march";
			$sel_april .= "+data".$row[0].".april";
			$sel_may .= "+data".$row[0].".may";
			$sel_june .= "+data".$row[0].".june";
			$sel_july .= "+data".$row[0].".july";
			$sel_aug .= "+data".$row[0].".aug";
			$sel_sept .= "+data".$row[0].".sept";
			$sel_oct .= "+data".$row[0].".oct";
			$sel_nov .= "+data".$row[0].".nov";
			$sel_dec .= "+data".$row[0].".december";
			$sel_tot .= "+data".$row[0].".total_downloads";
			$datayear.= ",data".$row[0];
			$yearcond .= " and j.issn=data".$row[0].".issn";
		}

		$result = mysqli_query($connection,$all_years);

		// while($row = mysqli_fetch_row($result)){
			$sel_year = "all_";
			$mainQuery="select p.pname,j.jname,j.issn,j.url,j.subject,j.school,j.recby,j.mode_type,
			(".substr($sel_jan,1)."),(".substr($sel_feb,1)."),(".substr($sel_march,1)."),(".substr($sel_april,1)."),(".substr($sel_may,1)."),(".substr($sel_june,1)."),(".substr($sel_july,1)."),
			(".substr($sel_aug,1)."),(".substr($sel_sept,1)."),(".substr($sel_oct,1)."),(".substr($sel_nov,1)."),(".substr($sel_dec,1)."),(".substr($sel_tot,1).")
			 from publisher p,journal j".$datayear." where p.pid=j.pid".$yearcond;

			 if($sel_pub!=''){
			 	$mainQuery .= " and p.pname='".$sel_pub."'";
			 }
			 if($sel_sch!=''){
			 	$mainQuery .= " and j.school='".$sel_sch."'";
			 }
			 if($sel_sub!=''){
			 	$mainQuery .= " and j.subject='".$sel_sub."'";
			 }
			 if($sel_rec!=''){
			 	$mainQuery .= " and j.recby like '%".$sel_rec."%'";
			 }
			 if($sel_mode!=''){
			 	$mainQuery .= " and j.mode_type ='".$sel_mode."'";
			 }
			 if($tdown!=''){
			 	$mainQuery .= " and (".$sel_tot.")".$tdown;
			 }

			$mainQuery .= " group by j.issn";

			// echo $mainQuery;

			$result = mysqli_query($connection,$mainQuery);
			include('download.php');

		// }



	}


}


?>

<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>	

<script>

// var search = document.querySelector('#search');
// var results = document.querySelector('#searchresults');
// var templateContent = document.querySelector('#resultstemplate').content;
// search.addEventListener('keyup', function handler(event) {
//     while (results.children.length) results.removeChild(results.firstChild);
//     var inputVal = new RegExp(search.value.trim(), 'i');
//     var clonedOptions = templateContent.cloneNode(true);
//     var set = Array.prototype.reduce.call(clonedOptions.children, function searchFilter(frag, el) {
//         if (inputVal.test(el.textContent) && frag.children.length < 5) frag.appendChild(el);
//         return frag;
//     }, document.createDocumentFragment());
//     results.appendChild(set);
// });


</script>
<style>
/*.box{
	width: 40%;
	height: 20%;
	background-color: teal;
	border: 
}
.box .submit{
	width: 100%;
	height: 20%;
}
.box .data{
	width: 100%;
	height: 80%;
}
*/
.head{
	width: 100%;
	height: 20%;
	background-color: teal;
}
.super{
	margin-top: 70px;
	width: 40%;
	height: 30%;
	border-radius: 5px;
	padding: 20px;
	background-color: orange;
	display: table;
}
/*.super td{
	height: 30px;
}*/
.super form{
	vertical-align:middle;
	display: table-cell;
}
.super select{
	width: 100%;
	height: 100%;
}
.form-control{
	margin: 5px;
}
.super .submit{
	margin-top: 10px;
	margin-bottom: 0px;
}



</style>
<body>


<!-- 
<center>
<div class='box'>
<form>
	<textarea name="query" placeholder='Conditions' class='data' cols="40" rows="5"></textarea><br>
	<input type='submit' class='submit'/>
</form>
</div>
</center>
 -->

<?php



session_start();
if(isset($_SESSION['user'])){
    include('header.php');
    include("navbar.php");
	if($_SESSION['utype']==1)
		adminnav();
	else if($_SESSION['utype']==0){
		usernav();
    }
}
else{
	die("ERROR...");
}



//option string of all publishers, schools and subjects

$query_year = "select year_data from year";
$r_year = mysqli_query($connection, $query_year);
$sel_year = "<datalist id='years'>";
while($row = mysqli_fetch_row($r_year)){
	$sel_year .= "<option value='".$row[0]."'>";
}
$sel_year.= "</datalist>";
$sel_year.= "<input type='text' name='sel_year' class=\"form-control\" list='years' placeholder='All'/>";


$query_pub = "select pname from publisher";
$r_pub = mysqli_query($connection, $query_pub);
$sel_pub = "<datalist id='publishers'>";
while($row = mysqli_fetch_row($r_pub)){
	$sel_pub .= "<option value='".$row[0]."'>";
}
$sel_pub.= "</datalist>";
$sel_pub.= "<input type='text' name='sel_pub' class=\"form-control\" list='publishers' placeholder='All'/>";

$query_sch = "select distinct school from journal";
$r_sch = mysqli_query($connection, $query_sch);
$sel_sch = "<datalist id='schools'>";
while($row = mysqli_fetch_row($r_sch)){
	$sel_sch .= "<option value='".$row[0]."'></option>";
}
$sel_sch.= "</datalist>";
$sel_sch.="<input type='text'  name='sel_sch' class=\"form-control\" list='schools' placeholder='All'>";


$query_sub = "select distinct subject from journal";
$r_sub = mysqli_query($connection, $query_sub);
$sel_sub = "<datalist id='subjects'>";
while($row = mysqli_fetch_row($r_sub)){
	$sel_sub .= "<option value='".$row[0]."'></option>";
}
$sel_sub.= "</datalist>";
$sel_sub.="<input type='text'  name='sel_sub' class=\"form-control\" list='subjects' placeholder='All'>";
?>

<center>
<div class='super'>
<form action='topaper.php' method='post'>

<table>
<tbody>
	<tr>
		<td>Downloads</td>
		<td><input type='text' class="form-control" name='tdown' placeholder='eg. <20'></td>
	</tr>
	<tr>
		<td>Year</td>
		<td><?php echo $sel_year;?></td>
	</tr>
	<tr>
		<td>Publisher</td>
		<td><?php echo $sel_pub;?></td>
	</tr>
	<tr>
		<td>School</td>
		<td><?php echo $sel_sch;?></td>
	</tr>
	<tr>
		<td>Subject</td>
		<td><?php echo $sel_sub;?></td>
	</tr>
	<tr>
		<td>Recommended By</td>
		<td><input type="text" name="sel_rec" class="form-control" placeholder="All"></td>
	</tr>
	<tr>
		<td>Mode</td>
		<td><select name='sel_mode' class="form-control"><option value=''>All</option><option value=1>Complementary</option><option value=0>Subscribed</option></select></td>
	</tr>
</tbody>
</table>

<input type='submit' class="form-control submit" value="Download"/>
</form>
</div>
</center>

</body>
</html>



