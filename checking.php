<style>
#column{
	width:10%;	
}
#year{
	width:6%;
	text-align:center;
	height:3%;
	border-radius:2px;	
	font-size:14px;
}
#inp{
	width:15%;	
}
.sel{
	font-size: 15px;
	height: 30px;
}
#form{
	margin-top: 50px;
}
</style>
<script>
function update(str){
	var myDiv = document.getElementById("myDiv");
    myDiv.innerHTML="";
  	if(str=="jname" || str=="issn"){
		var i = document.createElement("input");
		i.setAttribute('type', 'text');
		i.setAttribute('name', 'data');
		i.setAttribute('id','inp');
		myDiv.appendChild(i);
	}
	else if(str=="publisher" || str=="subject" || str=="school" || str=="mode_type"){	
		if (window.XMLHttpRequest) {
    		xmlhttp=new XMLHttpRequest();
		}else{
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function() {
			if(xmlhttp.readyState==4 && xmlhttp.status==200) {
				document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
				var submit = document.createElement("input");
  				submit.setAttribute("type","submit");
  				myDiv.appendChild(submit);
			}
		}
		xmlhttp.open("GET","getuser.php?q="+str,true);
		xmlhttp.send();
	}
	var submit = document.createElement("input");
  	submit.setAttribute("type","submit");
  	myDiv.appendChild(submit);
}
</script>
<?php
	// $year=date("Y");
	if(isset($_GET['year'])){
	    $year=$_GET['year'];
	}
	else{
	    $qq = "select max(year_data) from year";
	    $rr1 = mysqli_query($connection,$qq);
	    $tt = mysqli_fetch_row($rr1);
	    $year=$tt[0];
	}
?>
<body>
	<center>
    <div>
      <form id="form" name="form" action="process1.php" method="get">
		<?php 
			echo "<select class='sel' style='font-size: 15px;height: 30px;' name='year' id='year'>";
			// $connection=mysqli_connect("localhost","root","","journals_data");
			include('connection.php');
			$query="select year_data from year";
			$result=mysqli_query($connection,$query);
			if(!$result)
				die("Error!");
			$count=mysqli_num_rows($result);
			while($row=mysqli_fetch_row($result)){
				if($row[0]!=$GLOBALS['year'])
			        echo "<option value='".$row[0]."'>".$row[0]."</option>";
			    else
			        echo "<option value='".$row[0]."' selected>".$row[0]."</option>";
			}
			echo "</select>";
		?>
        <select name="column" class='sel' id="column" value="Journal" onchange='if(this.value != 0) { update(this.options[this.selectedIndex].value); }'>
          <option value="0">-SELECT-</option>
          <option value="publisher">Publisher</option>
          <option value="jname">Journal</option>
          <option value="issn">Issn</option>
          <option value="subject">Subject</option>
          <option value="school">School</option>
          <option value="mode_type">Mode</option>
        </select>
        <div id="myDiv"></div>
      </form>
    </div>
	</center>
</body>