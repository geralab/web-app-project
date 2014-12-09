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
                    echo '<pre><h1 class = "title">WELCOME '. $_SESSION['user'].'</pre></h1></div></center><br>';
                }
                else
                {
                    echo '<center><div class = "hback"><h1 class = "title"> QUAZZAR HOME</h1></div></center><br>';
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
                            if($count == 0)
                            {
                                $divString = "boxOne";
                            }
                            else if($count == 1)
                            {
                                $divString = "boxTwo";
                            }
                            else if($count == 2)
                            {
                                $divString = "boxThree";
                            }
							$gameId = $row['gameId'];
							$pic = $row['pic'];
							$description = $row['description'];
							$likes = $row['likes'];
                            $plays = $row['plays'];
							echo '<center><div class = "'.$divString.'">';
							echo '<h3 class = "w">'.$gameId.'</h3>';
							echo '<div class = "sub"><a href = "direct.php?direct='.$gameId.'"><img class ="display" src = "'.$pic.'"></a><br></div>';
							echo "<div class = \"descript\"><p class = \"center\">$description
                            NUMBER OF LIKES: $likes NUMBER OF PLAYS: $plays </p>";
                            
                            if(array_key_exists('loggedIn', $_SESSION))
                            {
                                if($_SESSION['loggedIn'] == 1)
                                {
                                    $query2 = "Select userName From Likes Where gameId = '$gameId';";
                                    $userName = getInfo($query2,'userName',$database);
                                    if($userName == $_SESSION['user'])
                                    {
                                       
                                    }
                                    else
                                    {
                                        echo '<form action = "home.php" id = "'.$gameId.'"><button id = "'.$gameId.'" class = "like" onclick = "like(this)">LIKE</button></form>';
                                    }
                                }
                            }
                            echo "</div><br>";
							echo "</div></center><br/>";
							$row = $result->fetch_array(MYSQLI_ASSOC);
                            $count = ($count + 1) % 3;
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
                            if($count == 0)
                            {
                                $divString = "boxOne";
                            }
                            else if($count == 1)
                            {
                                $divString = "boxTwo";
                            }
                            else if($count == 2)
                            {
                                $divString = "boxThree";
                            }
							$gameId = $row['gameId'];
							$pic = $row['pic'];
							$description = $row['description'];
							$likes = $row['likes'];
                            $plays = $row['plays'];
							echo '<center><div class = "'.$divString.'">';
							echo '<h3 class = "w">'.$gameId.'</h3>';
							echo '<div class = "sub"><a href = "direct.php?direct='.$gameId.'"><img class ="display" src = "'.$pic.'"></a><br></div>';
							echo "<div class = \"descript\"><p class = \"center\">$description
							NUMBER OF LIKES: $likes NUMBER OF PLAYS: $plays </p>";
                            if(array_key_exists('loggedIn', $_SESSION))
                            {
                                if($_SESSION['loggedIn'] == 1)
                                {
                                    $query2 = "Select userName From Likes Where gameId = '$gameId';";
                                    $userName = getInfo($query2,'userName',$database);
                                    if($userName == $_SESSION['user'])
                                    {
                                       
                                    }
                                    else
                                    {
                                        echo '<form action = "home.php" id = "'.$gameId.'"><button id = "'.$gameId.'" class = "like" onclick = "like(this)">LIKE</button></form>';
                                    }
                                    
                                }
                            }
                            echo "</div><br>";
							echo "</div></center><br/>";
							$row = $result->fetch_array(MYSQLI_ASSOC);
                            $count = ($count + 1) % 3;
						}
						echo '</div>';
					}
					echo "<br>";
				} 
			}
    
            function getInfo($query,$col,$database)
            {
                $result = $database->query($query);
                $info='';
                if (is_object($result))
                {
                    $row = $result->fetch_array(MYSQLI_ASSOC);
                    $info = $row[$col];
                }
                return $info;
            }
				
		
		?>
		<script>
		
				function like(tgi)
				{
					var httpRequest = new XMLHttpRequest();
					var url = "ascertain.php?tgi=" + tgi.id;
					httpRequest.open("GET", url, false);
					httpRequest.send(null);
                    tgi.submit();
				}
			
		</script>
	</body>
</html>
