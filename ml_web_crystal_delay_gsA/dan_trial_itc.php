<?php 
if (isset($_GET['subject'])) {$subject=$_GET['subject'];}
 else {$subject="anonymous";}
if (isset($_GET['condnum'])) {$condnum=$_GET['condnum'];}
	else {$condnum=-1;}?><HTML>
<HEAD>
<TITLE>MouselabWEB Survey</TITLE>
<script language=javascript src="mlweb.js"></SCRIPT>
<link rel="stylesheet" href="mlweb.css" type="text/css">
</head>

<body onLoad="timefunction('onload','body','body')">
<script language="javascript">
ref_cur_hit = <?php echo($condnum);?>;
subject = "<?php echo($subject);?>";
</script>

<!--BEGIN TABLE STRUCTURE-->
<SCRIPT language="javascript">
//override defaults
mlweb_outtype="CSV";
mlweb_fname="mlwebform";
tag = "a0^a1^a2`"
 + "b0^b1^b2`"
 + "c0^c1^c2";

txt = "^^`"
 + "^^`"
 + "^^";

state = "0^0^0`"
 + "1^0^1`"
 + "1^0^1";

box = "^^`"
 + "^^`"
 + "^^";

CBCol = "0^0^0";
CBRow = "0^0^0";
W_Col = "100^100^100";
H_Row = "50^50^50";

chkchoice = false;
btnFlg = 1;
btnType = "radio";
btntxt = "^^";
btnstate = "1^0^1";
btntag = "btn1^btn2^btn3";
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

//Delay: b0 b2 c0 c2
delay = "0^0^0^0`"
 + "0^0^0^0`"
 + "0^0^0^0`"
 + "0^0^0^0";
activeClass = "actTD";
inactiveClass = "inactTD";
boxClass = "boxTD";
cssname = "mlweb.css";
nextURL = "thanks.html";
expname = "dan_trial_itc";
randomOrder = false;
recOpenCells = false;
masterCond = 1;
loadMatrices();
</SCRIPT>
<!--END TABLE STRUCTURE-->

<FORM name="mlwebform" onSubmit="return checkForm(this)" method="POST" action="save.php"><INPUT type=hidden name="procdata" value="">
<input type=hidden name="subject" value="">
<input type=hidden name="expname" value="">
<input type=hidden name="nextURL" value="">
<input type=hidden name="choice" value="">
<input type=hidden name="condnum" value="">
<input type=hidden name="to_email" value="">
<!--BEGIN preHTML-->

<!--END preHTML-->
<!-- MOUSELAB TABLE -->
<TABLE border=1>
   <TR>
      <!--cell a0(tag:a0)-->
      <TD align=center valign=middle>
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
      <TD align=center valign=middle>
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
      <!--end cell-->
   </TR>
   <TR>
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
      <TD align=center valign=middle>
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
      <!--end cell-->
   </TR>
   <TR>
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
      <TD align=center valign=middle>
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
   </TR>
   <TR>
      <TD ID="btn_0" style="border-left-style: none; border-right-style: none; border-bottom-style: none;" align=center valign=middle><INPUT type="radio" name="mlchoice" value="btn1" onMouseOver="timefunction('mouseover','btn1','')" onClick="recChoice('onclick','btn1','')" onMouseOut="timefunction('mouseout','btn1','')"></TD>
      <TD ID="btn_1" style="border-left-style: none; border-right-style: none; border-bottom-style: none;"> </TD>
      <TD ID="btn_2" style="border-left-style: none; border-right-style: none; border-bottom-style: none;" align=center valign=middle><INPUT type="radio" name="mlchoice" value="btn3" onMouseOver="timefunction('mouseover','btn3','')" onClick="recChoice('onclick','btn3','')" onMouseOut="timefunction('mouseout','btn3','')"></TD>
   </TR>
</TABLE>
<!-- END MOUSELAB TABLE -->
<!--BEGIN postHTML-->

<!--END postHTML--><INPUT type="submit" value="Next Page" onClick=timefunction('submit','submit','submit')></FORM></body></html>
