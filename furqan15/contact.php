
 
 <link rel="stylesheet" href="newstyle.css">
 <?php
         require('header.html');

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "dar_elfourkan";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        $query=" SELECT id, `value` FROM `ckeditor` WHERE elementId LIKE 'label' ";
        $result = mysqli_query($conn,$query);

                 while ($row = $result->fetch_assoc()) {
                     
                echo "<div class='ContText'> ".$row['value']  ." 
                
                <div class='links' >
                 <a href='CKEditor.php'> Edit </a>
            
                </div>

                </div><br>";    
                
            }
     
        ?>

    <script type="text/javascript">
        

    </script>
