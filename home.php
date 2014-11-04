<!DOCTYPE html>
<html>
	<head>
		<title> BLAPPO'S  </title>
		<link rel="stylesheet" type="text/css" href="gstyle.css">
	</head>
	<body>
		<h1 class = "title"> BLAPPO's </h1>
		<ul id="navbar">
			<li><a href = "profile">PROFILE</a></li>
			<li><a href = "statistics">GLOBAL STATISTICS</a></li>
			<li><a href = "trailers.php">TRAILERS</a></li>
			<li><a href = "downloads">DOWNLOADS</a></li>
			<li><a href = "register">REGISTER</a></li>
			<li><a href = "login.php">LOGIN</a><li>
		</ul>
		<div class = "normal"></div>
			<div><p class = "gold"> BLAPPO'S HOME</p></div>
		<?php
			$fileText = file_get_contents('/home/geralab/pass.txt', FILE_USE_INCLUDE_PATH);
			$dbPassword = trim($fileText);
			$dbUser = 'geralab';
			$dbName = $dbUser; 
			$database = new mysqli("cs.okstate.edu", $dbUser, $dbPassword, $dbName);
			$query = "Select * From Game;";
			if (mysqli_connect_errno()) 
			{
				printf("Connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			$result = $database->query($query);
	
			if (!is_object($result))
			{

			}
			else 
			{
				$row = $result->fetch_array(MYSQLI_ASSOC);
				if ($row) 
				{
					while ($row)
					{
					    $gameId = $row['gameId'];
						$pic = $row['pic'];
						$description = $row['description'];
						$likes = $row['likes'];
						echo '<div>';
						echo "<div class = \"descript\"><p>$description<br> NUMBER OF LIKES: $likes</p></div>";
						echo '<a href = "direct.php?direct='.$gameId.'"><img src = "'.$pic.'"></a>';
						echo "</div><br/>";
						$row = $result->fetch_array(MYSQLI_ASSOC);
					}
				}
				echo "<br/>";
			} 
			
				
		
		?>
	</body>
</html>
