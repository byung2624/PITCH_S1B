<?php
// saves answers to questions

session_start();
include('mlwebdb.inc.php');

/* Redirect to a different page in the current directory that was requested */
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');



if ($_POST) {
	$subject = $_SESSION['subject'];
	$serial = $_SESSION['subject'];
	$round = $_SESSION['round'];
	$expname = $_SESSION['expname'];
	foreach ($_POST as $key => $value) { 
		 switch ($key) {
				case "spend":
					$spend = $value;
					break;
			}
		switch ($key) {
				case "vivid":
					$vivid = $value;
					break;
			}
		switch ($key) {
				case "concrete":
					$concrete = $value;
					break;
			}
		switch ($key) {
				case "happy":
					$happy = $value;
					break;
			}
	}
	
	$query = "INSERT INTO `salience_ratings` (serial, expname, salience_type, salience) VALUES ('$serial','$expname', 'spend', '$spend'), ('$serial','$expname', 'vivid', '$vivid'), ('$serial','$expname', 'concrete', '$concrete'), ('$serial','$expname', 'happy', '$happy')";
	
	$result = mysql_query($query);
	if (!$result) {
		die('Could not query: ' . mysql_error());
	}

	mysql_close();
	
	
	header("Location: https://$host$uri/ml_web.php?subject=$subject&condnum=$condnum");
    exit;
}

?>
