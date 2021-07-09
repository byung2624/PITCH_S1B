<?php
// Here is where the participant will answer questions about the spend of the ITCs
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

// get the values of the ITC
$row_array = $_SESSION['row_array'];

// assign the values to the proper variables
$colhead_left = $row_array['colhead_left'];
$colhead_right = $row_array['colhead_right'];
$btntxt1 = $row_array['btntxt1'];
$btntxt2 = $row_array['btntxt2'];
$btntag1 = $row_array['btntag1'];
$btntag2 = $row_array['btntag2'];
$box_pos_1 = $row_array['box_pos_1'];
$box_pos_2 = $row_array['box_pos_2'];
$box_pos_3 = $row_array['box_pos_3'];
$box_pos_4 = $row_array['box_pos_4'];
$text_pos_1 = $row_array['text_pos_1'];
$text_pos_2 = $row_array['text_pos_2'];
$text_pos_3 = $row_array['text_pos_3'];
$text_pos_4 = $row_array['text_pos_4'];

?>

<HTML>
<HEAD>
	<TITLE>Survey</TITLE>
	<script language=javascript src="mlweb.js"></SCRIPT>
	<link rel="stylesheet" href="mlweb.css" type="text/css">
	<style type="text/css">
	.style1 {
		border-width: 1px;
		background-color: #00FFFF;
	}
	#footer {
		position: relative;
		clear: both;
		text-align: center;
	}
	</style>
</head>
	<body>
	
	
<script language="javascript">
ref_cur_hit = <?php echo($condnum);?>;
subject = "<?php echo($subject);?>";
</script>

