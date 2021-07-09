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
		 $_SESSION['subject'] = $subject;
	} else {
		$subject="0";
	}
}

$_SESSION['subject'] = $subject;


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
$expname = "magnitude_set_a";

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
$n_round = 28;
/////////////////////////////////////////////////

// column headers for itc task
/////////////////////////////////////////////////
$colhead_left = 'Option A';
$colhead_right = 'Option B';
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
// Referrer has a $_SESSION['round'] variable which screws up my code
// hence the round_1 in the below if statement
if (! isset($_SESSION['round_1'])) {
	// initialize the variables in the session (e.g. the cookie)
	$_SESSION['round_1'] = 0;
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
	
	// $top_row = $_SESSION['top_row'];
	// should the trial start as being hidden?
	$starthidden = 0;
} 


// set the round variable to the session
$round = $_SESSION['round'];


// redirect to referrer if the number of rounds is too great
if ($round < $n_round) {
	// CHANGE this to whatever you name this PHP file.
	$nexturl = "ml_web.php";

} 
// change next url to be the valence survey
 if ($round == $n_round) {
	// send to referrer
	$nexturl = "2referrer.php";
	unset($_SESSION['round']);
		unset($_SESSION['round_1']);
}


// Get the values that this participant has already seen
$query = sprintf("SELECT `itc_regular_id` FROM %s WHERE serial = %d",
				   $cb_table,
				   $_SESSION['serial']);

				   
$result = mysql_query($query);

if (!$result) {
		die('Could not query: ' . mysql_error());
	}

// echo mysql_num_rows($result);
// if the participant hasn't seen any trials before select any item from itc_regular
// var_dump($round !== 4 && $round !== 8 && $round !== 12 && $round !== 16);
// echo mysql_num_rows($result);
if ($round == 0 ) {
	$query = "SELECT * FROM `itc_regular` WHERE `query_group` = 'AP'";
	$result_rnd = mysql_query($query);
	if (!$result_rnd) {
		die('Could not query: ' . mysql_error());
	}		
	
	// get values in a nice associative array
	$row_array = mysql_fetch_array($result_rnd, MYSQL_ASSOC);
	$ss_amt = $row_array["ss_amt"];
	$ss_time = $row_array["ss_time"];
	$ll_amt = $row_array["ll_amt"];
	$ll_time = $row_array["ll_time"];
	
	// get the id number of the itc
	$itc_id = $row_array["id"];
	// echo $cb_table;
	// echo $cb_table;
	$cb_query =  "INSERT INTO $cb_table (`itc_regular_id`, `serial`, `time`, `round`, `delay_accel`, `query_group`) VALUES('$itc_id', '$subject', NOW(), '$round', '$delay_accel', '$query_group')";
	// echo $cb_query;
	$result_cb = mysql_query($cb_query);
	if (!$result_cb) {
		die('Could not query: ' . mysql_error());
	}
	// get the values of the itc for this question
	$result_rnd = mysql_query($query);
	if (!$result_rnd) {
		die('Could not query: ' . mysql_error());
	}		

	// get the row array for the itc item
	$row_array = mysql_fetch_array($result_rnd, MYSQL_ASSOC);
	$ss_amt = $row_array["ss_amt"];
	$ss_time = $row_array["ss_time"];
	$ll_amt = $row_array["ll_amt"];
	$ll_time = $row_array["ll_time"];
	
} else if($round == 28 ) {
	
	$ss_amt = "$41.80";
	$ss_time = "1 days";
	$ll_amt = "$41.80";
	$ll_time = "60 days";
	// get the id number of the itc
	$itc_id = 28;
	$cb_query =  "INSERT INTO $cb_table (`itc_regular_id`, `serial`, `time`, `round`, `delay_accel`, `query_group`) VALUES('$itc_id', '$subject', NOW(), '$round', '$delay_accel', '$query_group')";
	$result_cb = mysql_query($cb_query);
	if (!$result_cb) {
		die('Could not query: ' . mysql_error());
	}		
	
}else if ($round !== 28) {
	// if the participant has seen a regular trial before
	// echo '<br>';
	// echo $round;
	// get all of the rows of the values which have been seen
	while($itc_ids = mysql_fetch_array($result, MYSQL_ASSOC)) {
		//will output all data on each loop.
		$itc_array[] = ($itc_ids);
	}
	// print_r($itc_array);
	// get all of the id's into their own array
	$regular_id_array = array();
	foreach ($itc_array  as $entry) {
		$regular_id_array[] = $entry['itc_regular_id'];
	}
		
	// what items have been seen before
	$query = "SELECT * FROM `itc_regular` WHERE `query_group` = '$query_group' AND `id` NOT IN (". implode(',',$regular_id_array) . ") ORDER BY RAND() LIMIT 1";
	$result_rnd = mysql_query($query);
	if (!$result_rnd) {
		die('Could not query: ' . mysql_error());
	}		
	
	// get values in a nice associative array
	$row_array = mysql_fetch_array($result_rnd, MYSQL_ASSOC);
	$ss_amt = $row_array["ss_amt"];
	$ss_time = $row_array["ss_time"];
	$ll_amt = $row_array["ll_amt"];
	$ll_time = $row_array["ll_time"];
	
	// get the id number of the itc
	$itc_id = $row_array["id"];
	$cb_query =  "INSERT INTO $cb_table (`itc_regular_id`, `serial`, `time`, `round`, `delay_accel`, `query_group`) VALUES('$itc_id', '$subject', NOW(), '$round', '$delay_accel', '$query_group')";
	$result_cb = mysql_query($cb_query);
	if (!$result_cb) {
		die('Could not query: ' . mysql_error());
	}		
} 



