<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<title>Example PHP Excel Reader</title>


  <?php
  if(!isset($_GET['year']))
  	$year=date("Y");
	else
		$year=$_GET['year'];
  /*$pie1_array = array
  (
  array("element1",25),
  array("element2",10),
  array("element3",65)
  );
  $pie2_array = array
  (
  array("name1",20),
  array("name2",10),
  array("name3",4)
  );
  include('graph.php');
*/?>

</head>
<body>

<div>
  <form action="<?php echo 'process1.php'?>" method="get">
      <!-- <input type="text" id="column" name="column"/> -->
      <select name="column" id="column">
        <option value="publisher">publisher</option>
        <option value="jname">journal</option>
        <option value="issn">issn</option>
        <option value="url">url</option>
        <option value="subject">subject</option>
        <option value="school">school</option>
        <option value="mode">mode</option>
        <option value="jan">jan</option>
        <option value="feb">feb</option>
        <option value="march">march</option>
        <option value="april">april</option>
        <option value="may">may</option>
        <option value="june">june</option>
        <option value="july">july</option>
        <option value="aug">aug</option>
        <option value="sept">sept</option>
        <option value="oct">oct</option>
        <option value="nov">nov</option>
        <option value="december">december</option>
        <option value="total_downloads">total_downloads</option>
      </select>
      <input type="text" id="data" name="data"/>
      <input type="submit"/>
    </form>
</div>

<div style="display: inline;">
  <div id="pie1" style="width:300px;height:300px">
  </div>
  <div id="pie2" style="width:300px;height:300px">
  </div>
</div>

<div class="container">    
</div>
</body>
</html>
