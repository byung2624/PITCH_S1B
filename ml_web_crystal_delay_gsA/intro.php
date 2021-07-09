<?
session_start();
unset($_SESSION['round']);
if (isset($_GET['subject'])) {$subject=$_GET['subject'];}
 else {$subject="anonymous";}
if (isset($_GET['condnum'])) {$condnum=$_GET['condnum'];}
	else {$condnum=-1;} 
	
	$pos1 = "Professor";
	$pos2 = "Professor";
	$pos3 = "Course";
	$pos4 = "Course";
	
	
	
?>

<HTML>
<HEAD>
<TITLE>Practice</TITLE>
<script language=javascript src="mlweb.js">

</SCRIPT>
<link rel="stylesheet" href="mlweb.css" type="text/css">


</head>

<body onLoad="timefunction('onload','body','body')">
<script language="javascript">
ref_cur_hit = <?echo($condnum);?>;
subject = "<?echo($subject);?>";
</script>

<!--BEGIN TABLE STRUCTURE-->
<SCRIPT language="javascript">
//override defaults
mlweb_outtype="CSV";
mlweb_fname="mlwebform";
tag = "c0^c1`"
 + "a0^a1`"
 + "t0^t1";

txt = "Choice 1^Choice 2`"
 + "Marx^Smith`"
 + "Spanish^Philosophy";

state = "0^0`"
 + "1^1`"
 + "1^1";

box = "^`"
 + "<?php echo($pos1);?>^<?php echo($pos2);?>`"
 + "<?php echo($pos3);?>^<?php echo($pos4);?>";

CBCol = "0^0";
CBRow = "0^0^0";
W_Col = "200^200";
H_Row = "100^100^100";

chkchoice = "nobuttons";
btnFlg = 0;
btnType = "radio";
btntxt = "";
btnstate = "";
btntag = "";
to_email = "";
colFix = undefined;
rowFix = undefined;
CBpreset = undefined;
evtOpen = 0;
evtClose = 0;
chkFrm=true;
warningTxt = "Your answer is incorrect.";
tmTotalSec = NaN;
tmStepSec = NaN;
tmWidthPx = NaN;
tmFill = false;
tmShowTime = false;
tmCurTime = 0;
tmActive = false;
tmDirectStart = false;
tmMinLabel = "undefined";
tmSecLabel = "undefined";
tmLabel = "undefined";

//Delay: a0 a1 t0 t1
delay = "0^0^0^0`"
 + "0^0^0^0`"
 + "0^0^0^0`"
 + "0^0^0^0";
activeClass = "actTD";
inactiveClass = "inactTD";
boxClass = "boxTD";
cssname = "mlweb.css";
nextURL = "good.html";
expname = "intro";
randomOrder = false;
recOpenCells = false;
masterCond = 1;
loadMatrices();
</SCRIPT>
<!--END TABLE STRUCTURE-->

<script type="text/javascript">

function checkform2()
{
	if(document.getElementById('Philosophy').checked == true) {
	  return true;
	}else {
	alert("Your answer is incorrect.");
	  return false;
	}
}
		
</script>


<FORM name="mlwebform" onSubmit="return checkForm2();" method="POST" action="save.php"><INPUT type=hidden name="procdata" value="">
<input type=hidden name="subject" value="">
<input type=hidden name="expname" value="">
<input type=hidden name="nextURL" value="">
<input type=hidden name="choice" value="">
<input type=hidden name="condnum" value="">
<input type=hidden name="to_email" value="">
<!--BEGIN preHTML-->

<head>
<style type="text/css">
p.margin
{
margin:20px 25px;
}
</style>
</head>

