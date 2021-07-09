<?php
// saves answers to questions

session_start();
include('mlwebdb.inc.php');

/* Redirect to a different page in the current directory that was requested */
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');



if ($_POST) {
	$serial = $_SESSION['subject'];
	foreach ($_POST as $key => $value) { 
		 switch ($key) {
				case "valence":
					$valence = $value;
					break;
			}
	}
	
	
	header("Location: https://$host$uri/ml_web.php?subject=$subject&condnum=$condnum");
    exit;
}

?>
