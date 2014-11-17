<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="gstyle.css">
  <title> GAME PAGE</title>
</head>
<body>
<center><div class = "banner"><h1 class = "title">GAME PAGE</h1></div></center>
		<center><ul id="navbar">
		    <li><a href = "home.php">HOME</a></li>
		</ul></center>
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
        if(array_key_exists('loggedIn', $_SESSION))
        {
            if($_SESSION['loggedIn'] == 1)
            {
                $userName = $_SESSION['user'];
                $gameId = $direct;
                $query2 = "Insert Into GamesPlayed(userName,gameId) Values ('$userName','$gameId');";
                $result2 = $database->query($query2);
            }
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
					echo "<center><div class = \"hback\"><h1 class = \"title\">$gameId</h1></div>";
					echo '<iframe class="game" src = "'.$fileName.'">';
					//echo '</div>';
					echo '<br><br>';
				}
				echo "<br/></center>";
			} 
?>

</body>
</html>

