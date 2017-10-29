<!DOCTYPE html>
<html>
<head>
  <title>SONAMS Profile</title>
    <link rel="stylesheet" type="text/css" href="styles/chatstyles.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"> 
    <script src="bootstrap/js/bootstrap.min.js"></script>    
    <script type="text/javascript" src="scripts/jquery.min.js"></script>
  <script  src = "scripts/chatscript.js"></script>
  <script type="text/javascript" src="/socket.io/socket.io.js"></script>  
  <script src="scripts/socket.io.js"></script>
</head>

<?php 
header("Cache-Control: no-cache, must-revalidate" );
session_cache_limiter('private_no_expire');
  session_start() ; 
require "phpfunc/config1.php";
  include "clock.php";
include "phpfunc/functions.php";
    //variable declarations   
    $tt = timeliness();
   
  //begin login process
   

 if (isset($_POST['uname']) AND isset ($_POST['uword'])) {

    $username =$_POST['uname']; 
    $password = $_POST['uword'];

    //search if user exists

    $pst = "SELECT * FROM profiles WHERE userName = '$username' AND passWord = '$password'";
    $rs = mysqli_query($con, $pst) or die(mysqli_error($con));

       $row = mysqli_fetch_assoc($rs);

        $id         = $_SESSION['ID']             = $row['ID'];         
         $surname   = $_SESSION['SURNAME']        = $row['Surname'];     
         $category  = $_SESSION['CATEGORY']       = $row['Category'];    
         $deparment = $_SESSION['DEPARTMENT']     = $row['Department']; 
         $sn        =  $_SESSION['S/N']           = $row['S/N'];

    $count = mysqli_num_rows($rs);    
    if ($count == 1) { // if found

  //check if user has logged in today
      $pst1 = "SELECT * FROM attendance WHERE ID = '$id' AND DATE_ = '$d'";
      $rs1 = mysqli_query($con, $pst1);
      $count1 = mysqli_num_rows($rs1);     
      if ($count1 == 1) {
      
      $row1 = mysqli_fetch_assoc($rs1);
      $timein = $row1['TimeIn'];      
    
 //if user has signed in already, display this
      $pstLO = mysqli_query($con, "UPDATE attendance SET TimeOut = '00:00:00' WHERE ID = '$id' AND Date_ = '$d'");
        echo "<script type='text/javascript'>alert('$surname, You signed in at  $timein') 
             </script>";
     
      }
      else{
        //do this if user hasnt signed in

        //$pst2 = "INSERT INTO attendance (_ID, _Picture, Surname, Category, Department, Date_, Time_, Punctuality) VALUES ('$id', '$picture', '$surname', '$category', '$deparment', '$d', '$t', '$tt') ";

          // $rs2 = mysqli_query($con, $pst2);

        // the above query isnt working at once, so divide it into 2, 3 queries ie 

        //- insert into attendnace first 5 colunms, 

        //-select the 5 columns to be inserted from staffdata      

        $pst3 = "INSERT INTO attendance (ID, Surname, Category, Department) SELECT ID, Surname, Category, Department FROM  profiles WHERE userName = '$username' AND passWord = '$password'";
        $rs3 = mysqli_query($con, $pst3);


    //sub query involved below

    //- update attenace 
        $pst4 = "UPDATE attendance SET Date_ = '$d', TimeIn = '$t', Punctuality = '$tt', TimeOut = 'no' WHERE ID = (SELECT ID FROM profiles WHERE userName = '$username' AND passWord = '$password') AND Date_ is null";
        $rs4 = mysqli_query($con, $pst4);
    //if an error occurs
        if (!$rs3 || !$rs4) {
          
    echo "<script type='text/javascript'>alert('Sorry $surname, the system could not log you in.')
     window.location = 'login.php'
     </script>";
   
        }
    //if no error occurs
        else{         
             echo "<script type='text/javascript'>alert('Welcome $surname, Have a nice day today') 
    </script>";
        }
    
      }
    }
    //if user does not exist
    else{
 echo "<script type='text/javascript'>alert('User not found!') 
    window.location = 'login.php'</script>";
}
 }
 


  if(isset($_POST['btnLogOut'])){ 
     $id        =    $_SESSION['ID'] ;
              $pstLO = mysqli_query($con, "UPDATE attendance SET TimeOut = '$t' WHERE ID = '$id' AND Date_ = '$d'");

                if ($pstLO == true) {
                  
                  ?>
                     <script type="text/javascript"> window.location = "login.php";
                     </script>

                  <?php  
                  unset($_SESSION['ID']);
                  unset($_SESSION['SURNAME']);
                  unset($_SESSION['CATEGORY']);
                  unset($_SESSION['DEPARTMENT']);
                  unset($_SESSION['S/N']);  

                  session_destroy();
                }
                else {
                  echo mysqli_error($con);
                  ?>

                  <script type="text/javascript">alert("The System could not log you out");</script><?php
                } 
                  
                       }
                  ?>                 

