<?php
	if (array_key_exists('ascertain', $_GET) && array_key_exists('tn', $_GET)) 
	{
	    $query = array();
		$query[0] = "";
		$queryNumber= $_GET['ascertain'];
		$userName= $_GET['tn'];
		$fileText = file_get_contents('/home/geralab/pass.txt', FILE_USE_INCLUDE_PATH);
	    $password = trim($fileText);
		$user = 'geralab';
		$dbName = $user; 
		$database = new mysqli("cs.okstate.edu", $user, $password, $dbName);
		if (mysqli_connect_errno()) 
		{
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		$output = array();
		$result = $database->query($query);
	}  
?>
