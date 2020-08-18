<?php

    include("config.php");
    include("session.php");
    include("bootstrap.php");

    error_reporting (E_ALL ^ E_NOTICE); 


$sql = "SELECT `Name`,`Policy_number` FROM `account` WHERE `Policy_number` = '$login_session'";
        if($result = mysqli_query($conn, $sql)){
            if($row = mysqli_fetch_array($result)){    


?>

<!DOCTYPE html>
<html>
    <head>
        <title>VUL Insurance Monitoring</title>
    </head>
<body>

    <div class="mx-auto w-75 p-1">          
        <img src="image\logo.png" class="pb-1 mb-3 wellogo">
            <div class="row">
                <div class="col">
                    <h5 class="text-primary">Welcome <?php echo $row['Name'];?>,</h5>
                </div>
                <div class="col">
                    <a href="logout.php" class="btn text-primary btn-outline-light float-right"><small>Logout</small></a>
                </div>
            </div>
            

            <div class="row">
                <div class="col">
                    <h6 class="text-primary pb-2">Policy number : <?php echo $row['Policy_number'];}}?> </h6>
                </div>
            </div>

<?php
         $sql = "SELECT `Date_paid`,`Due_date` FROM `payment_details` WHERE `Policy_number` = '$login_session'";
            if($result = mysqli_query($conn, $sql)){

?>

                <div class="row">                       
                        <p class="col float-right"> 

                            Date Paid : <?php if($row = mysqli_fetch_array($result)){echo $dp = $row['Date_paid'];?><br> 
                            Due Date  : <?php echo $dd = $row['Due_date'];}}?><br>

                            <small class="text-primary" data-toggle="modal" data-target="#editpaydate"> Edit </small><br>
                        </p>
                        
                </div>


                <div class="row">
<?php
                    $sql = "SELECT `Type`, `Units`, `Allocation` FROM `fund_details` WHERE `Policy_number`= '$login_session'";

                            if($result = mysqli_query($conn, $sql)){

                                if(mysqli_num_rows($result) == 2){

                                    while($row = mysqli_fetch_array($result)){  ?>

                                        <p class="col float-right"> 

                                            Fund Type : <?php echo $t = $row['Type'];?> <br>
                                            Units : <?php echo $u = $row['Units'];?><br>
                                            Allocation : <?php echo $a = $row['Allocation'];?><br> 
                                            
                                        </p>
<?php                                       

                                        }}

                                else {

                                    while($row = mysqli_fetch_array($result)){  ?>
                                        
                                        <p class="col float-right"> 

                                            Fund Type : <?php echo $row['Type'];?> <br>
                                            Units : <?php echo $row['Units'];?><br>
                                            Allocation : <?php echo $row['Allocation']; 
                                            
                                        }?>

                                        </p> 
                                                           
                               
                    <?php }} ?>

                </div>


                    
                <div class="row">
                    <!--Adding Total Fund, Index Fund, Equity Fund, Asof -->
                    <div>
                        <p class="col">
                            <small class="text-primary addfundbutton" data-toggle="modal" data-target="#modaladdfund">
                                 Add Funds
                            </small>
                        </p>
                    </div>

                    <!--View Chart -->
                    <div class="col">
                            <a href= "chart.php"><small class=" text-primary float-right">View Chart</small></a>
                    </div>
                </div>
    
