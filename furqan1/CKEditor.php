
<html>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<?php
        // require('html/header.html');

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
        $row = $result->fetch_assoc();
        $word=$row["value"];

                
        ?>


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<meta charset="utf-8">
<script src="https://cdn.ckeditor.com/4.11.3/standard/ckeditor.js"></script>
        


        <head>

                
                <title>Change Label</title>
                
        </head>
        <body>
                <textarea class ="ckeditor" name="Edit" id="Edit"> <?php echo $word;?></textarea>
                 <button onclick="Save();" type="button" class="btn btn-primary col-md">Save</button>
                <script>

                        function strip(html)
                                        {
                                           var tmp = document.createElement("DIV");
                                           tmp.innerHTML = html;
                                           return tmp.textContent || tmp.innerText || "";
                                        }


                        

                        
                         // var data =CKEDITOR.instances.Edit.document.getBody().getText()
                          //////////////////////////  
                           // var data = CKEDITOR.instances.Edit.getData();
                           // CKEDITOR.instances.Edit.getData();
                          // save(data);
                        CKEDITOR.replace( 'Edit' );  //var data=CKEDITOR.instances["txtFT_Content"].getData();
                          

                
                        // var desc = CKEDITOR.instances['Edit'].getData();
                        function Save() {
                            var data = CKEDITOR.instances['Edit'].getData();
                            // var data= strip(html);
                            //data.text();

                            // alert(data);
                            if(data!="")
                            {
                            
                                jQuery.ajax({
                                    url: "CKEditorBackEnd.php",
                                    data:'method=save&data='+data,
                                    type: "POST",
                                    success:function(data2)
                                    {
                                            alert("Changed!");

                                            $("#result").html(data2);
                                            top.location.href="contact.php";
                                    }
                                                
                                });
                            }
                        }

                </script>

                
        </body>
</html>