<!DOCTYPE html>
<html>
	<head>
		<title> BLAPPO'S  </title>
		<link rel="stylesheet" type="text/css" href="gstyle.css">
	</head>
	<body>
		<center><div class = "banner"><h1 class = "title">TRAILERS</h1></div></center>
		<center><ul id="navbar">
			<li><a href = "home.php">HOME</a></li>
			<li><a href = "profile.php">PROFILE</a></li>
			<li><a href = "statistics.php">GLOBAL STATISTICS</a></li>
			<li><a href = "downloads.php">DOWNLOADS</a></li>
			<li><a href = "register.php">REGISTER</a></li>
			<li><a href = "login.php">LOGIN</a><li>
		</ul></center>
		<div class = "normal"></div>
			<center><div class = "hback"><h1 class = "title"> TRAILERS</h1></div></center>
		<?php
			$fileText = file_get_contents('/home/geralab/pass.txt', FILE_USE_INCLUDE_PATH);
			$dbPassword = trim($fileText);
			$dbUser = 'geralab';
			$dbName = $dbUser; 
			$database = new mysqli("cs.okstate.edu", $dbUser, $dbPassword, $dbName);
			$query = "Select * From Trailer;";
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
					    $link = $row['link'];
						echo '<center><iframe width="560" height="315" src="'.$link.'" frameborder="0" allowfullscreen></iframe></center>';
						echo '<br>';
						$row = $result->fetch_array(MYSQLI_ASSOC);
					}
				}
				echo "<br/>";
			} 
			
				
		
		?>
	</body>
</html>
