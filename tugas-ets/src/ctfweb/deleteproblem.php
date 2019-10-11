<?php
	include("db.php");

	if(isset($_GET['p_id'])) {
		$p_id=$_GET['p_id'];
		$queryfile = "SELECT * FROM problems WHERE `p_id`=$p_id";
		$resultf = mysqli_query($con,$queryfile);
		$row = mysqli_fetch_assoc($resultf);
		if(!is_null($row['f_id'])){
			$f_id = $row['f_id'];
			$querydelfile = "DELETE FROM `files` WHERE `f_id`='$f_id'";
			if (!mysqli_query($con,$querydelfile)){
			  	echo("Error description: " . mysqli_error($con));
			  	die('Error, query failed');
			}
		}
		$query = "DELETE FROM `problems` WHERE `p_id`=$p_id";
		if (!mysqli_query($con,$query)){
			  echo("Error description: " . mysqli_error($con));
			  die('Error, query failed');
		}
	}

	if(isset($_GET['f_id'])){
		$f_id=$_GET['f_id'];
		$queryfile = "SELECT * FROM problems WHERE `f_id`='$f_id'";
		$resultf = mysqli_query($con,$queryfile);
		$row = mysqli_fetch_assoc($resultf);
		$p_id = $row['p_id'];
		if(!is_null($row['f_id'])){
			$f_id = $row['f_id'];
			$querydelfile = "DELETE FROM `files` WHERE `f_id`='$f_id'";
			$queryeditindex = "UPDATE `problems` SET `f_id`=NULL WHERE `f_id`='$f_id'";
			if (!mysqli_query($con,$queryeditindex)){
			  	echo("Error description: " . mysqli_error($con));
			  	die('Error, query failed');
			}
			if (!mysqli_query($con,$querydelfile)){
			  	echo("Error description: " . mysqli_error($con));
			  	die('Error, query failed');
			}
		}
		else echo "No file attached";
		header("Location: editproblem.php?p_id=$p_id");
		die();
	}
		

	header("Location: profile.php");
	die();


?>