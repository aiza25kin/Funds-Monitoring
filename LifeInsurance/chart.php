<?php
    include("config.php");
    require_once("session.php");
    include("bootstrap.php");

    error_reporting (E_ALL ^ E_NOTICE); 

    // $login_session = $_SESSION['login_user'];

    $sql = mysqli_query($conn, "SELECT * FROM historical WHERE Policy_number = '$login_session'");

?>


<!DOCTYPE html>
<html>
      <head>  
        <title>VUL Insurance Monitoring</title>
      </head>
<body>

    <div class="mx-auto w-75 pb-1">

        <img src="image\logo.png" class="pb-1 mb-3 chart">

            <div class="row">

                <div class="col">
                    <h6>Fund Graph</h6>
                </div>

                <div class="col">
                    <a href="logout.php" class="btn text-primary btn-outline-light float-right"><small>Logout</small></a>
                </div>

            </div>
                  
        <div id="chart_div" class="charts">
          
<?php              if(mysqli_num_rows($sql) == 0){
                  echo "<h6 class='text-danger'>No records were found</h6>";}?>
        </div>
            
    </div>  
      
</body>
</html>

        <script type="text/javascript">
              google.charts.load('current', {'packages':['corechart']});
              google.charts.setOnLoadCallback(drawVisualization);

              function drawVisualization() {
              // Some raw data (not necessarily accurate)
              var data = google.visualization.arrayToDataTable([

                      ['Date', 'F'],

                      <?php
                            if(mysqli_num_rows($sql) > 0){
                                while($row = mysqli_fetch_array($sql)){
                                    echo "['".$row['Asof']."', ".$row['Total_fund']."],";
                                }
                            }
                            else{
                              echo "No records were found";
                            }
                       ?>
                        // ['12/01',400],
                    ]);

              var options = {
                vAxis: {title: 'Funds'},
                hAxis: {title: 'Day'},
                seriesType: 'bars',
                series: {5: {type: 'line'}}        };

              var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
              chart.draw(data, options);
            }
         </script>

