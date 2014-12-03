<?php
	if (array_key_exists('tgi', $_GET))
	{
        session_start();
	    $query = array();
		
        $userName = $_SESSION['user'];
        $gameId = $_GET['tgi'];
        $query[0] = "Insert Into Likes (userName,gameId) Values ('$userName','$gameId');";
        $query[1] = "Select likes From Game Where gameId = '$gameId';";
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
		$result = $database->query($query[0]);
        $likes = getInfo($query[1],'likes',$database);
        $likes = $likes + 1;
        $query[2] = "UPDATE Game SET likes = $likes WHERE gameId ='$gameId';";
        $result = $database->query($query[2]);
        
        
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
