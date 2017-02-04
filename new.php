<?php
	include("header.php");
?>
<html>
<head>
<script type="text/javascript">
function update(str){
    var myDiv = document.getElementById("myDiv");
    myDiv.innerHTML="";

	alert("Hello");
  if(str=="Journal" || str=="Issn"){
    var i = document.createElement("input");
    i.setAttribute('type', 'text');
    i.setAttribute('name', 'key_word');
    myDiv.appendChild(i);
  }
  else if(str=="Publisher" || str=="School" || str=="Subject" || str=="Mode"){
    <?php
        // $conn=mysqli_connect("localhost","root","","journals_data");
        include('connection.php');
        $conn = $connection;
        $query1="select distinct `pname` from `publisher`";
        $query2="select distinct `school` from `journal`";
        $query3="select distinct `subject` from `journal`";
        $query4="select distinct `mode` from `journal`";
        $result1 = mysqli_query($conn,$query1);
        $result2 = mysqli_query($conn,$query2);
        $result3 = mysqli_query($conn,$query3);
        $result4 = mysqli_query($conn,$query4);
        
        $vals = "";
        while ($row = mysqli_fetch_row($result1)) {
          $vals = $vals."\"".$row[0]."\",";
        }
        echo "var array1 = [".$vals."];";

        $vals = "";
        while ($row = mysqli_fetch_row($result2)) {
          $vals = $vals."\"".$row[0]."\",";
        }
        echo "var array2 = [".$vals."];";
        
        $vals = "";
        while ($row = mysqli_fetch_row($result3)) {
          $vals = $vals."\"".$row[0]."\",";
        }
        echo "var array3 = [".$vals."];";

        $vals = "";
        while ($row = mysqli_fetch_row($result4)) {
          $vals = $vals."\"".$row[0]."\",";
        }
        echo "var array4 = [".$vals."];";

    ?>
    
    //Create and append select list
    var selectList = document.createElement("select");
    selectList.name = "mySelect";

    myDiv.appendChild(selectList);

    //Create and append the options

if(str == "Publisher"){
    for (var i = 0; i < array1.length; i++) {
        var option = document.createElement("option");
        option.value = array1[i];
        option.text = array1[i];
        selectList.appendChild(option);
    }
}
else if(str == "School"){
    for (var i = 0; i < array2.length; i++) {
        var option = document.createElement("option");
        option.value = array2[i];
        option.text = array2[i];
        selectList.appendChild(option);
    }
}
else if(str == "Subject"){
    for (var i = 0; i < array3.length; i++) {
        var option = document.createElement("option");
        option.value = array3[i];
        option.text = array3[i];
        selectList.appendChild(option);
    }
}
else if(str == "Mode"){
    for (var i = 0; i < array4.length; i++) {
        var option = document.createElement("option");
        option.value = array4[i];
        option.text = array4[i];
        selectList.appendChild(option);
    }
}


  }

  var submit = document.createElement("input");
  submit.setAttribute("type","submit");
  myDiv.appendChild(submit);
}
</script>
</head>
<body>

<div>
  <form id="form" name="form" action="new.php" method="get">
     <input type="text" id="year" placeholder="Year" name="year"/>
    <select name="srch" id="column" value="Journal" onchange='if(this.value != 0) { update(this.options[this.selectedIndex].value); }'>
      <option value="0">-SELECT-</option>
      <option value="Publisher">publisher</option>
      <option value="Journal">journal</option>
      <option value="Issn">issn</option>
      <option value="Subject">subject</option>
      <option value="School">school</option>
      <option value="Mode">mode</option>
    </select>
    <div id="myDiv"></div>
  </form>
</div>

</body>
</html>