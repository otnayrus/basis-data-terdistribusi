<?php

$once = FALSE;

function setProblem($con){
	$pictured = FALSE;
	if(isset($_POST['psubmit'])){
		$uname = $_SESSION['username'];
		$pname = $_POST['pname'];
		$desc = $_POST['desc'];
		$score = $_POST['score'];
		$flag = $_POST['flag'];
		$c_date = date("Y-m-d H:i:s");
		$pcategory = $_POST['category'];

		
if(isset($_POST['psubmit']) && $_FILES['userfile']['size'] > 0 && $_FILES['userfile']['size'] <1000000)
{
	$fileid = uniqid();
	$fileName = $_FILES['userfile']['name'];
	$tmpName  = $_FILES['userfile']['tmp_name'];
	$fileSize = $_FILES['userfile']['size'];
	$fileType = $_FILES['userfile']['type'];
	$fp      = fopen($tmpName, 'r');
	$content = fread($fp, filesize($tmpName));
	$content = addslashes($content);
	fclose($fp);
	if(!get_magic_quotes_gpc())
	{
		$fileName = addslashes($fileName);
	}
	$query = "INSERT INTO files (f_id, f_name, f_size, f_type, content ) VALUES ('$fileid','$fileName', '$fileSize', '$fileType', '$content')";
	if (!mysqli_query($con,$query)){
		  echo("Error description: " . mysqli_error($con));
		  die('Error, query failed');
	}
	$pictured = TRUE;
}

		$query = "INSERT into `problems` (username, pname, pcategory, flag, score, description, date_created) VALUES ('$uname', '$pname', '$pcategory', '$flag', '$score', '$desc', '$c_date')";
		if($pictured){
			$query = "INSERT into `problems` (username, pname, pcategory, flag, score, description, date_created, f_id) VALUES ('$uname', '$pname', '$pcategory', '$flag', '$score', '$desc', '$c_date', '$fileid')";
		}
        
    if (!mysqli_query($con,$query)){
		  echo("Error description: " . mysqli_error($con));
		}
		else{
			header('Location: '.'/myproblem.php');
		}

	}
}

function getProblems($con){
	$query = "SELECT * FROM problems";
	$result = mysqli_query($con,$query);
	global $once;
	$once = FALSE;
	$hidproblem = TRUE;
	while($row = mysqli_fetch_assoc($result)){
		
		$queryistrue = "SELECT * FROM `submission` WHERE `username`='".$_SESSION['username']."' AND `p_id`='".$row['p_id']."' AND `iscorrect`=TRUE";
		$queryfile = "SELECT f_id, f_name FROM files WHERE f_id='".$row['f_id']."'";
		$results = mysqli_query($con,$queryfile) or die('Error, query failed');
		$xf_id = 0;
		$xname = 0;
		$xresult =mysqli_num_rows($results);
		if(mysqli_num_rows($results) > 0)  {
			while(list($f_id, $name) = mysqli_fetch_array($results))
			{
				$xf_id = $f_id;
				$xname = $name;
			}
		}
		$istrue = mysqli_query($con,$queryistrue);
		if($hidproblem){
			$hidproblem=FALSE;
			echo "<div class='phidden'>";
		}
		else if(mysqli_num_rows($istrue)){
			echo "<div class='answered'>";
			
		}
		else {
			echo "<div class='problemlist'>";
		}
		?> 
			<span class="r-sideproblem">
			<?php if($xresult>0){echo '<img src="assets/file.ico" width="20px">';}?>
			</span>
			<div class='ptitle r-pointer'><p style='text-align:left;'>
			<?php if(mysqli_num_rows($istrue)){
			echo '<img src="assets/cek.png" width="20px">';
		}?>
			 <?php echo $row['p_id']."."; ?>
			 <?php echo $row['pname']; ?>
			 </div>
		 	<div class='panel'> <br>
			 <p><strong>Created By : </strong><br><?php echo $row['username']; ?></p>
			 <p><strong>Category   : </strong><br><?php echo $row['pcategory']; ?></p>
			 <p><strong>Score 	   :</strong><br><?php echo $row['score']; ?></p>
			 <p><strong>Description:</strong><br><?php echo $row['description']; ?></p>
		<?php

		if(mysqli_num_rows($istrue)){
			echo "<br><h3>You Solved The Problem!</h3>";
		}
		else{
			if(mysqli_num_rows($results) > 0)  {
					
					echo "<p><strong>Attachment:</strong><br></p>";
					echo '<img class="cek" src="assets/file.ico" width="20px">';
					echo "<a href='download.php?f_id=".$xf_id."';>".$xname."</a>";
			}
			?>
			<br><br>Your flag<form method='POST' action='<?php echo submitFlag($con); ?>'>
					<input type='text' name='answer' style='margin-left: 100px; width:350px;' placeholder='Flag'><input type='submit' name='fsubmit' value='Submit' />
					<input type='hidden' name='p_id' value='<?php echo $row['p_id']; ?>'>
					<input type='hidden' name='score' value='<?php echo $row['score']; ?>'>
					</form>
				<?php 
		}
		echo "</div></div>";
	}
}

