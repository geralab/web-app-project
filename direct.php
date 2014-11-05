<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="gstyle.css">
  <title> GAME PAGE</title>
</head>
<body>
<h1 class = "title">GAME PAGE</h1>
		<ul id="navbar">
		    <li><a href = "home.php">HOME</a></li>
		</ul>
		<br>
		<br>
<?php
		session_start();
	    $direct = $_GET["direct"];
		$fileText = file_get_contents('/home/geralab/pass.txt', FILE_USE_INCLUDE_PATH);
	    $dbPassword = trim($fileText);
		$dbUser = 'geralab';
		$dbName = $dbUser; 
		$database = new mysqli("cs.okstate.edu", $dbUser, $dbPassword, $dbName);
		
		if (mysqli_connect_errno()) 
		{
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		$query = "Select * From Game Where gameId = '".$direct."';";
	
		$result = $database->query($query);
	
		if($_SESSION['loggedIn'] == 1)
		{
			$userName = $_SESSION['user'];
			$gameId = $direct;
			$query2 = "Insert Into GamesPlayed(userName,gameId) Values ('$userName','$gameId');";
			$result2 = $database->query($query2);
	    }
			if (!is_object($result))
			{

			}
			else 
			{
				$row = $result->fetch_array(MYSQLI_ASSOC);
				if ($row) 
				{
					$gameId = $row['gameId'];
					$fileName = $row['fileName'];
					//echo '<div class = "contain">';
					echo "<center><h1>$gameId</h1>";
					echo '<object classid="game:1" width="1000" height="1000">';
					echo' <param name="movie" value="'.$fileName.'" />';
					echo '<object type="application/x-shockwave-flash" data="'.$fileName.'" width="1000" height="1000">';
					echo '<!--<![endif]-->';
					echo '<p>Alternative content</p>';
					echo '<!--[if !IE]>-->';
					echo '</object>';
					echo '</object></center>';
					//echo '</div>';
					echo '<br><br>';
				}
				echo "<br/>";
			} 
?>
</body>
</html>