// query questions
 if ($round == 40 ) {
	// questions which will redirect to another page and ask valence ratings
	$query = sprintf("SELECT * FROM `itc_query` WHERE `query_group` = '%s' ORDER BY RAND() LIMIT 1",
					$query_group);
					
	$result_rnd = mysql_query($query);
	if (!$result_rnd) {
		die('Could not query: ' . mysql_error());
	}		

	// get the row array for the itc item
	$row_array = mysql_fetch_array($result_rnd, MYSQL_ASSOC);
	$ss_amt = $row_array["ss_amt"];
	$ss_time = $row_array["ss_time"];
	$ll_amt = $row_array["ll_amt"];
	$ll_time = $row_array["ll_time"];
	$query_group_order = $row_array["query_group_order"];
	// print_r($row_array);
	// print_r($row_array);
	$insert_query = "INSERT INTO `choices_seen_query` (`serial`, `query_group`, `query_group_order`, `time`, `round`, `delay_accel`) VALUES('$subject', '$query_group', '$query_group_order', NOW(), '$round', '$delay_accel')";
	 // echo $insert_query;
	$insert_result = mysql_query($insert_query);
	if (!$insert_result) {
		die('Could not query round 4: ' . mysql_error());
	}		
	
}  else if ( $round == 80 || $round == 120 || $round == 160) {
	$cb_pull_query = sprintf("SELECT `query_group_order` FROM `choices_seen_query` WHERE `serial` = '%d' AND `query_group` = '%s'",
							$subject,
							$query_group);

	 // echo $cb_pull_query;  
	$cb_result = mysql_query($cb_pull_query);
 	//$cb_array_1 = mysql_fetch_array($cb_result, MYSQL_ASSOC);
	// print_r($cb_array_1);  
	
	if (!$cb_result) {
		die('Could not query: ' . mysql_error());
	}		
	// get all of the rows of the values which have been seen
	while($itc_ids_2 = mysql_fetch_array($cb_result, MYSQL_ASSOC)) {
		//will output all data on each loop.
		$itc_query_array[] = ($itc_ids_2);
	}
	// print_r($itc_query_array);
	// echo '<BR><BR>';
	// get all of the id's into their own array
	$query_id_array = array();
	if (is_array($itc_query_array)){
		foreach ($itc_query_array as $entry) {
			$query_id_array[] = $entry['query_group_order'];
		}
	}
	// echo '<BR><BR>';
	// print_r($query_id_array);
	
	// $cb_array = mysql_fetch_array($cb_result, MYSQL_ASSOC);
	
	$query = "SELECT * FROM `itc_query` WHERE `query_group` = '$query_group' AND `query_group_order` NOT IN (". implode(',',$query_id_array) . ") ORDER BY RAND() LIMIT 1";
	// echo $query;
	$result_rnd = mysql_query($query);
	if (!$result_rnd) {
		die('Could not query: ' . mysql_error());
	}		
	$row_array = mysql_fetch_array($result_rnd, MYSQL_ASSOC);
	$ss_amt = $row_array["ss_amt"];
	$ss_time = $row_array["ss_time"];
	$ll_amt = $row_array["ll_amt"];
	$ll_time = $row_array["ll_time"];	
	$query_group_order = $row_array["query_group_order"];
	$insert_query = "INSERT INTO `choices_seen_query` (`serial`, `query_group`, `query_group_order`, `time`, `round`, `delay_accel`) VALUES('$subject', '$query_group', '$query_group_order', NOW(), '$round', '$delay_accel')";
	// echo $insert_query;
	$insert_result = mysql_query($insert_query);
	if (!$insert_result) {
		die('Could not query: ' . mysql_error());
	}						
					
}
/*  else if ($round == 12) {
	$query = sprintf("SELECT * FROM `itc_query` WHERE `query_group` = '%s' AND `query_group_order` = 3",
					$query_group);
} else if ($round == 16) {
	$query = sprintf("SELECT * FROM `itc_query` WHERE `query_group` = '%s' AND `query_group_order` = 4",
					$query_group);
} */ 



