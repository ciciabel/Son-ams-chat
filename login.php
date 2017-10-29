<!DOCTYPE html>
<html>
<head>
	<title>AMS-Login</title>
	<?php 
		require "phpfunc/config1.php";
	include ('clock.php');


	$d = date('Y-m-d');
	date_default_timezone_set("Africa/Lagos");
	$t = date('h:i:s');
 		 
?>
	<script type="text/javascript" src = "script.js">	</script>
	<style type="text/css">
 			  body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
            color: #0e9a55;
         }
         
         .box {
            border:#666666 solid 1px;
         }
	</style>
</head>
<body bgcolor="ffffcc">



<div align="center">
<img src="images/son.png">
<p></p>
 
    <div style = "width:390px; border: solid 1px #0e9a55; " align = "left">
            <div style = "background-color:#0e9a55; color:#FFFFFF; padding:3px;"><b>Login</b></div>
				
            <div style = "margin:30px">
<form name="myform" method="POST" action="processlog.php" >

<table border="0" width="250" height = "250">
		<tr>
		<td > <?php echo "Date:".$d; ?></td>
		<td align="center">Time: <?php echo display_time(); ?></td>
	</tr>
		<tr>
			<td align="right"> <label>Username: </label></td>
			<td >   <input type="text" name="uname" /><br /></td>
		</tr>
		<tr>
			<td align="right"><label>Password:  </label></td>
			<td><input type="password" name="uword" /><br /></td>
		</tr>
		<tr>
			<td colspan="" align="center"> <input  type="submit" id="login" value="Log In" onclick="" style="cursor: pointer; background-color: #0e9a55; color: white; border: none; " /></td>
			 
			 
			<td align="right"> <a href="index.php" style="text-decoration: none; color: red">Home</a></td>
		</tr>
	
</table>

   </form>
  
					
            </div>
				
         </div>
			
      </div>
   
</div>

 </body>
</html>