<!--BEGIN TABLE STRUCTURE-->


	<div style="position: relative">
      <div id="mlwtable" style="position: absolute; left: 50px; top 80px; visibility: visible;">
         <TABLE border=1 align="center">
			   	<TR  style="height: 100px; width: 200px;">
						<TD class="style1">
							 <DIV ID="c0_cont" style="position: relative; height: 100px; width: 200px;">
								<DIV ID="c0_txt" STYLE="position: absolute; left: 0px; top: 0px; height: 100px; width: 200px; z-index: 1;">
									<?php echo $colhead_left; ?>
								</DIV>
							</DIV>
						</TD>
						
						<TD style="border: none; height: 100px; width: 200px;">
						</TD>
						
						<TD >
							 <DIV ID="c0_cont" style="position: relative; height: 100px; width: 200px;">
								<DIV ID="c0_txt" STYLE="position: absolute; left: 0px; top: 0px; height: 100px; width: 200px; z-index: 1;">
									<?php echo $colhead_right; ?>
								</DIV>
							</DIV>
						</TD>
			   </TR>
			   <TR  style="height: 100px; width: 200px;">
						<TD >
							 <DIV ID="c0_cont" style="position: relative; height: 100px; width: 200px;">
								<DIV ID="c0_txt" STYLE="position: absolute; left: 50%; top: 50%; height: 100px; width: 200px; z-index: 1;">
									<?php echo $text_pos_1; ?>
								</DIV>
							</DIV>
						</TD>
						
						<TD style="border: none;">
						</TD>
						<TD>
							<DIV ID="c0_cont" style="position: relative; height: 100px; width: 200px;">
								<DIV ID="c0_txt" STYLE="position: absolute; left: 50%; top: 50%; height: 100px; width: 200px; z-index: 1;">
									<?php echo $text_pos_2; ?>
								</DIV>
							</DIV>
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
			   
			   <TR  style="height: 100px; width: 200px;">
						<TD>
							 <DIV ID="c0_cont" style="position: relative; height: 100px; width: 200px;">
								<DIV ID="c0_txt" STYLE="position: absolute; left: 50%; top: 50%; height: 100px; width: 200px; z-index: 1;">
									<?php echo $text_pos_3; ?>
								</DIV>
							</DIV>
						</TD>
						
						<TD style="border: none; height: 100px; width: 200px;">
						</TD>
						
						<TD>
							 <DIV ID="c0_cont" style="position: relative; height: 100px; width: 200px;">
								<DIV ID="c0_txt" STYLE="position: absolute; left: 50%; top: 50%; height: 100px; width: 200px; z-index: 1;">
									<?php echo $text_pos_4; ?>
								</DIV>
							</DIV>
						</TD>
			   </TR>

			<TR>   
			   <TD ID="btn_0" style="border-left-style: none; border-right-style: none; border-bottom-style: none;" align=center class='style1' ><INPUT type="button" name="btn1" value="STAY" onMouseOver="timefunction('mouseover','btn1','11')" onClick="recChoice('onclick','btn1','11')" onMouseOut="timefunction('mouseout','btn1','11')"></TD>
               <TD ID="btn_1" style="border: none;"> </TD>
			   <TD ID="btn_2" style="border-left-style: none; border-right-style: none; border-bottom-style: none;" align=center ><INPUT type="button" name="btn2" value="SWITCH" onMouseOver="timefunction('mouseover','btn2','22')" onClick="recChoice('onclick','btn2','22')" onMouseOut="timefunction('mouseout','btn2','22')"></TD>
            </TR>
			 <TR style="border: none;">
               <TD align=center style="border: none;"> <img src="green_triangle.png" style="width:50px;height:50px"> </TD>
             </TR>
         </TABLE>
      </div>
	 </div>
	 
	 	 <div style="position: absolute; top: 550px; left: 50px;">
		<FORM action="save_salience.php" method="POST">
		<TABLE width=100%>
			<TR> For which option was it easier to imagine what you would spend the money on? <TR>
		   <TR>
			  <TD width=14% align=center>1</TD>
			  <TD width=14% align=center>2</TD>
			  <TD width=14% align=center>3</TD>
			  <TD width=14% align=center>4</TD>
			  <TD width=14% align=center>5</TD>
			  <TD width=14% align=center>6</TD>
			  <TD width=14% align=center>7</TD>
		   </TR>
		   <TR>
			  <td width=14% align=center><INPUT TYPE=RADIO NAME='spend' VALUE='1'></td>
			  <td width=14% align=center><INPUT TYPE=RADIO NAME='spend' VALUE='2'></td>
			  <td width=14% align=center><INPUT TYPE=RADIO NAME='spend' VALUE='3'></td>
			  <td width=14% align=center><INPUT TYPE=RADIO NAME='spend' VALUE='4'></td>
			  <td width=14% align=center><INPUT TYPE=RADIO NAME='spend' VALUE='5'></td>
			  <td width=14% align=center><INPUT TYPE=RADIO NAME='spend' VALUE='6'></td>
			  <td width=14% align=center><INPUT TYPE=RADIO NAME='spend' VALUE='7'></td>
		   </TR>
		   <TR>
			  <td width=14% align=center>Definitely<BR>Left</td>
			  <td width=14% align=center></td>
			  <td width=14% align=center></td>
			  <td width=14% align=center>Neither</td>
			  <td width=14% align=center></td>
			  <td width=14% align=center></td>
			  <td width=14% align=center>Definitely<BR>Right</td>
		   </TR>
		</TABLE>
		
		
		<TABLE width=100%>
			<TR> When you considered each option, which seemed the most vivid to you? <TR>
		   <TR>
			  <TD width=14% align=center>1</TD>
			  <TD width=14% align=center>2</TD>
			  <TD width=14% align=center>3</TD>
			  <TD width=14% align=center>4</TD>
			  <TD width=14% align=center>5</TD>
			  <TD width=14% align=center>6</TD>
			  <TD width=14% align=center>7</TD>
		   </TR>
		   <TR>
			  <td width=14% align=center><INPUT TYPE=RADIO NAME='vivid' VALUE='1'></td>
			  <td width=14% align=center><INPUT TYPE=RADIO NAME='vivid' VALUE='2'></td>
			  <td width=14% align=center><INPUT TYPE=RADIO NAME='vivid' VALUE='3'></td>
			  <td width=14% align=center><INPUT TYPE=RADIO NAME='vivid' VALUE='4'></td>
			  <td width=14% align=center><INPUT TYPE=RADIO NAME='vivid' VALUE='5'></td>
			  <td width=14% align=center><INPUT TYPE=RADIO NAME='vivid' VALUE='6'></td>
			  <td width=14% align=center><INPUT TYPE=RADIO NAME='vivid' VALUE='7'></td>
		   </TR>
		   <TR>
			  <td width=14% align=center>Definitely<BR>Left</td>
			  <td width=14% align=center></td>
			  <td width=14% align=center></td>
			  <td width=14% align=center>Neither</td>
			  <td width=14% align=center></td>
			  <td width=14% align=center></td>
			  <td width=14% align=center>Definitely<BR>Right</td>
		   </TR>
		</TABLE>
		
		<TABLE width=100%>
			<TR>  For which option do you have a more concrete plan for what you would do with the money?  <TR>
		   <TR>
			  <TD width=14% align=center>1</TD>
			  <TD width=14% align=center>2</TD>
			  <TD width=14% align=center>3</TD>
			  <TD width=14% align=center>4</TD>
			  <TD width=14% align=center>5</TD>
			  <TD width=14% align=center>6</TD>
			  <TD width=14% align=center>7</TD>
		   </TR>
		   <TR>
			  <td width=14% align=center><INPUT TYPE=RADIO NAME='concrete' VALUE='1'></td>
			  <td width=14% align=center><INPUT TYPE=RADIO NAME='concrete' VALUE='2'></td>
			  <td width=14% align=center><INPUT TYPE=RADIO NAME='concrete' VALUE='3'></td>
			  <td width=14% align=center><INPUT TYPE=RADIO NAME='concrete' VALUE='4'></td>
			  <td width=14% align=center><INPUT TYPE=RADIO NAME='concrete' VALUE='5'></td>
			  <td width=14% align=center><INPUT TYPE=RADIO NAME='concrete' VALUE='6'></td>
			  <td width=14% align=center><INPUT TYPE=RADIO NAME='concrete' VALUE='7'></td>
		   </TR>
		   <TR>
			  <td width=14% align=center>Definitely<BR>Left</td>
			  <td width=14% align=center></td>
			  <td width=14% align=center></td>
			  <td width=14% align=center>Neither</td>
			  <td width=14% align=center></td>
			  <td width=14% align=center></td>
			  <td width=14% align=center>Definitely<BR>Right</td>
		   </TR>
		</TABLE>
		
		<p style="text-align: center;">
		  <input type="submit" value="Submit" align="middle"/>
		</p>
		</form>
	</div>
	</body>
</HTML>	 