// Top row is Amount, Bottom Row is Time  and default is on the left
if($top_row == "amount" && $default_side == "left") {

	// Column headings for default (delay vs accel)
	$colhead_left = "<font size = '4'>Option A</font>";
	$colhead_right = "<font size = '4'>Option B</font>";

	// text which is shown on the buttons
	$btntxt1 = "CHOOSE";
	$btntxt2 = "CHOOSE";
	
	// button tags (what shows up as the answer to mlweb question
	$btntag1 = "SS";
	$btntag2 = "LL";
	
	// Mouselab cover
	$box_pos_1 = "Amount";
	$box_pos_2 = "Amount";
	$box_pos_3 = "Time";
	$box_pos_4 = "Time";

	if ($delay_accel == "delay") {
		// What you see when you mouseover a cell
		$text_pos_1 = $ss_amt;
		$text_pos_2 = $ll_amt;
		$text_pos_3 = $ss_time;
		$text_pos_4 = $ll_time;
	} else if ($delay_accel == "accel") {
		$text_pos_1 = $ll_amt;
		$text_pos_2 = $ss_amt;
		$text_pos_3 = $ll_time;
		$text_pos_4 = $ss_time;
	}
} else if($top_row == "time" && $default_side == "left") {
	// Top row is time, Bottom Row is amount and default is on the left
	
	// Column headings for default (delay vs accel)
	$colhead_left = "<font size = '4'>Option A</font>";
	$colhead_right = "<font size = '4'>Option B</font>";
	
	// text which is shown on the buttons
	$btntxt1 = "CHOOSE";
	$btntxt2 = "CHOOSE";
	
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

// save an associative array which will be stored in $_SESSION so we can see table in query_survey.php
$row_array['colhead_left'] = $colhead_left;
$row_array['colhead_right'] = $colhead_right;
$row_array['btntxt1'] = $btntxt1;
$row_array['btntxt2'] = $btntxt2;
$row_array['btntag1'] = $btntag1;
$row_array['btntag2'] = $btntag2;
$row_array['box_pos_1'] = $box_pos_1;
$row_array['box_pos_2'] = $box_pos_2;
$row_array['box_pos_3'] = $box_pos_3;
$row_array['box_pos_4'] = $box_pos_4;
$row_array['text_pos_1'] = $text_pos_1;
$row_array['text_pos_2'] = $text_pos_2;
$row_array['text_pos_3'] = $text_pos_3;
$row_array['text_pos_4'] = $text_pos_4;

$_SESSION['row_array'] = $row_array;


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


?>


<!--edited from mlwf-1-5R.php-->

<HTML>
<HEAD>
<TITLE>Survey</TITLE>
<script language=javascript src="mlweb.js"></SCRIPT>
<link rel="stylesheet" href="mlweb.css" type="text/css">
<style type="text/css">
.style1 {
	border-width: 0px;
}
.top { border-top: thin solid blue; }
.bottom { border-bottom: thin solid blue; }
.left { border-left: thin solid blue; }
.right { border-right: thin solid blue; }
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
tag =  "a0^a1^a2`"
 + "b0^b1^b2`"
 + "c0^c1^c2";

// text box (what is there before the mouseover) is defined above
txt = "<?php echo($colhead_left);?>^^<?php echo($colhead_right);?>`"
 + "<?php echo($text_pos_1);?>^^<?php echo($text_pos_2);?>`"
 + "<?php echo($text_pos_3);?>^^<?php echo($text_pos_4);?>";

state = "0^0^0`"
 + "1^0^1`"
 + "1^0^1";

box = "^^`"
 + "<?php echo($box_pos_1);?>^^<?php echo($box_pos_2);?>`"
 + "<?php echo($box_pos_3);?>^^<?php echo($box_pos_4);?>";
 
 
CBCol = "0^0^0";
CBRow = "0^0^0";
W_Col = "200^200^200";
H_Row = "100^100^100";

chkchoice = false;
btnFlg = 1;
btnType = "button";

// special button text for each condition
btntxt = "<?php echo($btntxt1);?>^^<?php echo ($btntxt2);?>";
btnstate = "1^0^1";
// change the btntag to something more meaningful
btntag = "<?php echo($btntag1);?>^^<?php echo($btntag2);?>";
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
subject = "<?php echo $subject; ?>";
randomOrder = false;
recOpenCells = false;
masterCond = 1;
loadMatrices();
</SCRIPT>

<!--MLWeb form-->
<FORM name="mlwebform" onSubmit="return checkForm(this)" method="POST" action="save.php">
   <INPUT type=hidden name="procdata" value="">
   <input type=hidden name="subject" value="">
   <input type=hidden name="expname" value="">
   <input type=hidden name="nextURL" value="">
   <input type=hidden name="choice" value="">
   <input type=hidden name="condnum" value="">
   <input type=hidden name="to_email" value="">
   <!-- MOUSELAB TABLE -->
   <div style="position: relative">
      <div id="mlwtable" style="position: absolute; left: 50px; top 80px; visibility: <?php echo($visMLW)?>;">
         <TABLE border=0 align="center" style="border-collapse: collapse;">
            <TR>
			<!--cell a0(tag:c0)-->
			<TD style="width: 10px;">
			</TD>
               <TD align=center valign=middle class='style1'>
					 <DIV ID="a0_cont" style="position: relative; height: 50px; width: 100px;">
						<DIV ID="a0_txt" STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; clip: rect(0px 100px 50px 0px); z-index: 1;">
						   <TABLE>
							  <TD ID="a0_td" align=center valign=center width=95 height=45 class="inactTD"></TD>
						   </TABLE>
						</DIV>
						<DIV ID="a0_box" STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; clip: rect(0px 100px 50px 0px); z-index: 2;">
						   <TABLE>
							  <TD ID="a0_tdbox" align=center valign=center width=95 height=45 class="boxTD"></TD>
						   </TABLE>
						</DIV>
						<DIV ID="a0_img" STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; z-index: 5;"><A HREF="javascript:void(0);" NAME="a0" onMouseOver="ShowCont('a0',event)" onMouseOut="HideCont('a0',event)"><IMG NAME="a0" SRC="transp.gif" border=0 width=100 height=50></A></DIV>
					 </DIV>
				  </TD>
				  <!--end cell-->
				  <!--cell a1(tag:a1)-->
				  <TD align=center valign=middle style="border: none;">
					 <DIV ID="a1_cont" style="position: relative; height: 50px; width: 100px;">
						<DIV ID="a1_txt" STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; clip: rect(0px 100px 50px 0px); z-index: 1;">
						   <TABLE>
							  <TD ID="a1_td" align=center valign=center width=95 height=45 class="inactTD"></TD>
						   </TABLE>
						</DIV>
						<DIV ID="a1_box" STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; clip: rect(0px 100px 50px 0px); z-index: 2;">
						   <TABLE>
							  <TD ID="a1_tdbox" align=center valign=center width=95 height=45 class="boxTD"></TD>
						   </TABLE>
						</DIV>
						<DIV ID="a1_img" STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; z-index: 5;"><A HREF="javascript:void(0);" NAME="a1" onMouseOver="ShowCont('a1',event)" onMouseOut="HideCont('a1',event)"><IMG NAME="a1" SRC="transp.gif" border=0 width=100 height=50></A></DIV>
					 </DIV>
				  </TD>
				  <!--end cell-->
				  <!--cell a2(tag:a2)-->
				  <TD align=center valign=middle>
					 <DIV ID="a2_cont" style="position: relative; height: 50px; width: 100px;">
						<DIV ID="a2_txt" STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; clip: rect(0px 100px 50px 0px); z-index: 1;">
						   <TABLE>
							  <TD ID="a2_td" align=center valign=center width=95 height=45 class="inactTD"></TD>
						   </TABLE>
						</DIV>
						<DIV ID="a2_box" STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; clip: rect(0px 100px 50px 0px); z-index: 2;">
						   <TABLE>
							  <TD ID="a2_tdbox" align=center valign=center width=95 height=45 class="boxTD"></TD>
						   </TABLE>
						</DIV>
						<DIV ID="a2_img" STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; z-index: 5;"><A HREF="javascript:void(0);" NAME="a2" onMouseOver="ShowCont('a2',event)" onMouseOut="HideCont('a2',event)"><IMG NAME="a2" SRC="transp.gif" border=0 width=100 height=50></A></DIV>
					 </DIV>
				  </TD>
				  			<TD style="width: 10px;">
			</TD>
				  <!--end cell-->
			   </TR>

			<TR style="height: 50px; width:0px;">
						<TD>
						</TD>
						<TD>
						</TD>
						<TD>
						</TD>
						<TD>
						</TD>			
						<TD style="width: 10px;">
						</TD>
			   </TR>
			   			<TR style="">
						<TD style="">
						</TD>
						<TD>
						</TD>
						<TD>
						</TD>
						<TD>
						</TD>
						<TD style="">
						</TD>
			   </TR>
			   <TR>
			   			<TD style="">
			</TD>
				  <!--cell b0(tag:b0)-->
				  <TD align=center valign=middle>
					 <DIV ID="b0_cont" style="position: relative; height: 50px; width: 100px;">
						<DIV ID="b0_txt" STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; clip: rect(0px 100px 50px 0px); z-index: 1;">
						   <TABLE>
							  <TD ID="b0_td" align=center valign=center width=95 height=45 class="actTD"></TD>
						   </TABLE>
						</DIV>
						<DIV ID="b0_box" STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; clip: rect(0px 100px 50px 0px); z-index: 2;">
						   <TABLE>
							  <TD ID="b0_tdbox" align=center valign=center width=95 height=45 class="boxTD"></TD>
						   </TABLE>
						</DIV>
						<DIV ID="b0_img" STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; z-index: 5;"><A HREF="javascript:void(0);" NAME="b0" onMouseOver="ShowCont('b0',event)" onMouseOut="HideCont('b0',event)"><IMG NAME="b0" SRC="transp.gif" border=0 width=100 height=50></A></DIV>
					 </DIV>
				  </TD>
				  <!--end cell-->
				  <!--cell b1(tag:b1)-->
				  <TD align=center valign=middle style="border: none;">
					 <DIV ID="b1_cont" style="position: relative; height: 50px; width: 100px;">
						<DIV ID="b1_txt" STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; clip: rect(0px 100px 50px 0px); z-index: 1;">
						   <TABLE>
							  <TD ID="b1_td" align=center valign=center width=95 height=45 class="inactTD"></TD>
						   </TABLE>
						</DIV>
						<DIV ID="b1_box" STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; clip: rect(0px 100px 50px 0px); z-index: 2;">
						   <TABLE>
							  <TD ID="b1_tdbox" align=center valign=center width=95 height=45 class="boxTD"></TD>
						   </TABLE>
						</DIV>
						<DIV ID="b1_img" STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; z-index: 5;"><A HREF="javascript:void(0);" NAME="b1" onMouseOver="ShowCont('b1',event)" onMouseOut="HideCont('b1',event)"><IMG NAME="b1" SRC="transp.gif" border=0 width=100 height=50></A></DIV>
					 </DIV>
				  </TD>
				  <!--end cell-->
				  <!--cell b2(tag:b2)-->
				  <TD align=center valign=middle>
					 <DIV ID="b2_cont" style="position: relative; height: 50px; width: 100px;">
						<DIV ID="b2_txt" STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; clip: rect(0px 100px 50px 0px); z-index: 1;">
						   <TABLE>
							  <TD ID="b2_td" align=center valign=center width=95 height=45 class="actTD"></TD>
						   </TABLE>
						</DIV>
						<DIV ID="b2_box" STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; clip: rect(0px 100px 50px 0px); z-index: 2;">
						   <TABLE>
							  <TD ID="b2_tdbox" align=center valign=center width=95 height=45 class="boxTD"></TD>
						   </TABLE>
						</DIV>
						<DIV ID="b2_img" STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; z-index: 5;"><A HREF="javascript:void(0);" NAME="b2" onMouseOver="ShowCont('b2',event)" onMouseOut="HideCont('b2',event)"><IMG NAME="b2" SRC="transp.gif" border=0 width=100 height=50></A></DIV>
					 </DIV>
				  </TD>
				  			<TD style="width: 10px; ">
			</TD>
				  <!--end cell-->
			   </TR>
			   			   	<TR style="height: 0px; width:0px;">
							<TD>
			</TD>
						<TD style="border: none;">
						</TD>
						<TD style="border: none;">
						</TD>
						<TD style="border: none;">
						</TD>
									<TD style="width: 10px;">
			</TD>
			   </TR>
			   	<TR style="border: none; height: 100px; width: 200px;">
						<TD style="border: none;">
						</TD>
						<TD style="border: none;">
						</TD>
						<TD style="border: none;">
						</TD>
			   </TR>

			   
			   <TR style="height: 0px; width: 0px;">
						<TD>
						</TD>
						<TD style="border: none;">
						</TD>
						<TD style="border: none;">
						</TD>
						<TD style="border: none;">
						</TD>
									<TD style="width: 0px;">
			</TD>
			   </TR>




			   <TR style="">
			   			<TD>
						</TD>
				  <!--cell c0(tag:c0)-->
				  <TD align=center valign=middle>
					 <DIV ID="c0_cont" style="position: relative; height: 50px; width: 100px;">
						<DIV ID="c0_txt" STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; clip: rect(0px 100px 50px 0px); z-index: 1;">
						   <TABLE>
							  <TD ID="c0_td" align=center valign=center width=95 height=45 class="actTD"></TD>
						   </TABLE>
						</DIV>
						<DIV ID="c0_box" STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; clip: rect(0px 100px 50px 0px); z-index: 2;">
						   <TABLE>
							  <TD ID="c0_tdbox" align=center valign=center width=95 height=45 class="boxTD"></TD>
						   </TABLE>
						</DIV>
						<DIV ID="c0_img" STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; z-index: 5;"><A HREF="javascript:void(0);" NAME="c0" onMouseOver="ShowCont('c0',event)" onMouseOut="HideCont('c0',event)"><IMG NAME="c0" SRC="transp.gif" border=0 width=100 height=50></A></DIV>
					 </DIV>
				  </TD>
				  <!--end cell-->
				  <!--cell c1(tag:c1)-->
				  <TD align=center valign=middle style="border: none;">
					 <DIV ID="c1_cont" style="position: relative; height: 50px; width: 100px;">
						<DIV ID="c1_txt" STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; clip: rect(0px 100px 50px 0px); z-index: 1;">
						   <TABLE>
							  <TD ID="c1_td" align=center valign=center width=95 height=45 class="inactTD"></TD>
						   </TABLE>
						</DIV>
						<DIV ID="c1_box" STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; clip: rect(0px 100px 50px 0px); z-index: 2;">
						   <TABLE>
							  <TD ID="c1_tdbox" align=center valign=center width=95 height=45 class="boxTD"></TD>
						   </TABLE>
						</DIV>
						<DIV ID="c1_img" STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; z-index: 5;"><A HREF="javascript:void(0);" NAME="c1" onMouseOver="ShowCont('c1',event)" onMouseOut="HideCont('c1',event)"><IMG NAME="c1" SRC="transp.gif" border=0 width=100 height=50></A></DIV>
					 </DIV>
				  </TD>
				  <!--end cell-->
				  <!--cell c2(tag:c2)-->
				  <TD align=center valign=middle>
					 <DIV ID="c2_cont" style="position: relative; height: 50px; width: 100px;">
						<DIV ID="c2_txt" STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; clip: rect(0px 100px 50px 0px); z-index: 1;">
						   <TABLE>
							  <TD ID="c2_td" align=center valign=center width=95 height=45 class="actTD"></TD>
						   </TABLE>
						</DIV>
						<DIV ID="c2_box" STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; clip: rect(0px 100px 50px 0px); z-index: 2;">
						   <TABLE>
							  <TD ID="c2_tdbox" align=center valign=center width=95 height=45 class="boxTD"></TD>
						   </TABLE>
						</DIV>
						<DIV ID="c2_img" STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; z-index: 5;"><A HREF="javascript:void(0);" NAME="c2" onMouseOver="ShowCont('c2',event)" onMouseOut="HideCont('c2',event)"><IMG NAME="c2" SRC="transp.gif" border=0 width=100 height=50></A></DIV>
					 </DIV>
				  </TD>
				  <!--end cell-->
				  
				  			<TD style="width: 10px;">
			</TD>
			
			   </TR>
			   <TR style="height: 0px; width: 0px;">
							<TD>
			</TD>
						<TD style="border: none;">
						</TD>
						<TD style="border: none;">
							</TD>
						<TD style="border: none;">
						</TD>
									<TD style="width: 10px;">
			</TD>
			   </TR>
			   
			   
			   
			   
			<TR style="border: none; height: 0px; width: 0px;">
						<TD style="border: none;">
						</TD>
						<TD style="border: none;">
						</TD>
						<TD style="border: none;">
						</TD>
						
			   </TR>
            <TR>
				<TD>
				</TD>
               <TD ID="btn_0" style="border-left-style: none; border-right-style: none; border-bottom-style: none;" align=center class='style1' ><INPUT type="button" name="btn1" value="11" onMouseOver="timefunction('mouseover','btn1','11')" onClick="recChoice('onclick','btn1','11')" onMouseOut="timefunction('mouseout','btn1','11')"></TD>
               <TD ID="btn_1" style="border: none;"> </TD>
			   <TD ID="btn_2" style="border-left-style: none; border-right-style: none; border-bottom-style: none;" align=center ><INPUT type="button" name="btn2" value="22" onMouseOver="timefunction('mouseover','btn2','22')" onClick="recChoice('onclick','btn2','22')" onMouseOut="timefunction('mouseout','btn2','22')"></TD>
			
			<TD style="width: 10px;">
			</TD>
			</TR>
			 
			 
			 
			 <TR style="border: none;">
			 			<TD>
			</TD>
			<TD align=center style="border: none;"> <img src="transp.gif" style="width:50px;height:50px"> </TD>
             </TR>
         </TABLE>
      </div>
      <div id="startupdiv" style="margin-right:10px; position: absolute; left: 0px; top 0px; padding-top: <? echo $pracpad; ?>px; width: 700px; height: 500px; visibility: <?php echo($visStart); ?>; text-align: center; z-index: 10; background: #E3E9F1;">
         <p><?php if($round == 0){echo 'This next round is for <b>PRACTICE</b>. ';}?>Click on the cross when you are ready to proceed.<BR /> <BR> <BR> 
		 <INPUT type="button" value="+" size=1 style="margin-right:10px; margin-top:50px;" onClick="timefunction('startup','start','start');document.getElementById('startupdiv').style.visibility='hidden';document.getElementById('mlwtable').style.visibility='visible';" ></p>
      </div>
   </div>
   <div id="subm_button" style="margin-right:10px; position: absolute; left: 0px; top 0px; padding-top: <? echo $pad; ?>px; width: 700px; height: 500px; visibility: hidden; text-align: center; z-index: 10; background: #E3E9F1;">
      <p><?php if ($round == 0) {echo'This next round is for the <b>ACTUAL TASK</b>. Click on the cross to proceed. <BR> <BR> <BR>';} else if($round > 0) {echo 'Click on the cross to proceed <BR> <BR> <BR> <BR>';} ?> <BR /> 
	 <INPUT type="submit" style="margin-right:10px; margin-top:50px;" value=<?php if ($_SESSION['round'] > 200) {echo"Rate";} else {echo "+";}?> size=1 onClick=timefunction('submit','submit','submit') >
	  </p>
      <BR />
   </div>
   </div>
</FORM>
</body>
</html>