<P class="margin"></P>
<H2 align="center">Introduction: Practice with boxes</H2>
<P class="margin">In this questionnaire, you will be asked to make choices between several alternatives.</P>
<P class="margin">The attributes of these choices will be hidden behind boxes. You can look at the attributes by moving the mouse pointer into the box. The box will open and you can see the information, until you move the mouse out of the box again.</P>
<P class="margin">The practice task below is designed to help you become familiar with moving the mouse over and out of the boxes. 
Behind the boxes, you will find some information. In this practice task, 
you will see two courses, taught by different professors. Look at 
the information in the boxes and answer the question below. In the actual task, the content behind the boxes will be different.
</P>




<!--END preHTML-->
<!-- MOUSELAB TABLE -->
<div style="position: relative">
<div id="mlwtable" style="position: absolute; left: 50px; top 80px; visbility: <?php echo($visMLW)?>;">
<TABLE border=1 align="center">

<TR>
<!--cell a0(tag:c0)-->
<TD align=center valign=middle <? echo "class='style1'"; ?>><DIV ID="a0_cont" style="position: relative; height: 50px; width: 100px;"><DIV ID="a0_txt" STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; clip: rect(0px 100px 50px 0px); z-index: 1;"><TABLE><TD ID="a0_td" align=center valign=center width=95 height=45 class="inactTD">Choice 1</TD></TABLE></DIV><DIV ID="a0_box" STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; clip: rect(0px 100px 50px 0px); z-index: 2;"><TABLE><TD ID="a0_tdbox" align=center valign=center width=95 height=45 class="boxTD"></TD></TABLE></DIV><DIV ID="a0_img" STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; z-index: 5;"><A HREF="javascript:void(0);" NAME="a0" onMouseOver="ShowCont('a0',event)" onMouseOut="HideCont('a0',event)"><IMG NAME="a0" SRC="transp.gif" border=0 width=100 height=50></A></DIV></DIV></TD>
<!--end cell-->
<!--cell a1(tag:c1)-->
<TD align=center valign=middle  <? echo "class='style1'"; ?>><DIV ID="a1_cont" style="position: relative; height: 50px; width: 100px;"><DIV ID="a1_txt" STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; clip: rect(0px 100px 50px 0px); z-index: 1;"><TABLE><TD ID="a1_td" align=center valign=center width=95 height=45 class="inactTD">Choice 2</TD></TABLE></DIV><DIV ID="a1_box" STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; clip: rect(0px 100px 50px 0px); z-index: 2;"><TABLE><TD ID="a1_tdbox" align=center valign=center width=95 height=45 class="boxTD"></TD></TABLE></DIV><DIV ID="a1_img" STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; z-index: 5;"><A HREF="javascript:void(0);" NAME="a1" onMouseOver="ShowCont('a1',event)" onMouseOut="HideCont('a1',event)"><IMG NAME="a1" SRC="transp.gif" border=0 width=100 height=50></A></DIV></DIV></TD>
<!--end cell--></TR>

<TR>
<!--cell b0(tag:a0)-->
<TD align=center valign=middle style="padding: 5px;"><DIV ID="b0_cont" style="position: relative; height: 50px; width: 100px;"><DIV ID="b0_txt" STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; clip: rect(0px 100px 50px 0px); z-index: 1;"><TABLE><TD ID="b0_td" align=center valign=center width=95 height=45 class="actTD">Professor</TD></TABLE></DIV><DIV ID="b0_box" STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; clip: rect(0px 100px 50px 0px); z-index: 2;"><TABLE><TD ID="b0_tdbox" align=center valign=center width=95 height=45 class="boxTD">$100</TD></TABLE></DIV><DIV ID="b0_img" STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; z-index: 5;"><A HREF="javascript:void(0);" NAME="b0" onMouseOver="ShowCont('b0',event)" onMouseOut="HideCont('b0',event)"><IMG NAME="b0" SRC="transp.gif" border=0 width=100 height=50></A></DIV></DIV></TD>
<!--end cell-->
<!--cell b1(tag:a1)-->
<TD align=center valign=middle style="padding: 5px;"><DIV ID="b1_cont" style="position: relative; height: 50px; width: 100px;"><DIV ID="b1_txt" STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; clip: rect(0px 100px 50px 0px); z-index: 1;"><TABLE><TD ID="b1_td" align=center valign=center width=95 height=45 class="actTD">Professor</TD></TABLE></DIV><DIV ID="b1_box" STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; clip: rect(0px 100px 50px 0px); z-index: 2;"><TABLE><TD ID="b1_tdbox" align=center valign=center width=95 height=45 class="boxTD">$200</TD></TABLE></DIV><DIV ID="b1_img" STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; z-index: 5;"><A HREF="javascript:void(0);" NAME="b1" onMouseOver="ShowCont('b1',event)" onMouseOut="HideCont('b1',event)"><IMG NAME="b1" SRC="transp.gif" border=0 width=100 height=50></A></DIV></DIV></TD>
<!--end cell--></TR>