<?php

        $sql = "SELECT * FROM `historical` WHERE `Policy_number`= '$login_session' ORDER BY `Counter` DESC";

                if($result = mysqli_query($conn, $sql)){

?>                 <div class="table-responsive-sm tbody">
                        <table id="dtBasicExamples" class="table table-bordered table-sm table-hover" cellspacing="0" >
                        <?php
                            echo "<tr>";
                                echo "<th>Id</th>";
                                echo "<th>Total Fund</th>";
                                echo "<th>Index Fund</th>";
                                echo "<th>Equity Fund</th>";
                                echo "<th>Date</th>";
                                echo "<th colspan='2'>Action</th>";
                            echo "</tr>";
                        while($row = mysqli_fetch_array($result)){
                            $counter = $row['Counter'];
                            echo "<tr>";
                                echo "<td>" . $row['Counter'] . "</td>";
                                echo "<td>" . $row['Total_fund'] . "</td>";
                                echo "<td>" . $row['Index_fund'] . "</td>";
                                echo "<td>" . $row['Equity_fund'] . "</td>";
                                echo "<td>" . $row['Asof'] . "</td>";
                                ?>
                                
                                <td>
                                <button type="button" class="btn btn-primary btn-sm editbtn">Edit</button>
                                </td>

                                <td><a class="btn btn-danger btn-sm" href="process.php?deletefund=<?php echo $row['Counter'];?>">Delete</a></td>

                                <?php
                            
                        }?>
                        </table>
                    </div>
<?php
                    if(mysqli_num_rows($result) == 0){
                        ?><br><h6 class="text-danger"><?php echo "No records were found."; ?></h6> <?php
                    }
                }


            else {
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
            }
             
        
  
 ?>     

<!--Edit Modal Date Paid, Due Date-->
        <div class="modal fade" id="editpaydate">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h6 class="ml-1modal-title">Edit</h6>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group row">

                            <form action="process.php" method="post">  

                                <div class="ml-3 mt-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Date Paid</span>
                                        </div>
                                            <input type="date" class="form-control" name="datepaid" value="<?php echo $dp; ?>">
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Due Date</span>
                                        </div>
                                            <input type="date" class="form-control" name="duedate" value="<?php echo $dd; ?>">
                                    </div>

                                    <input type="submit" name="editdate" class="btn btn-primary " value="Save">
                                </div>
                            </form>

                        </div>              
                    </div>

                </div>
            </div>
        </div>    



<!-- Modal Adding Total Fund, Index Fund, Equity, As of, Action-->
        <div class="modal fade" id="modaladdfund" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">

                <div class="modal-content">

                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLongTitle ml-5">All fields are required to fill in</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                    </div>

                <div class="modal-body">  
                    <div class="form-group row">
                        <form action="process.php" method="post">   
                            <div class="ml-3">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Index Fund </span>
                                    </div>
                                        <input type="text" class="form-control" name="indexfund" required="">
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Equity Fund </span>
                                    </div>
                                        <input type="text" class="form-control" name="equityfund" required="">
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Date</span>
                                    </div>
                                        <input type="date" class="form-control" name="asof" required="">
                                </div>

                                <input type="submit" name ="addfund" class="btn btn-primary" value="Submit">
                                
                            </div>
                        </form>
                    </div>
                </div>

            </div>
          </div>
        </div>



         

<!-- Modal Editing Total Fund, Index Fund, Equity, As of, Action-->

        <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLongTitle ml-5">You are editing fund details</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                <div class="modal-body"> 
                <!-- <input type="hidden" id="updateid" name="updateid"> --> 
                    <div class="form-group row">
                        <form action="process.php" method="post">   
                            <div class="ml-3">

                                <input type="hidden" id="updateid" name="updateid" value=""> 

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Id</span>
                                    </div>
                                        <input type="text" class="form-control" id="updateid" name="updateid" value="" disabled>               
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Total Fund </span>
                                    </div>
                                        <input type="text" class="form-control" id="totalfund" name="totalfund" value="" disabled>               
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Index Fund </span>
                                    </div>
                                        <input type="text" class="form-control" id="indexfund" name="indexfund" required="" value="">
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Equity Fund </span>
                                    </div>
                                        <input type="text" class="form-control" id="equityfund" name="equityfund" required="" value="">
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">As of</span>
                                    </div>
                                        <input type="date" class="form-control" id="asof" name="asof" required="" value="">
                                </div>

                                <input type="submit" name="editfund" class="btn btn-primary" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>

            </div>
          </div>
        </div>

</div>



</body>
</html>


<script type="text/javascript">

    $(document).ready(function(){
        $('.editbtn').on('click', function(){
            $('#editmodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function(){
                    return $(this).text();
                }).get();

                console.log(data);

                $('#updateid').val(data[0]);
                $('#totalfund').val(data[1]);
                $('#indexfund').val(data[2]);
                $('#equityfund').val(data[3]);
                $('#asof').val(data[4]);
                              
        });
    });

    
</script>





