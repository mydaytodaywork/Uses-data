<?php
	include("header.php");
	if((!isset($_POST['year']) || (!isset($_FILES['xsl']))))
		header("location:upload.php?error=please fill all the details");
	
	// $connection=mysqli_connect("localhost","root","","journals_data");
	include('connection.php');
	
	$year=$_POST['year'];
	$query="insert into year values($year)";
	$result=mysqli_query($connection,$query);
	// if(!$result)
	// 		die("Error!1");
	
	
	$year=$_POST['year'];
	$file_name = $_FILES['xsl']['name'];
	$file_size =$_FILES['xsl']['size'];
	$file_tmp =$_FILES['xsl']['tmp_name'];

	move_uploaded_file($file_tmp,"xls/".$file_name);
	
	$query="drop table if exists `data".$year."`";
	$result=mysqli_query($connection,$query);
	if(!$result)
			die("Error!2");
			
	$tablename="data".$_POST['year'];
	$query="CREATE TABLE IF NOT EXISTS `".$tablename."` (
	  `issn` varchar(100) DEFAULT NULL Unique,
	  `jan` int(11) DEFAULT NULL,
	  `feb` int(11) DEFAULT NULL,
	  `march` int(11) DEFAULT NULL,
	  `april` int(11) DEFAULT NULL,
	  `may` int(11) DEFAULT NULL,
	  `june` int(11) DEFAULT NULL,
	  `july` int(11) DEFAULT NULL,
	  `aug` int(11) DEFAULT NULL,
	  `sept` int(11) DEFAULT NULL,
	  `oct` int(11) DEFAULT NULL,
	  `nov` int(11) DEFAULT NULL,
	  `december` int(11) DEFAULT NULL,
	  `total_downloads` int(11) DEFAULT NULL
	  )";
	$create_table=mysqli_query($connection,$query);
	if(!$create_table)
			die("Error!3");

	$tablename1="package".$_POST['year'];
	$query="drop table if exists `".$tablename1."`";
	$result=mysqli_query($connection,$query);
	if(!$result)
			die("Error!4");
			
	$query="CREATE TABLE IF NOT EXISTS `".$tablename1."` (
	  `gid` int(11) Unique,
	  `subprice` int(20),
	  `stotal` int(20),
	  `scpa` int(20),
	  `ctotal` int(20),
	  `ccpa` int(20)
	  )";
	$create_table=mysqli_query($connection,$query);
	if(!$create_table)
			die("Error!5");
			
	include 'excel_reader/excel_reader.php';
	$excel = new PhpExcelReader;
	$excel->read('xls/'.$file_name);
	
	function sheetData($sheet){
		$conn=$GLOBALS['connection'];
		$publisher = 2;
		$journal = 4;
		$issn = 5;
		$url = 6;
		$subject = 7;
		$school = 8;
		$recby=9;
		$subprice=10;
		$mode = 11;
		$jan = 12;
		$feb = 13;
		$march = 14;
		$april = 15;
		$may = 16;
		$june = 17;
		$july = 18;
		$aug = 19;
		$sept = 20;
		$oct = 21;
		$nov = 22;
		$december = 23;
		$total = 24;
		$stotal=25;
		$scpa=26;
		$ctotal=27;
		$ccpa=28;
		$perpetual=29;
		$backfile=30;
		$sheet_publisher='';
			

		$newgid = 1;
		$query = "select max(`gid`) from `journal`";
		$result=mysqli_query($conn,$query);
		// if(!$result)
		// 	die("Error!6");
		$row = mysqli_fetch_row($result);
		if($row[0]!=null){
			$newgid = $row[0];
		}



//max generated issn
	$gen_issn=0;
	$query = "select issn from journal order by issn desc";
	$result=mysqli_query($conn,$query);
	if($result){
		while($row = mysqli_fetch_row($result)){
			//check format of row
			$str = $row[0];
			if($str[0]=='z' && $str[1]=='_'){
				$v=(int)substr($str, 2);
				if($v>$gen_issn){
					$gen_issn = $v;
				}
			}	
		}
	}

//end



// SELECT *
// FROM data2000
// WHERE issn in (NOT EXISTS
//         (SELECT issn
//          FROM journal
//          ))
	// $c1=0;
	// $c2=0;

	  $x = 3;
	  while($x <= $sheet['numRows']) {
		  $sheet_journal=isset($sheet['cells'][$x][$journal])?$sheet['cells'][$x][$journal]:'';
		  $sheet_issn=isset($sheet['cells'][$x][$issn])?$sheet['cells'][$x][$issn]:'';
		  $sheet_url=isset($sheet['cells'][$x][$url])?$sheet['cells'][$x][$url]:'';
		  $sheet_subject=isset($sheet['cells'][$x][$subject])?$sheet['cells'][$x][$subject]:'';
		  $sheet_school=isset($sheet['cells'][$x][$school])?$sheet['cells'][$x][$school]:'';
		  $sheet_recby=isset($sheet['cells'][$x][$recby])?$sheet['cells'][$x][$recby]:'';
		  $sheet_mode=isset($sheet['cells'][$x][$mode])?$sheet['cells'][$x][$mode]:'';
		  $sheet_jan=isset($sheet['cells'][$x][$jan])?$sheet['cells'][$x][$jan]:0;
		  $sheet_feb=isset($sheet['cells'][$x][$feb])?$sheet['cells'][$x][$feb]:0;
		  $sheet_march=isset($sheet['cells'][$x][$march])?$sheet['cells'][$x][$march]:0;
		  $sheet_april=isset($sheet['cells'][$x][$april])?$sheet['cells'][$x][$april]:0;
		  $sheet_may=isset($sheet['cells'][$x][$may])?$sheet['cells'][$x][$may]:0;
		  $sheet_june=isset($sheet['cells'][$x][$june])?$sheet['cells'][$x][$june]:0;
		  $sheet_july=isset($sheet['cells'][$x][$july])?$sheet['cells'][$x][$july]:0;
		  $sheet_aug=isset($sheet['cells'][$x][$aug])?$sheet['cells'][$x][$aug]:0;
		  $sheet_sept=isset($sheet['cells'][$x][$sept])?$sheet['cells'][$x][$sept]:0;
		  $sheet_oct=isset($sheet['cells'][$x][$oct])?$sheet['cells'][$x][$oct]:0;
		  $sheet_nov=isset($sheet['cells'][$x][$nov])?$sheet['cells'][$x][$nov]:0;
		  $sheet_december=isset($sheet['cells'][$x][$december])?$sheet['cells'][$x][$december]:0;
		  $sheet_total=isset($sheet['cells'][$x][$total])?$sheet['cells'][$x][$total]:0;
		  $sheet_subprice=isset($sheet['cells'][$x][$subprice])?$sheet['cells'][$x][$subprice]:-1;
		  $sheet_stotal=isset($sheet['cells'][$x][$stotal])?$sheet['cells'][$x][$stotal]:0;
		  $sheet_scpa=isset($sheet['cells'][$x][$scpa])?$sheet['cells'][$x][$scpa]:0;
		  $sheet_ctotal=isset($sheet['cells'][$x][$ctotal])?$sheet['cells'][$x][$ctotal]:0;
		  $sheet_ccpa=isset($sheet['cells'][$x][$ccpa])?$sheet['cells'][$x][$ccpa]:0;
		  $sheet_perpetual=isset($sheet['cells'][$x][$perpetual])?$sheet['cells'][$x][$perpetual]:'';
		  $sheet_backfile=isset($sheet['cells'][$x][$backfile])?$sheet['cells'][$x][$backfile]:'';

		  if($sheet_subprice=='NA'){$sheet_subprice=0;}
		  if($sheet_stotal=='NA'){$sheet_stotal=0;}
		  if($sheet_scpa=='NA'){$sheet_scpa=0;}
		  if($sheet_ctotal=='NA'){$sheet_ctotal=0;}
		  if($sheet_ccpa=='NA'){$sheet_ccpa=0;}



		  if($sheet_mode=="Subscription")
				$sheet_mode=0;
			else
				$sheet_mode=1;
				
		  if(isset($sheet['cells'][$x][$publisher]))
		  	$GLOBALS['sheet_publisher']=$sheet['cells'][$x][$publisher];

		  if(isset($sheet['cells'][$x][$publisher])){
			  $query="insert into `publisher` (`pname`) values ('".$GLOBALS['sheet_publisher']."')";
			  $result=mysqli_query($conn,$query);
			  // if(!$result)
				// die("Error!7");
			  $query="select `pid` from `publisher` where `pname`='".$GLOBALS['sheet_publisher']."'";
			  $result=mysqli_query($conn,$query);
			  if(!$result)
					die("Error!8");
			  $row=mysqli_fetch_row($result);
			  $pid=$row[0]; 		  	
		  }

//start generate new issn number
// $cc=0;
if($sheet_issn == ''){
	$query = "select pid,issn from journal where jname='".$sheet_journal."'";
	$result = mysqli_query($conn,$query);
	// $nq = mysqli_num_rows($result);
	while($row = mysqli_fetch_row($result)){
		if($row[0]==$pid){
			$sheet_issn = $row[1];
		}
		// else{
		// 	$cc++;
		// }
	}
	if($sheet_issn==''){
		$gen_issn++;
		$sheet_issn = "z_".$gen_issn;
	}
}

//end

		  //if issn exist do nothing

		  	
	  		$query = "select `gid` from `journal` where issn='".$sheet_issn."'";
			$result = mysqli_query($conn,$query);
			// if(!$result)
			// 	die("Error!9");
			$row = mysqli_fetch_row($result);
			if($row && $sheet_subprice!=-1){
				$recgid = $row[0];
			}
			if(!($row)){
			//if issn doesnot exist[done]

				//decide old or new[having subprice] gid
				if($sheet_subprice==-1){
					$finalgid = $recgid;
				}
				else{
					$finalgid=$newgid++;
					$recgid = $finalgid;
				}

				//add
				// $c1++;		  	
				if(isset($sheet['cells'][$x][$journal])){
				// $c2++;
				  $query="INSERT INTO `journal`(`pid`, `jname`, `issn`, `url`, `subject`, `school`,`recby`,`mode_type`,`gid`) VALUES 
					(".$pid.",'".$sheet_journal."','".$sheet_issn."','".$sheet_url."','".$sheet_subject."',
						'".$sheet_school."','".$sheet_recby."',".$sheet_mode.",".$finalgid.")";
				 $result=mysqli_query($conn,$query);
				 // if(!$result)
					// die("Error!10");
				 // if(!$result)
					// echo $query."<br>";
		  		}
		  		// echo $x.":".$c1.":".$c2.":".$sheet_issn."</br>";
			}

/*
		  if(isset($sheet['cells'][$x][$journal])){
			  $query="INSERT INTO `journal`(`pid`, `jname`, `issn`, `url`, `subject`, `school`,`recby`,`mode_type`,`gid`) VALUES 
						(".$pid.",'".$sheet_journal."','".$sheet_issn."','".$sheet_url."','".$sheet_subject."',
							'".$sheet_school."','".$sheet_recby."',".$sheet_mode.",".$newgid.")";
				 $result=mysqli_query($conn,$query);
		  }
		  
*/		  


		  if(isset($sheet['cells'][$x][$journal])){

		  $query="INSERT INTO `".$GLOBALS['tablename']."`(`issn`, `jan`, `feb`, `march`, `april`, `may`, `june`, `july`,
		   `aug`, `sept`, `oct`, `nov`, `december`, `total_downloads`) VALUES 
			('".$sheet_issn."',".$sheet_jan.",".$sheet_feb.",".$sheet_march.",".$sheet_april.",".$sheet_may.",
		  ".$sheet_june.",".$sheet_july.",".$sheet_aug.",".$sheet_sept.",".$sheet_oct.",".$sheet_nov.",
		  ".$sheet_december.",".$sheet_total.")";
			$run=mysqli_query($GLOBALS['connection'],$query);
			// if(!$run)
			// 	die("Error!11");
			
		}

			
			if($sheet_subprice!=-1){
			//define gid [done]
			$query = "select `gid` from `journal` where `issn`='".$sheet_issn."'";
			$run=mysqli_query($GLOBALS['connection'],$query);
			if(!$run)
				die("Error!12");
			$row = mysqli_fetch_row($run);
			$gid = $row[0];			
			$query = "INSERT INTO `".$GLOBALS['tablename1']."`(`gid`, `subprice`, `stotal`, `scpa`, `ctotal`, `ccpa`)
						 VALUES (".$gid.",".$sheet_subprice.",".$sheet_stotal.",".$sheet_scpa.",".$sheet_ctotal.",".$sheet_ccpa.")";			
			$run=mysqli_query($GLOBALS['connection'],$query);
			// if(!$run)
			// 	die("Error!13");
			}
		  


			$query = "select ac_id from journal where issn='".$sheet_issn."'";
			$r = mysqli_query($GLOBALS['connection'],$query);
			
			if($row = mysqli_fetch_row($r)){
				$query = "select ac_id from access where ac_id=".$row[0];
				$r = mysqli_query($GLOBALS['connection'],$query);
				if($row1 = mysqli_fetch_row($r)){
					$query = "UPDATE `access` SET `ac_id`=".$row1[0].",`perpetual`='".$sheet_perpetual."',`backfile`='".$sheet_backfile."'";
					$r = mysqli_query($GLOBALS['connection'],$query);
				}
				else{
					$query = "INSERT INTO `access`(`ac_id`, `perpetual`, `backfile`) 
					VALUES (".$row[0].",'".$sheet_perpetual."','".$sheet_backfile."')";
					$r = mysqli_query($GLOBALS['connection'],$query);
				}
				
			}



			$x++;  

	  	}
	  	
	 }
	sheetData($excel->sheets[0]);              // to store the the html tables with data of each sheet
	
	
	unlink("xls/".$file_name);
	echo "<center><b>Data Updated</b><center>";
?>