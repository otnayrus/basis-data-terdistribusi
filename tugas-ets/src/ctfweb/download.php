<?php
	include 'db.php';
	if(isset($_GET['f_id'])) { // if f_id is set then get the file with the f_id from database
		$f_id = $_GET['f_id'];
		$query = "SELECT f_name, f_type, f_size, content FROM files WHERE `f_id` = '$f_id'";
		$result = mysqli_query($con,$query) or die('Error, query failed');
		list($name, $type, $size, $content) =
		mysqli_fetch_array($result);
		header("Content-length: $size");
		header("Content-type: $type");
		header("Content-Disposition: attachment; filename=$name");
		echo $content; 
		exit;
	}
?>

Download File From MySQL

<?php
	$query = "SELECT f_id, f_name FROM files";
	$result = mysqli_query($con,$query) or die('Error, query failed');
	if(mysqli_num_rows($result) == 0)
	{
		echo "Database is empty";
	}
	else {
		while(list($f_id, $name) = mysqli_fetch_array($result))
		{
			echo "<a href='download.php?f_id=".$f_id."';>".$name."</a>";
		}
	}
?>