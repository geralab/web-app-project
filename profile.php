<?php
echo '<!DOCTYPE html>';
echo '<html>';

		require 'menu.php';
	
	echo '<body>';
	    session_start();
	    if($_SESSION['loggedIn'] != 1)
		{
			header('Location:login.php');
		}
		echo '<center><div class = "hback"><h1 class = "title">'.$_SESSION['user'].'\'s PROFILE PAGE</h1></div></center>';
		echo '<div class = "normal"></div>';
			
			
			$fileText = file_get_contents('/home/geralab/pass.txt', FILE_USE_INCLUDE_PATH);
			$dbPassword = trim($fileText);
			$dbUser = 'geralab';
			$dbName = $dbUser; 
			$database = new mysqli("cs.okstate.edu", $dbUser, $dbPassword, $dbName);
			$userName = $_SESSION['user'];
			$query = "Select gameId As GAMESPLAYED From GamesPlayed Where userName = '$userName';";
			
			if (mysqli_connect_errno()) 
			{
				printf("Connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			printTable($query,$database);
			
		function printTable($query,$database)
		{
			$result = $database->query($query);
			echo "<center><div>\n";
			if (!is_object($result))
			{
			
			}
			else 
			{
				// MAKE HTML TABLE
				echo '<table border="0" cellPadding="1">', "\n";
				$row = $result->fetch_array(MYSQLI_ASSOC);
				if ($row) 
				{
					$keys = array_keys($row);
					echo '<tr>';
					foreach ($keys as $key)
					{
						echo "<th>$key</th>";
					}
					echo '</tr>';
					while ($row)
					{
						echo '<tr>';
						foreach ($row as $cell) 
						{
							echo '<td><a href = "direct.php?direct='.$cell . '">'.$cell.'</a></td>';
						}
						echo '</tr>';
						$row = $result->fetch_array(MYSQLI_ASSOC);
					}
				}
				echo "</table>\n";
				echo "</div></center>";
			} 
		 }		
		?>
	</body>
</html>
