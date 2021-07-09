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

// get the condition number for mlweb db	
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

// name of experiment which will show up in mlweb table
/////////////////////////////////////////////////
$expname = "danwall_itc_";

// now versus not now smaller sooner time
/////////////////////////////////////////////////
// random number
$ss_delay_type = rand(1, 2);
// convert number to descriptive text
if ($ss_delay_type == 1) {
	$ss_delay_type = "now";
} else if ($ss_delay_type == 2) {
	$ss_delay_type = "not_now";
}
/////////////////////////////////////////////////

// default side
/////////////////////////////////////////////////

// Crystal Reeck recommended keeping the default on the left
$default_side = "left";

// uncomment the below section to have the default be randomly assigned
/* 
// random number
$default_side = rand(1, 2);
// convert number to descriptive text
if ($default_side == 1) {
	$default_side = "left";
} else if ($default_side == 2) {
	$default_side = "right";
} */
/////////////////////////////////////////////////

// number of intertemporal choices
/////////////////////////////////////////////////
$n_round = 18;

// column headers for itc task
/////////////////////////////////////////////////
$colhead_left = 'You are assigned to get';
$colhead_right = 'You can switch to';

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
	$_SESSION['ss_delay_type'] = $ss_delay_type;
	$_SESSION['default_side'] = $default_side;
	// should the trial start as being hidden
	$starthidden = 1;
} else if (isset($_SESSION['round'])) {
	// all other rounds
	$_SESSION['round'] = $_SESSION['round'] + 1;
	$ss_delay_type = $_SESSION['ss_delay_type'];
	// should the trial start as being hidden
	$starthidden = 0;
}

// redirect to referrer if the number of rounds is too great
if ($round < $n_round) {
	// CHANGE this to whatever you name this PHP file.
	$nexturl = "ml_web.php";
} else {
	// send to referrer
	$nexturl = "2referrer.php";
	unset($_SESSION['round']);
}

// get the values of the itc
$query = "SELECT * FROM itc_values_dan WHERE round ='$round' AND ss_delay_type = '$ss_delay_type'";
$result = mysql_query($query);
if (!$result) {
    die('Could not query: ' . mysql_error());
}

$row_array = mysql_fetch_array($result, MYSQL_ASSOC);
// get the amounts and times for the present trial
$ss_amt = $row_array["ss_amt"];
$ss_time = $row_array["ss_time"];
$ll_amt = $row_array["ll_amt"];
$ll_time = $row_array["ll_time"];

// position of times/amounts
// NOTE: can change later to have if elses to have differences on where they look

// Top row is Amount, Bottom Row is Time



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

// if the fixation cross or the mouselab web table are visible
if ($starthidden == 1) {
	$visMLW = "hidden";
	$visStart ="visible";
} else if ($starthidden == 0) {
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

?>


<HTML>
<HEAD>
<TITLE>Survey</TITLE>
<script language=javascript src="mlweb.js"></SCRIPT>
<link rel="stylesheet" href="mlweb.css" type="text/css">
<style type="text/css">
.style1 {
	border-width: 1px;
	background-color: #C0C0C0;
}
</style>
</head>

<body onLoad="timefunction('onload','body','body')">

<script language="javascript">
ref_cur_hit = <?php echo($condnum);?>;
subject = "<?php echo($subject);?>";
</script>

<!--BEGIN TABLE STRUCTURE-->
<SCRIPT language="javascript">
// override defaults
mlweb_outtype="CSV";
mlweb_fname="mlwebform";
tag = "c0^c1`"
 + "a0^a1`"
 + "t0^t1";

// text box (what is there before the mouseover) is defined above
txt = "<?php echo($colhead_left);?>^<?php echo($colhead_right);?>`"
 + "<?php echo($text_pos_1);?>^<?php echo($text_pos_2);?>`"
 + "<?php echo($text_pos_3);?>^<?php echo($text_pos_4);?>";

state = "0^0`"
 + "1^1`"
 + "1^1";

box = "^`"
 + "<?php echo($box_pos_1);?>^<?php echo($box_pos_2);?>`"
 + "<?php echo($box_pos_3);?>^<?php echo($box_pos_4);?>";
 
 
CBCol = "0^0";
CBRow = "0^0^0";
W_Col = "200^200";
H_Row = "100^100^100";

chkchoice = false;
btnFlg = 1;
btnType = "button";
btntxt = "Choose^Choose";
btnstate = "1^1";
btntag = "btn1^btn2";
to_email = "";
colFix = false;
rowFix = false;
CBpreset = false;
evtOpen = 0;
evtClose = 0;
chkFrm=false;
warningTxt = "Some questions have not been answered. Please answer all questions before continuing!";
tmTotalSec = 60;
tmStepSec = 1;
tmWidthPx = 200;
tmFill = true;
tmShowTime = true;
tmCurTime = 0;
tmActive = false;
tmDirectStart = true;
tmMinLabel = "min";
tmSecLabel = "sec";
tmLabel = "Timer: ";

//Delay: a0 a1 t0 t1
delay = "0^0^0^0`"
 + "0^0^0^0`"
 + "0^0^0^0`"
 + "0^0^0^0";
activeClass = "actTD";
inactiveClass = "inactTD";
boxClass = "boxTD";
cssname = "mlweb.css";
// next url and experiment name come from php above
nextURL = "<?php echo $nexturl; ?>";
expname = "<?php echo $expname . $round; ?>";
randomOrder = false;
recOpenCells = false;
masterCond = 1;
loadMatrices();
</SCRIPT>

<!--MLWeb form-->

<FORM name="mlwebform" onSubmit="return checkForm(this)" method="POST" action="save.php"><INPUT type=hidden name="procdata" value="">
<input type=hidden name="subject" value="">
<input type=hidden name="expname" value="">
<input type=hidden name="nextURL" value="">
<input type=hidden name="choice" value="">
<input type=hidden name="condnum" value="">
<input type=hidden name="to_email" value="">
