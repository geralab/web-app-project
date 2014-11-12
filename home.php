echo '<!DOCTYPE html>';
echo '<html>';
	echo '<head>';
		echo '<title> BLAPPO\'S  </title>';
		echo '<link rel="stylesheet" type="text/css" href="gstyle.css">';
	echo '</head>';
	echo '<body>';
		echo '<div><h1 class = "title"> BLAPPO\'s </h1>';
		echo '<div class = "right"><div class = "search"><form class = "login" id="searchForm" name="search" action="home.php" method="POST">';
		echo '<input type="textfield" name="search">';
		echo '<input class = "button" type="submit" value="SEARCH">';
		echo '</form></div><br></div></div>';
		echo '<ul id="navbar">';
			echo '<li><a href = "profile.php">PROFILE</a></li>';
			echo '<li><a href = "statistics.php">GLOBAL STATISTICS</a></li>';
			echo '<li><a href = "trailers.php">TRAILERS</a></li>';
			echo '<li><a href = "downloads.php">DOWNLOADS</a></li>';
			echo '<li><a href = "register.php">REGISTER</a></li>';
			echo '<li><a href = "login.php">LOGIN</a><li>';
		echo '</ul><br><br><br>';
		echo '<div class = "normal"></div>';
			echo '<br><br><div><p class = "gold"> BLAPPO\'S HOME</p></div>';
		
			session_start();
			if($_SESSION['loggedIn'] == 1)
			{
				echo '<pre><h1 class = "title">WELCOME '. $_SESSION['user'].'</pre></h1>';
			}
	
			$fileText = file_get_contents('/home/geralab/pass.txt', FILE_USE_INCLUDE_PATH);
			$dbPassword = trim($fileText);
			$dbUser = 'geralab';
			$dbName = $dbUser; 
			$database = new mysqli("cs.okstate.edu", $dbUser, $dbPassword, $dbName);
			if (!array_key_exists('search', $_POST))
			{
				$query = "Select * From Game;";
				$result = $database->query($query);
		
				if (!is_object($result))
				{

				}
				else 
				{
					$row = $result->fetch_array(MYSQLI_ASSOC);
					if ($row) 
					{
						echo '<div>';
						while ($row)
						{
							$gameId = $row['gameId'];
							$pic = $row['pic'];
							$description = $row['description'];
							$likes = $row['likes'];
							echo '<center><div class = "box">';
							echo '<h3 class = "w">'.$gameId.'</h3>';
							echo '<a href = "direct.php?direct='.$gameId.'"><img class ="display" src = "'.$pic.'"></a>';
							echo "<div class = \"descript\"><span><p class = \"center\">$description
							NUMBER OF LIKES: $likes</p></span><br><input class = \"button\"  name = \"like\" value=\"LIKE\"></div>";
							echo "</div></center><br/>";
							$row = $result->fetch_array(MYSQLI_ASSOC);
						}
						echo '</div>';
					}
					echo "<br/>";
				} 
			}
			else
			{
				echo '<h1 class = "title"> SEARCH RESULTS </h1>';
				$search = $_POST['search'];
				$query = "Select * From Game Where gameId Like '$search%';";
				$result = $database->query($query);
		
				if (!is_object($result))
				{

				}
				else 
				{
					$row = $result->fetch_array(MYSQLI_ASSOC);
					if ($row) 
					{
						echo '<div>';
						while ($row)
						{
							$gameId = $row['gameId'];
							$pic = $row['pic'];
							$description = $row['description'];
							$likes = $row['likes'];
							echo '<center><div class = "box">';
							echo '<h3 class = "w">'.$gameId.'</h3>';
							echo '<a href = "direct.php?direct='.$gameId.'"><img class ="display" src = "'.$pic.'"></a>';
							echo "<div class = \"descript\"><span><p class = \"center\">$description
							NUMBER OF LIKES: $likes</p></span><br><input class = \"button\"  name = \"like\" value=\"LIKE\"></div>";
							echo "</div></center><br/>";
							$row = $result->fetch_array(MYSQLI_ASSOC);
						}
						echo '</div>';
					}
					echo "<br/>";
				} 
			}
				
		
		?>
		<script>
		
				function like(ascertain)
				{
					var httpRequest = new XMLHttpRequest();
					var url = "ascertain.php?ascertain=" + ascertain;
					httpRequest.open("GET", url, false);
					httpRequest.send(null);
				}
			
		</script>
	</body>
</html>
