
<?php

include("config.php");
include("bootstrap.php");

session_start();
session_destroy();

?>

<!DOCTYPE html>
<html>
    <head>
        <title>VUL Insurance Monitoring</title>
    </head>
    <body>
    	<div class="p-5 m-5 mx-auto" style="width:35%">
    		<img src="image\logo.png" class="pb-1 mb-3 infoform">
                <form class="form-group" action="process.php" method="post">
    				<label for="email" class="mr-sm-2">Username:</label>
    				<input type="email" name="uname" class="form-control mb-2 mr-sm-2" placeholder="Enter email" id="email" required>
    				<label for="pwd" class="mr-sm-2">Password:</label>
    				<input type="password" name="pword" class="form-control mb-2 mr-sm-2" placeholder="Enter password" id="pwd" required>
    		  		<button type="submit" class="btn btn-primary mb-2" name="publish">Log in</button>
    			</form>


    			
                <?php

                if (isset($_GET['Message'])) {
                    print $_GET['Message'];
                }
                echo "<br>";   
        
                ?>
                <br>


    		
    	    <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="exampleModalLongTitle">Please fill out this form</h6>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        <div class="modal-body">  
                            <div class="form-group row">
                                <form action="process.php" method="post">   
                                    <div class="ml-3 mr-3">
                                        <div class="input-group mb-1 input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">First Name *</span>
                                            </div>
                                                <input type="text" class="form-control" name="firstname" required>
                                        </div>

                                        <div class="input-group mb-1 input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Middle Name *</span>
                                            </div>
                                                <input type="text" class="form-control" name="middlename" required>
                                        </div>

                                        <div class="input-group mb-1 input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Last Name *</span>
                                            </div>
                                                <input type="text" class="form-control" name="lastname" required>
                                        </div>

                                        <div class="input-group mb-3 input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Policy number *</span>
                                            </div>
                                                <input type="number" class="form-control" name="policy" required>
                                        </div>

                                        <div class="input-group mb-1 input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Index Fund </span>
                                            </div>
                                                <input type="number" class="form-control" name="index">
                                        </div>

                                        <div class="input-group mb-1 input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Units </span>
                                            </div>
                                                <input type="number" class="form-control" name="indexunits">
                                        </div>

                                        <div class="input-group mb-3 input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Allocation </span>
                                            </div>
                                                <input type="number" class="form-control" name="indexallocation">
                                        </div>

                                        <div class="input-group mb-1 input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Equity Fund </span>
                                            </div>
                                                <input type="number" class="form-control" name="equity">
                                        </div>

                                        <div class="input-group mb-1 input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Units</span>
                                            </div>
                                                <input type="number" class="form-control" name="equityunits">
                                        </div>

                                        <div class="input-group mb-3 input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Allocation</span>
                                            </div>
                                                <input type="number" class="form-control" name="equityallocation">
                                        </div>

                                        <div class="input-group mb-1 input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Username *</span>
                                            </div>
                                                <input type="email" class="form-control" name="username" value="email@sample.com" required>
                                        </div>

                                        <div class="input-group mb-1 input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Password *</span>
                                            </div>
                                                <input type="password" id="password" class="form-control" name="password" onkeyup='check();'required>
                                        </div>

                                        <div class="input-group mb-3 input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Confirm password *</span>
                                            </div>
                                                <input type="password" id="confirm_password" class="form-control" name="confirm_password" onkeyup='check();' required>   
                                        </div>

                                        <div id="message">
                                            
                                        </div> 

                                        <div>
                                        <input type="submit" class="btn btn-primary" value="Submit" name="saveinfo">
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                        
            <a class="btn-light" data-toggle="modal" data-target="#exampleModalCenter">
        		<div class="d-flex justify-content-left ">
        			<h6 class="text-primary" >Register</h6>
        		</div>
        	</a>
        </div>
        
    </body>
</html>




<script type="text/javascript">
var check = function() {
    if (((document.getElementById('password').value) =="" && (document.getElementById('confirm_password').value =="")) || (document.getElementById('password').value) ==""){
    document.getElementById('message').style.color = 'red';
    document.getElementById('message').innerHTML = 'Please put password';

  } else if (document.getElementById('password').value ==
    document.getElementById('confirm_password').value) {
    document.getElementById('message').style.color = 'green';
    document.getElementById('message').innerHTML = 'Password matched';

  } else if ((document.getElementById('confirm_password').value)==""){
    document.getElementById('message').style.color = 'red';
    document.getElementById('message').innerHTML = 'Please confirm password';
  }
    else {
    document.getElementById('message').style.color = 'red';
    document.getElementById('message').innerHTML = 'Password did not match';
  }
}





</script>


