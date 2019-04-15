<?php
// require('h/header.html');
                

         $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "dar_elfourkan";
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 


				 if(isset($_POST['method']) && $_POST['method']=="save")
				{
				    save($conn);
				}

				function save($conn)
				{
		        	$text =  $_POST['data'];
		     	 	$query=" UPDATE `ckeditor` SET `value`='$text' WHERE elementId LIKE 'label'";
		     	 	echo $sql;
		       		$result = mysqli_query($conn,$query);
       			}

               

?>
