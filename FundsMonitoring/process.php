<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include("config.php");
require_once("session.php");
// include("home.php");



if(isset($_POST['publish'])){

        if($_SERVER["REQUEST_METHOD"] == "POST") {
            // username and password sent from form

                  
            $myusername = mysqli_real_escape_string($conn,$_POST['uname']);
            $mypassword = mysqli_real_escape_string($conn,$_POST['pword']); 
                  
            $sql = "SELECT * FROM `account` WHERE `User_name` = '$myusername' AND `Password` = '$mypassword'";
            $sqluser = "SELECT * FROM `account` WHERE `User_name` = '$myusername' AND `Password` != '$mypassword'";

            $result = mysqli_query($conn,$sql);
            $userresult = mysqli_query($conn,$sqluser);

            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            $rowuser = mysqli_fetch_array($userresult,MYSQLI_ASSOC);
            // $active = $row['active'];
                  
            $count = mysqli_num_rows($result);  
            $usercount = mysqli_num_rows($userresult);                  
            // If result matched $myusername and $mypassword, table row must be 1 row
                    
                if($count == 1) {
                    // session_register("myusername");
                $_SESSION['login_user'] = $myusername;
                    // //$_SESSION['username'] = $_POST['uname'];
                    // $login_session = $row['Id'];
                    

                     // Login time is stored in a session variable 
                    $_SESSION["login_time_stamp"] = time();     
                    header("location: welcome.php");
                    // mysqli_close($conn);
                    // exit();

                    // echo "<script>location='welcome.php'</script>";

                }

                else if ($usercount == 1) {

                    header("location: Index.php?Message=Invalid Password" . urlencode($Message));
                }

                else {

                    header("location: Index.php?Message=Please register first" . urlencode($Message));
                    // mysqli_close($conn);
                    // exit();
                }
        }
}



if(isset($_GET['deletefund'])){
  $id = $_GET['deletefund'];
  echo $_GET['deletefund'];

          $query = "DELETE FROM `historical` WHERE `Policy_number` = '$login_session' AND `Counter` = '$id'";

          $data = mysqli_query($conn, $query);

          header("location: welcome.php");
          
}



if(isset($_POST['editfund'])){

        $id=$_POST["updateid"];
        $indexfund=$_POST["indexfund"];
        $equityfund=$_POST["equityfund"];
        $totalfund=$_POST["indexfund"] + $_POST["equityfund"];
        $asof=$_POST["asof"];

        $query = "UPDATE `historical` SET `Total_fund`='$totalfund', `Index_fund`='$indexfund', `Equity_fund`='$equityfund', `Asof`='$asof' WHERE `Policy_number` = '$login_session' AND `Counter` = '$id'";

        $data = mysqli_query($conn, $query);

        header("location: welcome.php");
        
}



if(isset($_POST['addfund'])){
        
        $indexfund=$_POST["indexfund"];
        $equityfund=$_POST["equityfund"];
        $totalfund=$_POST["indexfund"] + $_POST["equityfund"];
        $asof=$_POST["asof"];

        $query = "INSERT INTO `historical` (`Policy_number`,`Total_fund`, `Index_fund`, `Equity_fund`, `Asof`) VALUES ('$login_session','$totalfund','$indexfund','$equityfund','$asof')";
        
        $data = mysqli_query($conn, $query);

        header("location: welcome.php");
        
}



if(isset($_POST['editdate'])){

        $duedate=$_POST["duedate"];
        $datepaid=$_POST["datepaid"];
            
        $query = "UPDATE `payment_details` SET `Due_date` = '$duedate', `Date_paid` = '$datepaid' WHERE `Policy_number` = '$login_session'";

        $data = mysqli_query($conn, $query);

        header("location: welcome.php");
}



if (isset($_POST['saveinfo'])) {
        
            $fname=$_POST["firstname"];
            $mname=$_POST["middlename"];
            $lname=$_POST["lastname"];
            $policy=$_POST["policy"];
            $username=$_POST["username"];
            $password=$_POST["password"];

            
            $index=$_POST["index"];
            $indexunits=$_POST["indexunits"];
            $indexallocation=$_POST["indexallocation"];

            
            $equity=$_POST["equity"];
            $equityunits=$_POST["equityunits"];
            $equityallocation=$_POST["equityallocation"];

            $tfund=$index+$equity;
            $date=date("Y/m/d");


            $sql= "SELECT `Policy_number`,`User_name` FROM `account` WHERE `Policy_number`='$policy' OR `User_name`='$username'";

            $res= mysqli_query($conn,$sql);
            
            if(mysqli_num_rows($res) > 0){  

                $row = mysqli_fetch_assoc($res);  

                if($policy==$row['Policy_number']){

                    header("location: Index.php?Message=Policy number already exists." . urlencode($Message));
                    
            
                }
                elseif($username==$row['User_name']){

                    header("location: Index.php?Message=Username already exists." . urlencode($Message));
                    
                }                                             
                else {
                   
                }
            }

            else{

                    $info = ("INSERT INTO `account`(`Name`, `Middle_name`, `Last_name`, `Policy_number`, `User_name`, `Password`) VALUES ('$fname','$mname','$lname','$policy','$username','$password')");

                        $data = mysqli_query($conn, $info);

                    $payment = ("INSERT INTO `payment_details`(`Policy_number`) VALUES ('$policy')");

                        $data = mysqli_query($conn, $payment);

                    // $hfund = ("INSERT INTO `historical`(`Policy_number`,`Total_fund`,`Index_fund`,`Equity_fund`,`Asof`) VALUES ('$policy','$tfund','$index','$equity','$date')");
                    //     $data = mysqli_query($conn, $hfund);


                    if (($indexunits != "") AND ($indexallocation != "")){
                    
                        $fund1 = ("INSERT INTO `fund_details`(`Policy_number`, `Type`, `Units`, `Allocation`) VALUES ('$policy','Index','$indexunits','$indexallocation')");
                        $data = mysqli_query($conn, $fund1);
                    }

                    if (($equityunits != "") AND ($equityallocation != "")){

                        $fund2 = ("INSERT INTO `fund_details`(`Policy_number`, `Type`, `Units`, `Allocation`) VALUES ('$policy','Equity','$equityunits','$equityallocation')");
                        $data = mysqli_query($conn, $fund2);
                    }
                                         

                    header("location: Index.php?Message=You are successfully registered. Please login to your account." . urlencode($Message));
                    
            }
            
    }


                                