<TR>
<!--cell c0(tag:t0)-->
<TD align=center valign=middle style="padding: 5px;"><DIV ID="c0_cont" style="position: relative; height: 50px; width: 100px;"><DIV ID="c0_txt" STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; clip: rect(0px 100px 50px 0px); z-index: 1;"><TABLE><TD ID="c0_td" align=center valign=center width=95 height=45 class="actTD">Course</TD></TABLE></DIV><DIV ID="c0_box" STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; clip: rect(0px 100px 50px 0px); z-index: 2;"><TABLE><TD ID="c0_tdbox" align=center valign=center width=95 height=45 class="boxTD">Now</TD></TABLE></DIV><DIV ID="c0_img" STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; z-index: 5;"><A HREF="javascript:void(0);" NAME="c0" onMouseOver="ShowCont('c0',event)" onMouseOut="HideCont('c0',event)"><IMG NAME="c0" SRC="transp.gif" border=0 width=100 height=50></A></DIV></DIV></TD>
<!--end cell-->
<!--cell c1(tag:t1)-->
<TD align=center valign=middle style="padding: 5px;"><DIV ID="c1_cont" style="position: relative; height: 50px; width: 100px;"><DIV ID="c1_txt" STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; clip: rect(0px 100px 50px 0px); z-index: 1;"><TABLE><TD ID="c1_td" align=center valign=center width=95 height=45 class="actTD">Course</TD></TABLE></DIV><DIV ID="c1_box" STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; clip: rect(0px 100px 50px 0px); z-index: 2;"><TABLE><TD ID="c1_tdbox" align=center valign=center width=95 height=45 class="boxTD">2 Months</TD></TABLE></DIV><DIV ID="c1_img" STYLE="position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; z-index: 5;"><A HREF="javascript:void(0);" NAME="c1" onMouseOver="ShowCont('c1',event)" onMouseOut="HideCont('c1',event)"><IMG NAME="c1" SRC="transp.gif" border=0 width=100 height=50></A></DIV></DIV></TD>
<!--end cell--></TR>

</TABLE>
</div>



<!-- END MOUSELAB TABLE -->

<!--BEGIN postHTML-->

<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
<P class="margin">What class does Professor Smith teach?</P>
<!-- Begin HTML Choice: name=course-->
<P class="margin">

<TABLE><TR><td align=center>
	<INPUT TYPE=RADIO NAME='course' ID="Spanish" VALUE='Spanish'></td><TD align=left>Spanish</TD></TR><TR><td align=center>
	<INPUT TYPE=RADIO NAME='course' ID="Marketing" VALUE='Marketing'></td><TD align=left>Marketing</TD></TR><TR><td align=center>
	<INPUT TYPE=RADIO NAME='course' ID="Philosophy" VALUE='Philosophy'></td><TD align=left>Philosophy</TD></TR>
</TABLE>

<!-- End HTML Choice: name=course-->
<br/>
<!--END postHTML-->
<INPUT type="submit" value="Next Page" onClick="return checkform2(); timefunction('onload','body','body');"><span id="error" style="display:none;"></span>

</FORM></body></html>
</P>

