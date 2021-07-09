<?php

////////////////////////
// General Rewrite of Mouselab Web for ITC
// Daniel Wall
// 24 September 2014
///////////////////////

// This is a domain general way to look at ITC
// set up variables (you can change this based on what you would like)

// Initial bookkeeping 
/////////////////////////////////////////////////
session_start();

// get the serial into the session
if (isset($_SESSION['serial'])) { 
	$subject = $_SESSION['serial']; 
} else {
	if (isset($_GET['serial'])) {
		$subject=$_GET['serial'];
		$_SESSION['serial'] = $_GET['serial'];
	} else {
		$subject="0";
	}
}

// get the condition number for mlweb db (for current purposes we are NOT counterbalancing)	
if (isset($_GET['condnum'])) {
	$condnum=$_GET['condnum'];
}	else {
	$condnum=-1;
}
/////////////////////////////////////////////////

/////////////////////////////////////////////////
/////////////////////////////////////////////////
// Edit this portion of the script if for your new mlweb script
/////////////////////////////////////////////////
/////////////////////////////////////////////////

/////////////////////////////////////////////////
// Includes
/////////////////////////////////////////////////

// database connection
include "mlwebdb.inc.php";


/////////////////////////////////////////////////
// Variables to alter
/////////////////////////////////////////////////

// name of experiment which will show up in mlweb database table
/////////////////////////////////////////////////
$expname = "crystal_delay_set_a_itc_";

// what's on top
/////////////////////////////////////////////////

// for this study the top row will always be amount
$top_row = "amount";
/////////////////////////////////////////////////

// which group of gambles are we using from the itc_query table
/////////////////////////////////////////////////
$query_group = "A";
/////////////////////////////////////////////////

// delay or accelerate trial type
/////////////////////////////////////////////////
$delay_accel = "delay";
/////////////////////////////////////////////////

// default side
/////////////////////////////////////////////////
$default_side = "left";
/////////////////////////////////////////////////

// number of intertemporal choices
/////////////////////////////////////////////////
$n_round = 18;
/////////////////////////////////////////////////

// column headers for itc task
/////////////////////////////////////////////////
$colhead_left = 'You are assigned to get';
$colhead_right = 'You can switch to';
/////////////////////////////////////////////////

// name of counterbalance table
/////////////////////////////////////////////////
$cb_table = 'choices_seen';
/////////////////////////////////////////////////


/////////////////////////////////////////////////
/////////////////////////////////////////////////
// main part of php script
/////////////////////////////////////////////////
/////////////////////////////////////////////////


// iterate over the intertemporal choice tasks
/////////////////////////////////////////////////

// first iteration
if (! isset($_SESSION['round'])) {
	// initialize the variables in the session (e.g. cookie)
	$_SESSION['round'] = 0;
 	// $_SESSION['ss_delay_type'] = $ss_delay_type;
	$_SESSION['default_side'] = $default_side;
	$_SESSION['top_row'] = $top_row; 
	$serial = $_SESSION['serial'];
	// should the trial start as being hidden
	$starthidden = 1;
} else if (isset($_SESSION['round'])) {
	// all other rounds
	
	// increment in save.php to fix the refresh/back button issues

	// $ss_delay_type = $_SESSION['ss_delay_type'];
	
	$top_row = $_SESSION['top_row'];
	// should the trial start as being hidden
	$starthidden = 0;
}

// set the round variable to the session
$round = $_SESSION['round'];


// redirect to referrer if the number of rounds is too great
if ($round < $n_round) {
	// CHANGE this to whatever you name this PHP file.
	$nexturl = "ml_web.php";

} else if ($round == 4 || $round == 8 || $round == 12 || round == 16) {
	$nexturl = "query_survey.php";
} else if ($round == $n_round) {
	// send to referrer
	$nexturl = "2referrer.php";
	unset($_SESSION['round']);
}




// Get the values that this participant has already seen
$query = sprintf("SELECT `itc_regular_id` FROM %s WHERE serial = %d",
				   $cb_table,
				   $_SESSION['serial']);

				   
$result = mysql_query($query);
if (!$result) {
		die('Could not query: ' . mysql_error());
	}

