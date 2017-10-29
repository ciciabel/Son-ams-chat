<!DOCTYPE html>
<html>
<head>
	<title>SON's AMS</title>
	<script type="text/javascript" src = "scripts/script.js"></script>
	<?php include 'clock.php'; 
//echo "File Get Contents - Goog";
//echo file_get_contents("http://www.google.com");

	?>
</head>
<body bgcolor="ffffcc" height = "500" width = "500">
<p></p>
<p></p>
<div align="center">
<img src="images/son.png">

<table> <tr><td colspan="2"><p></p></td></tr></table>
<div style = "width:390px; border: solid 1px #0e9a55; " align = "center">
            <div style = "background-color:#0e9a55; color:#FFFFFF; padding:3px;" align="center"><b >SON - AMS</b></div>
				
            <div style = "margin:30px">

<table bgcolor="" height = "300" width="300"> 
 
	<tr>
		<td>Date: <?php echo $d = date('Y-m-d'); ?></td>
		<td>Time: <?php 	echo $t = display_time();	;
		?></td>
	</tr>
	<tr>
		<td colspan="2" align="center" bgcolor="#0e9a55">  <hr>
	<a href="javascript:Password_();" style="color: white; text-decoration: none"><strong>Admin</strong> </a>
		  <hr> </td>
	</tr>
	<tr>
		<td  colspan="2" height=75 align="center"> <p></p> </td>
	</tr>
	<tr>
		<td colspan="2" align="center" bgcolor="#0e9a55"> <hr> <a href="Login.php" style="color: white; text-decoration: none"><strong>Login</strong> </a>  <hr></td>
	</tr>
	
</table>
</div>
</div>
 
</div>  
</body>
</html>