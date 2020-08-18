<?php

include('config.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();

}
    
if (!empty($_SESSION['login_user'])) {
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($conn,"SELECT `Policy_number` FROM `account` WHERE `User_name` = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['Policy_number'];


      if(time()-$_SESSION["login_time_stamp"] >1800)   
      { 

         session_unset(); 
         session_destroy(); 

         header("location:Index.php");   
      } 

}

else {

   header("location:Index.php");   

}

 
?>