<body bgcolor="ffffcc">
  <div align="center">
    <p></p>
    <img src="images/son.png"> </br>
<p></p><p></p>
<div style = "width:390px; border: solid 1px #16a085; " align = "center">
            <div style = "background-color:#16a085; color:#FFFFFF; padding:3px;" align=""><b><?php echo "Welcome, ".$surname; ?></b></div>   

    <table width="380" >
    <!--begins first row-->
      <tr >
        <td colspan="3" align="center"> 
     <form method="POST">     <button name="btnHome" id="btnHome" style="border-radius: 5px 5px 5px 5px;border: 0px; background: #c0392b; color: white;">Home </button> 
         &nbsp;&nbsp;&nbsp; 
        <?php echo display_time();?>
         &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;
        
        <button name="btnLogOut" id="btnLogOut" style="border-radius: 5px 5px 5px 5px; border: 0px; color: white; background: #c0392b;">Log Out        
        </button>
   </form>
        </td>
      </tr>
      <!--Ends first row-->

      <!-- begins seond row and also shows users online -->
      <tr>
        <td>
          <div class="user" id = "_user" align="left"> <div class="online"></div> &nbsp;&nbsp;&nbsp;&nbsp;Hi, <?php echo $surname;
             echo "<div align = 'left'> <img style='border-radius: 5px 5px 5px 5px;'   width = '100' height = '100' src = images/".$row['picUrl']."> </div>";

           ?>         

          </div>

           <div class="chat_box">
              <div class="chat_head" align="center">Staff on Seat</div>
              <div class="chat_body" >
                
            <?php
           //shows staff online
          $pst = mysqli_query($con, "SELECT * FROM attendance WHERE Date_= '$d' AND TimeOut = '00:00:00' AND ID <> '$id'"); 
          if ($pst == false) {
                     echo mysqli_error();
                   }    
                        else {while ($row = mysqli_fetch_assoc($pst)) {
             
             ?> 

            <table id="clist">            
               <?php
                   echo '<tr id = "'.$row['ID'].'"> <td> <div class="online"> </div> &nbsp;&nbsp;&nbsp;'.$row['Surname']."</td></tr>";                     
               ?> 
            </table>        
       <?php
          } }
           
        ?>
            </div>
        </div>
       </td>
        <td>
         
      <div class = "msg_box" id="msg_box" style="right: 290px;">
      <div class="msg_head" id="setName"> 
      <div class="close">X</div></div>
      <div class = "msg">
      <div class="msg_body" id="msg_body">
       <!--  <div class="sender">I'm the Sender</div>
        <div class="reciever">I'm the Reciever</div> -->
        <div class="msg_insert"></div> </div>
      <div class="msg_footer">
        <textarea class="msg_input" id="msg_input" rows="4" placeholder="Chat here"> </textarea>
      </div>
      <div class="others">
        <a href="#"><span class="glyphicon glyphicon-file" id="file"></span></a> &nbsp;&nbsp;
        <a href="#"><span class="glyphicon glyphicon-picture"></span> </a>
      </div>
   </div>
   </div>
         </td>
        </tr>
         
</table>
  </div>
 
</div>

<?
 
?>

 <div class="myId" id="myId"><?php echo $id ?></div>
</body> 
</html>
 