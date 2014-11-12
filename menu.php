<?php
echo '<head><title> Quazzar </title>
<link rel="stylesheet" type="text/css" href="gstyle.css"></head>';
echo '<img src="Quazzar_Banner.png" alt="Quazzar_Banner">
';
echo '<center><ul id="navbar">
<li><a href = "home.php">HOME</a></li>
<li><a href = "profile.php">PROFILE</a></li>
<li><a href = "statistics.php">LEADERBOARDS</a></li>
<li><a href = "trailers.php">TRAILERS</a></li>
<li><a href = "downloads.php">DOWNLOADS</a></li>
<li><a href = "register.php">REGISTER</a></li>
<li><a href = "login.php">LOGIN</a><li>
<li><form class = "search" id="searchForm" name="search" action="home.php" method="POST">
<input type="text" name="search">
<input class = "button" type="submit" value="SEARCH">
</form>
</li></ul></center>';
?>