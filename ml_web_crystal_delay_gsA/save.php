<?php
// 		save.php: saves MouselabWEB data in database
//
//       v 1.00betav2 , 14 Aug 2008    
//		updated version v2 using real_escape_string functions to escape quotes 
//		before loading into the database
//
//     (c) 2003-2008 Martijn C. Willemsen and Eric J. Johnson 
//
//    This program is free software; you can redistribute it and/or modify
//    it under the terms of the GNU General Public License as published by
//    the Free Software Foundation; either version 2 of the License, or
//    (at your option) any later version.
//
//    This program is distributed in the hope that it will be useful,
//    but WITHOUT ANY WARRANTY; without even the implied warranty of
//    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//    GNU General Public License for more details.
//
//    You should have received a copy of the GNU General Public License
//    along with this program; if not, write to the Free Software
//    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
session_start();

include('mlwebdb.inc.php');

/* Redirect to a different page in the current directory that was requested */
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');


if ($_POST) {
	// increase the rounds in session
	// this allows the user to hit the back button or refresh without breaking
	$_SESSION['round'] = $_SESSION['round'] + 1;
	
	$expname = "";
	$subject = "";
	$condnum = "";
	$choice = "";
	$procdata = "";
	$nextURL = "";
	$addvar = "";
	$adddata = "";

	foreach ($_POST as $key => $value) { 
		 switch ($key) {
				case "expname":
					$expname = $value;
					break;
				case "subject":
					$subject = $value;
					break;
				case "condnum":
					$condnum= $value;
					break;
				case "choice":
					$choice= $value;
					break;
				case "procdata":
					$procdata= mysql_real_escape_string($value);
					break;
				case "nextURL":
					$nextURL= $value;
					break;
				case "to_email":
					// ignore emailaddress 
					break;
				default:
				$addvar .= mysql_real_escape_string($key).";";
				$adddata .= "\"".mysql_real_escape_string($value)."\";" ; 
				}
		}
		
	if(!isset($subject)) {
		$subject = $_SESSION['subject'];
	}
	
	// save the expname which will be used in the sve salience script
	$_SESSION['expname'] = $expname;
	$_SESSION['subject'] = $subject;
	
	
	$ipstr = $_SERVER['REMOTE_ADDR'];

	$sqlquery = "select MAX(id) from $table";
	$result = mysql_query($sqlquery);

	$id = mysql_result($result,0);

	if (is_null($id)) $id=0; else $id++; 



	$sqlquery = "INSERT INTO $table (id, expname, subject, ip, condnum, choice, submitted, procdata, addvar, adddata) VALUES ($id,'$expname','$subject','$ipstr', $condnum,'$choice',NOW(),'$procdata', '$addvar', '$adddata')";
	$result = mysql_query($sqlquery);
	mysql_close();
	

	header("Location: https://$host$uri/$nextURL?subject=$subject&condnum=$condnum");
    exit;
} else {
	header("Location: https://$host$uri". $_SERVER['REQUEST_URI'], true, 303);
	
	exit;
}


?>