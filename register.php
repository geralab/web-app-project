<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="gstyle.css">
  <title>REGISTER</title>
</head>
<body class = "normal">
<center><div class = "banner"><h1 class = "title">REGISTER</h1></div></center>
		<center><ul id="navbar">
		    <li><a href = "http://www.cs.okstate.edu/~geralab/home.php">HOME</a></li>
		</ul></center>
<?php
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
		if (array_key_exists('userName', $_POST) && 
				array_key_exists('password', $_POST) 
				&& array_key_exists('email', $_POST))
		{
			$userName = $_POST['userName'];
			$password = $_POST['password'];
			$email = $_POST['email'];
			$salt = openssl_random_pseudo_bytes(16, $cstrong);
			$salt = bin2hex($salt);
		    $passAndSalt = $password . $salt;
			$passHash = hash('sha256', $passAndSalt);
			//to here
			$query = "INSERT INTO Gamer (userName,email, salt, passwordHash,admin) VALUES
	('$userName','$email', '$salt', '$passHash',0);";
			$result = $database->query($query);
		}
		echo '<center><div class = "login"><form class = "login" id="registerForm" name="loginForm" action="register.php" method="POST">', "\n";
		echo '<label for="userName">Username:</label>';
		echo '<input type="textfield" name="userName"><br/>', "\n";
		echo '<label for="password">Password:</label>';
		echo '<input type="password" name="password"><br/>', "\n";
		echo '<label for="email">E-MAIL:</label>';
		echo '<input type="textfield" name="email"><br/>', "\n";
		echo '<br/>', "\n";
		echo '<input class = "button" type="submit" value="REGISTER">', "\n";
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
