<?php
	$pageTitle = "Dashboard";
	//include auth.php file on all secure pages
	include("auth.php");
	include("db.php");
	include("submitproblem.php");
?>

<?php include 'part/header.php'; ?>
<?php include 'part/navbar.php'; ?>
<h2 id='p1'>List Problems</h2>
<div class='container-p'>
	<?php getProblems($con); ?>	
</div>
<br>
<script type="text/javascript">

	$(document).ready(function(){
	    $(".ptitle").click(function(){
	        $(this).next().slideToggle("slow");
	    });
	});

	$("#jump").click(function() {
    $('html, body').animate({
        scrollTop: $("#p1").offset().top -200
    }, 1000);
});
</script>
<?php include 'part/footer.php'; ?>