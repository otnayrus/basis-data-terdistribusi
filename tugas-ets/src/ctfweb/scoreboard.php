<?php
	$pageTitle = "Scoreboard";
	//include auth.php file on all secure pages
	include("auth.php");
	require("db.php");
?>

<?php include 'part/header.php'; ?>
<?php include 'part/navbar.php'; ?>

<table style="width: 50%; margin: 0 auto;">
    	<tr>
    		<th style="width: 10%;">Rank</th> <th>Username</th> <th>Score</th>
  		</tr>

<?php
	$query = "SELECT * FROM `users` ORDER BY `u_score` DESC";
	$result = mysqli_query($con,$query);
if( !$result ){
	echo 'SQL Query Failed';
}else{
	$rank = 0;
	$last_score = false;
	$rows = 0;

  while( $row = mysqli_fetch_assoc($result) ){
    $rows++;
    if( $last_score!= $row['u_score'] ){
      $last_score = $row['u_score'];
      $rank = $rows;
    }
    echo "<tr><td style='align:center;'>".$rank."</td><td>".$row['username']."</td><td>".$row['u_score']."</td></tr>";
  }
}

?>
</table>

<br>
<footer class="footer">
</footer>
</body>
</html>