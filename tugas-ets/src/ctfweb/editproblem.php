
<?php
	$pageTitle = "Edit Problem";
	//include auth.php file on all secure pages
	include("auth.php");
	include("db.php");
	include("submitproblem.php");
?>
<?php include 'part/header.php'; ?>
<?php include 'part/navbar.php'; ?>
<?php
	if(isset($_GET['p_id'])) { // if f_id is set then get the file with the f_id from database
		editProblem($con);
		$p_id = $_GET['p_id'];
		$query = "SELECT * FROM problems WHERE `p_id`=$p_id";
		$result = mysqli_query($con,$query) or die('Error, query failed');
		$row = mysqli_fetch_assoc($result);
		$file = $row['f_id'];
		$uname = $row['username'];
		$c_date = date("Y-m-d H:i:s");
?>
	<div id='editmaker'><div id='pmaker'><form method='POST' action='' enctype='multipart/form-data'>
		<h2>Edit A Problem</h2>
		<input type='hidden' name='p_id' value="<?php echo $p_id; ?>">
		<input type='hidden' name='f_id' value="<?php echo $file; ?>">
		<p>Problem Name</p> 
			<input type='text' name='pname' style='margin-left: 112px; width:350px;' value='<?php echo $row['pname']; ?>' required><br>
		<p>Problem Category</p>
			<input type='text' name='category' style='margin-left: 90px; width:350px;' value='<?php echo $row['pcategory']; ?>' required><br>
		<p>Problem Flag</p>
			<input type='text' name='flag' style='margin-left: 125px; width:350px;' value='<?php echo $row['flag']; ?>' required><br>
		<p>Score</p>
			<input type='text' name='score' style='margin-left: 178px; width:350px;' value='<?php echo $row['score'];  ?>' required pattern="[0-9]+"><br>
		<p>Description</p><br>
			<textarea name='desc'>"<?php echo $row['description'];?>"</textarea><br>
			File (optional) Max : 1MB <input type='file' name='userfile'>
		<?php 
			if(!is_null($file)){
			echo "<a href='deleteproblem.php?f_id=".$row['f_id']."';>Delete Attachment&nbsp</a>";
			}}
		?>
	<br><br>
		<button type='submit' name='esubmit' class='button'>
			Submit
		</button>
	</form>
	</div>
</div>
<?php include 'part/footer.php'; ?>

