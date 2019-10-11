
<?php
	$pageTitle = "My Profile";
	//include auth.php file on all secure pages
	include("auth.php");
	include("db.php");
?>

<?php include 'part/header.php'; ?>
<?php include 'part/navbar.php'; ?>
<?php 
	$uname = $_SESSION['username'];
	$queryp = "SELECT * FROM problems WHERE `username`='$uname'";
	$resultp = mysqli_query($con,$queryp);
?>
<h1 style=" font-family: Arial, Helvetica, sans-serif; font-size:3vw; font-weight:bold;"><?php echo $_SESSION['username'];?></h1>

<h2>Submissions</h2>
<?php
	$query = "SELECT * FROM submission WHERE `username`='$uname'";
	$result = mysqli_query($con,$query);
	while($row = mysqli_fetch_assoc($result)){
		if($row['iscorrect']) echo "<div class='answered'>";
		else echo "<div class='problemlist'>";
		echo "<div class='ptitle'><p style='text-align:left;'>";
		if($row['iscorrect']) echo "Answer Submitted Problem No. ".$row['p_id']." with verdict TRUE<br>";
		else echo "Answer Submitted Problem No. ".$row['p_id']." with verdict FALSE<br>"; 
		echo "<span style='float:right;'>";
		echo "</span></p></div></div>";
		
	}
?>
<?php include 'part/footer.php'; ?>