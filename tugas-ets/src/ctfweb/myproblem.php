<?php
	$pageTitle = "My Problem";
	//include auth.php file on all secure pages
	include("auth.php");
	include("db.php");
	include("submitproblem.php");
	$sort = "DESC";
	$flipSort = "ASC";
	if(isset($_GET['sort'])){
		if($_GET['sort'] == "ASC"){
			$sort = "ASC";
			$flipSort = "DESC";
		}
	}
?>

<?php include 'part/header.php'; ?>
<?php include 'part/navbar.php'; ?>
<h2 id='p1'>My Problems</h2>
<a class="problem_sort" href="?sort=<?php echo $flipSort; ?>">SORT 	<img src="img/arrow.png" class="sort-<?php echo $flipSort; ?>"></a>
<?php
	$uname = $_SESSION['username'];
	$queryp = "SELECT * FROM problems WHERE `username`='$uname' ORDER BY p_id ".$sort;
	$resultp = mysqli_query($con,$queryp);
	while($row = mysqli_fetch_assoc($resultp)){
		?>
		<div class='problemlist'>

		<div class='ptitle'><p style='text-align:left;'>
			No. <?php echo $row['p_id']; ?>
			- <?php echo $row['pname']; ?> <?php
		echo "<span style='float:right;'> Tag : ".$row['pcategory']." - Score : ".$row['score']."<br></span></p></div>";
		?>
		<a href='editproblem.php?p_id=<?php echo $row['p_id']; ?>'>Edit&nbsp</a>|&nbsp
		<a href='deleteproblem.php?p_id=<?php echo $row['p_id']; ?>'>Delete&nbsp</a>
		</div> <?php
	}
?>
<?php include 'part/footer.php'; ?>