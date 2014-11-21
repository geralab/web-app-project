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
                    $pic = $row['pic'];
                    $type = $row['type'];
                    echo "<center><div class = \"hback\"><h1 class = \"title\">$gameId</h1></div>";
                    if($type == "flash")
                    {
                        list($width, $height, $type, $attr) = getimagesize("$fileName");
                        //echo '<div class = "contain">';
                        
                        echo '<div class = "gameDiv"><object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="'.$width.'" height="'.$height.'" id="'.$gameId.'" align="middle">';
                        echo '<param name="movie" value="'.$fileName.'"/>';
                        echo '<!--[if !IE]>-->';
                           echo '<object type="application/x-shockwave-flash" data="'.$fileName.'" width="'.$width.'" height="'.$height.'">';
                            echo '<param name="movie" value="'.$fileName.'"/>';
                            echo '<!--<![endif]-->';
                            echo '<a href="http://www.adobe.com/go/getflash">';
                            echo '<img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player"/>';
                            echo '</a><div class ="descript"><p>Please click the link above to install flash player and play '.$gameId.' or to find out if adobe flash is supported by your device</p></div><div class = "display"><img src = "'.$pic.'"></img></div>';
                            echo '<!--[if !IE]>-->';
                               echo '</object>';
                                echo '<!--<![endif]-->';
                                echo '</object></div>';
                        //echo '</div>';
                        echo '<br><br>';
                    }
                    else if($type == "unity")
                    {
                        header('Location:'.$fileName);
                    }
                }
				echo "<br/></center>";
			} 
?>

</body>
</html>

