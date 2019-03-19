


<?php
require('header.html');

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname= "dar_elfourkan";
            $conn = new mysqli($servername, $username, $password, $dbname);
            $query= "select gender, count(*) as number from person where role_id=6 GROUP BY gender";
            $result= mysqli_query($conn,$query);

?>


           <script type="text/javascript">  
           google.charts.load('current', {'packages':['corechart']});  
           google.charts.setOnLoadCallback(drawChart);  
           function drawChart()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['Gender', 'Number'],  
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                               if($row["gender"]=="0")
                               {
                                   $gender="ذكر";
                               }
                               else
                               {
                                   $gender="انثي";
                               }
                               echo "['".$gender."', ".$row["number"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                      title: 'نسبة الأطفال الذكور والإناث',  
                      is3D:true,  
                      pieHole: 0.4  
                     };  
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
                chart.draw(data, options);  
           }  
           </script> 
<div class="restOfForm container-fluid">


<div style="width:100%; margin-left: auto;margin-right: auto; text-align:center; padding-top:20px;padding-bottom:20px;"> 
<h1> احصائيات الاطفال</h1></div>

        <div id="piechart" style="width:600px; height: 400px; margin:auto;"></div>


      
       
</div>
  


