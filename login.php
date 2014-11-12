<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="gstyle.css">
  <title> LOGIN</title>
</head>
<body>
<h1 class = "title">LOGIN</h1>
		<center><ul id="navbar">
		    <li><a href = "home.php">HOME</a></li>
			<li><a href = "register.php">REGISTER</a></li>
		</ul></center>
<?php
		session_start();
		$_SESSION['admin'] = '';
		$_SESSION['loggedIn'] = '';
		$_SESSION['user'] = '';
		$_SESSION['password'] = '';
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
		if (array_key_exists('user', $_POST) && 
				array_key_exists('password', $_POST) )
		{
			$user = $_POST['user'];
			$password = $_POST['password'];
			$query = "SELECT * FROM Gamer WHERE userName = '$user';";
			$salt = getInfo($query,'salt',$database);
			$dbHash = getInfo($query,'passwordHash',$database);
		    $passAndSalt = $password . $salt;
			$passHash = hash('sha256', $passAndSalt);
			$admin = getInfo($query,'admin',$database);
			//to here
			if($dbHash == $passHash)
			{
				$_SESSION['user'] = $user;
				$_SESSION['password'] = $password;
				$_SESSION['loggedIn']  = 1;
				if($admin == 1)
				{
					$_SESSION['admin'] = 1;
					header('Location:admin.php');
				}
				else
				{
					header('Location:profile.php');
				}
			}
			else
			{
				echo '<div class = "out"><h4 id="out"><pre class = "normal">INVALID CREDENTIALS
							</pre></h4></div>';
			}
		}
		echo '<center><div class = "login"><form class = "login" id="loginForm" name="loginForm" action="login.php" method="POST">', "\n";
		echo '<label for="user">Username:</label>';
		echo '<input type="textfield" name="user"><br/>', "\n";
		echo '<label for="password">Password:</label>';
		echo '<input type="password" name="password"><br/>', "\n";
		echo '<br/>', "\n";
		echo '<input class = "button" type="submit" value="LOGIN">', "\n";
		echo '</form><br/>', "\n";
		echo '</div></center>';
		
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
</body>
</html>
