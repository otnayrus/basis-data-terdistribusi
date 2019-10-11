<nav role='navigation'>
  <ul>
  	<li><a href="profile.php"><?php echo $_SESSION['username']; ?></a></li>
    <li ><a href="index.php">Problems</a>
      <ul>
        <li id="jump"><a href="index.php">List Problems</a></li>
        <li id="makeproblem"><a href="myproblem.php">My Problems</a></li>
				<li id="createproblem"><a href="createproblem.php">Create Problem</a></li>
      </ul>
    </li>
    <li><a href="scoreboard.php">Scoreboard</a></li>
    <li><a href="logout.php">Log Out</a></li>
  </ul>
</nav>  
<br style="line-height: 100px;">