// if the participant hasn't seen any trials before select any item from itc_regular
if (mysql_num_rows($result) == 0 ) {
	$query = "SELECT * FROM `itc_regular` ORDER BY RAND() LIMIT 1";
} else if ($round != 4 || $round != 8 || $round != 12 || $round != 16) {
	// if the participant has seen a regular trial before
	
	// get all of the rows of the values which have been seen
	while($itc_ids = mysql_fetch_array($result, MYSQL_ASSOC)) {
		//will output all data on each loop.
		$itc_array[] = ($itc_ids);
	}
	
	// get all of the id's into their own array
	$regular_id_array = array();
	foreach ($itc_array  as $entry) {
		$regular_id_array[] = $entry['itc_regular_id'];
	}
		
	// what items have been seen before
	$query = "SELECT * FROM `itc_regular` WHERE `id` NOT IN (". implode(',',$regular_id_array) . ") ORDER BY RAND() LIMIT 1";
} else if ($round == 4) {
	// questions which will redirect to another page and ask valence ratings
	$query = sprintf("SELECT * FROM `itc_query` WHERE `query_group` = '%s' AND `query_group_order` = 1",
					$query_group);
} else if ($round == 8) {
	$query = sprintf("SELECT * FROM `itc_query` WHERE `query_group` = '%s' AND `query_group_order` = 2",
					$query_group);
} else if ($round == 12) {
	$query = sprintf("SELECT * FROM `itc_query` WHERE `query_group` = '%s' AND `query_group_order` = 3",
					$query_group);
} else if ($round == 16) {
	$query = sprintf("SELECT * FROM `itc_query` WHERE `query_group` = '%s' AND `query_group_order` = 4",
					$query_group);
}

// get the values of the itc for this question
$result_rnd = mysql_query($query);
if (!$result_rnd) {
	die('Could not query: ' . mysql_error());
}		

$row_array = mysql_fetch_array($result_rnd, MYSQL_ASSOC);
$ss_amt = $row_array["ss_amt"];
$ss_time = $row_array["ss_time"];
$ll_amt = $row_array["ll_amt"];
$ll_time = $row_array["ll_time"];


// Top row is Amount, Bottom Row is Time  and default is on the left
if($top_row == "amount" && $default_side == "left") {
	echo "amount, left";
	// Column headings for default (delay vs accel)
	$colhead_left = "<b><font size = '5' color = '002B3D'>You are assigned to get</font></b>";
	$colhead_right = "<font size = '4'>You can switch to</font>";

	
	// button tags (what shows up as the answer to mlweb question
	$btntag1 = "SS";
	$btntag2 = "LL";
	
	// Mouselab cover
	$box_pos_1 = "Amount";
	$box_pos_2 = "Amount";
	$box_pos_3 = "Time";
	$box_pos_4 = "Time";

	// What you see when you mouseover a cell
	$text_pos_1 = $ss_amt;
	$text_pos_2 = $ll_amt;
	$text_pos_3 = $ss_time;
	$text_pos_4 = $ll_time;
} else if($top_row == "time" && $default_side == "left") {
	// Top row is time, Bottom Row is amount and default is on the left
	
	// Column headings for default (delay vs accel)
	$colhead_left = "<b><font size = '5' color = '002B3D'>You are assigned to get</font></b>";
	$colhead_right = "<font size = '4'>You can switch to</font>";
	
	// button tags
	$btntag1 = "SS";
	$btntag2 = "LL";
	
	// Mouselab cover
	$box_pos_1 = "Time";
	$box_pos_2 = "Time";
	$box_pos_3 = "Amount";
	$box_pos_4 = "Amount";
	// What you see when you mouseover a cell
	$text_pos_1 = $ss_time;
	$text_pos_2 = $ll_time;
	$text_pos_3 = $ss_amt;
	$text_pos_4 = $ll_amt;
}



// if the fixation cross or the mouselab web table are visible
if ($starthidden == 1) {
	$visMLW = "hidden";
	$visStart ="visible";
} else {
	$visMLW = "visible";
	$visStart ="hidden";
}

// This code checks to see if the user is running MSIE, and if so, it adjusts the top padding of the cross-button DIV
$pos1d = stripos($_SERVER['HTTP_USER_AGENT'], "MSIE");
if ($pos1d === false) {
	$pracpad = 130; $pad = 110;
} else {
	$pracpad = 150; $pad = 130;
}
echo $round;
echo $top_row;
echo $default_side;
echo $colhead_left;
echo $colhead_right;
echo($text_pos_1);
echo($text_pos_2);
?>