function submitFlag($con){
	global $once;
	if(!$once){ 
	if(isset($_POST['fsubmit'])){
		$uname = $_SESSION['username'];
		$p_id = $_POST['p_id'];
		$flag = $_POST['answer'];
		$s_date = date("Y-m-d H:i:s");
		$score = $_POST['score'];

		$chkquery = "SELECT * FROM `problems` WHERE `p_id`=$p_id AND `flag`='$flag'";
		$querytrue = "INSERT into `submission` (username, p_id, answer, timesubmit, iscorrect) VALUES ('$uname', $p_id, '$flag', '$s_date', TRUE)";
		$queryfalse = "INSERT into `submission` (username, p_id, answer, timesubmit, iscorrect) VALUES ('$uname', $p_id, '$flag', '$s_date', FALSE)";
        
        $result = mysqli_query($con,$chkquery);
		if(mysqli_num_rows($result)){
			if (!mysqli_query($con,$querytrue)){
				echo("Error description: " . mysqli_error($con));
			}
			$queryaddscore = "UPDATE `users` SET `u_score` = `u_score` + $score WHERE `username`='$uname'";
			if (!mysqli_query($con,$queryaddscore)){
				echo("Error description: " . mysqli_error($con));
			}
		}
		else{
			if (!mysqli_query($con,$queryfalse)){
				echo("Error description: " . mysqli_error($con));
			}
		}
		$once = TRUE;		
	}
}
}

function editProblem($con){
	if(isset($_POST['esubmit'])){
		$p_id = $_POST['p_id'];
		$f_id = $_POST['f_id'];
		$uname = $_SESSION['username'];
		$pname = $_POST['pname'];
		$desc = $_POST['desc'];
		$score = $_POST['score'];
		$flag = $_POST['flag'];
		$c_date = date("Y-m-d H:i:s");
		$pcategory = $_POST['category'];

$query = "UPDATE `problems` SET username='$uname', pname='$pname', pcategory='$pcategory', flag='$flag', score='$score', description='$desc', date_created='$c_date' WHERE `p_id`=$p_id";
        
        if (!mysqli_query($con,$query)){
		  echo("Error description: " . mysqli_error($con));
		}


if(isset($_POST['esubmit']) && $_FILES['userfile']['size'] > 0 && $_FILES['userfile']['size'] <1000000)
{
	$fileid = uniqid();
	$fileName = $_FILES['userfile']['name'];
	$tmpName  = $_FILES['userfile']['tmp_name'];
	$fileSize = $_FILES['userfile']['size'];
	$fileType = $_FILES['userfile']['type'];
	$fp      = fopen($tmpName, 'r');
	$content = fread($fp, filesize($tmpName));
	$content = addslashes($content);
	fclose($fp);
	if(!get_magic_quotes_gpc())
	{
		$fileName = addslashes($fileName);
	}
$queryf = "SELECT * FROM `problems` WHERE `p_id`=$p_id";
$fresult = mysqli_query($con,$queryf);
$frow = mysqli_fetch_assoc($fresult);
if(!is_null($frow['f_id'])){
	$queryupdatef = "UPDATE `files` SET f_name='$fileName', f_size='$fileSize', f_type='$fileType', content='$content' WHERE `f_id`='$f_id'";
	if (!mysqli_query($con,$queryupdatef)){
		  echo("Error description: " . mysqli_error($con));
		  die('Error, query failed');
	}
}
else {
	$queryupdatef = "INSERT INTO files (f_id, f_name, f_size, f_type, content ) VALUES ('$fileid','$fileName', '$fileSize', '$fileType', '$content')";
	if (!mysqli_query($con,$queryupdatef)){
		  echo("Error description: " . mysqli_error($con));
		  die('Error, query failed');
	}
	$queryalter = "UPDATE `problems` SET `f_id`='$fileid' WHERE `p_id`=$p_id";
	if (!mysqli_query($con,$queryalter)){
		  echo("Error description: " . mysqli_error($con));
		  die('Error, query failed');
	}
}}
		echo "Problem edited successfully";
	}
}