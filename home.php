<?php
echo '<!DOCTYPE html>';
echo '<html>';
		require 'menu.php';	
	echo '<body>';
		echo '<div class = "normal"></div>';
			
		
			session_start();
            $userId = '';
            if(array_key_exists('loggedIn', $_SESSION))
            {
                if($_SESSION['loggedIn'] == 1)
                {
                    echo '<center><div class = "hback"><h1 class = "title"> QUAZZAR HOME</h1>';
                    echo '<pre><h1 class = "title">WELCOME '. $_SESSION['user'].'</pre></h1></div></center>';
                }
                else
                {
                    echo '<center><div class = "hback"><h1 class = "title"> QUAZZAR HOME</h1></div></center>';
                }
                $userId = $_SESSION['user'];
            }
	
			$fileText = file_get_contents('/home/geralab/pass.txt', FILE_USE_INCLUDE_PATH);
			$dbPassword = trim($fileText);
			$dbUser = 'geralab';
			$dbName = $dbUser;
            $count = 0;
            $divString="";
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
                            if($count % 2 == 0)
                            {
                                $divString = "boxEven";
                            }
                            else
                            {
                                $divString = "boxOdd";
                            }
							$gameId = $row['gameId'];
							$pic = $row['pic'];
							$description = $row['description'];
							$likes = $row['likes'];
							echo '<center><div class = "'.$divString.'">';
							echo '<h3 class = "w">'.$gameId.'</h3>';
							echo '<div class = "sub"><a href = "direct.php?direct='.$gameId.'"><img class ="display" src = "'.$pic.'"></a></div>';
							echo "<div class = \"descript\"><span><p class = \"center\">$description
							NUMBER OF LIKES: $likes</p></span><br>";
                            if(array_key_exists('loggedIn', $_SESSION))
                            {
                                if($_SESSION['loggedIn'] == 1)
                                {
                                    echo "<input class = \"button\"  name = \"like\" value=\"LIKE\">";
                                }
                            }
                            echo "</div>";
							echo "</div></center><br/>";
							$row = $result->fetch_array(MYSQLI_ASSOC);
                            $count = $count + 1;
						}
						echo '</div>';
					}
					echo "<br/>";
				} 
			}
			else
			{
				echo '<center><div class = "hback"><h1 class = "title"> SEARCH RESULTS </h1></div></center>';
				$search = $_POST['search'];
				$query = "Select * From Game Where gameId Like '$search%';";
				$result = $database->query($query);
                $count = 0;
                $divString = "";
                
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
                            if($count % 2 == 0)
                            {
                                $divString = "boxEven";
                            }
                            else
                            {
                                $divString = "boxOdd";
                            }
							$gameId = $row['gameId'];
							$pic = $row['pic'];
							$description = $row['description'];
							$likes = $row['likes'];
							echo '<center><div class = "'.$divString.'">';
							echo '<h3 class = "w">'.$gameId.'</h3>';
							echo '<div class = "sub"><a href = "direct.php?direct='.$gameId.'"><img class ="display" src = "'.$pic.'"></a></div>';
							echo "<div class = \"descript\"><span><p class = \"center\">$description
							NUMBER OF LIKES: $likes</p></span><br>";
                            if(array_key_exists('loggedIn', $_SESSION))
                            {
                                if($_SESSION['loggedIn'] == 1)
                                {
                                    echo "<input class = \"button\"  name = \"like\" value=\"LIKE\">";
                                }
                            }
                            echo "</div>";
							echo "</div></center><br/>";
							$row = $result->fetch_array(MYSQLI_ASSOC);
                            $count = $count + 1;
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
