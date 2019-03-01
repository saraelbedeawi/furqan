
<?php

    
    $conn = new mysqli('localhost', 'root', '','dar_elfourkan');
			mysqli_query($conn,"SET NAMES 'utf8'"); 
   			mysqli_query($conn,'SET CHARACTER SET utf8');
    
    if(isset($_POST['method']) && $_POST['method']=="addReceipt")
    {
        addReceipt($conn);
    }
    else if( $_REQUEST["selectedButtonValue"] )
    {
        $value = $_REQUEST['selectedButtonValue'];
        // echo $value;
        // echo "Value is ". $value."<br>";
        
        // $sql="SELECT name ,html,id from options where id IN (SELECT options_id FROM `donation_options` WHERE donation_types_id=$value)";
        $sql="SELECT options.name ,options.type,options.html,options.id, donation_options.id as donationOptionId from options INNER JOIN donation_options ON options.id=donation_options.options_id where donation_options.donation_types_id=$value";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) 
        {
            // output data of each row
            while($row = $result->fetch_assoc()) 
            { 

                echo '<div  class="row">';
                if($row["html"])
               echo'<div id='.$row["donationOptionId"].' class="offset-md-5 col-md-3">' .$row["html"].' >';
                elseif ($row['name']="child_name"&& $row['type']=="option")
                {
                    echo'<div id="'.$row["donationOptionId"].'" class="offset-md-5 col-md-3">
                    <label>اسم الطفل</label>
                    <select>';
                        $sql = "SELECT * FROM person where role_id=6";
                        $result1 = mysqli_query($conn,$sql);
                        
                        while($row1=$result1->fetch_assoc())
                        {
                        echo '<option id="'.$row1['id'].'" value="'.$row1['id'].'" >'.$row1['name'].'</option>';
                        }
                        echo'</select></div>';
                } echo '</div> </div>';
              
            } 
           
            echo '<div  class="row">
            <div class="offset-md-5 col-md-3">
            <button onclick="saveReceipt()">save</button></div></div>';
         }    
    }
   
	function addReceipt($conn)
	{
        unset($_POST['method']);

        $donationTypeId = $_POST['donationType'];
        unset($_POST['donationType']);

        $donarName = $_POST['donarName'];
        $donerNameO = json_decode($donarName);
        $donarName=$donerNameO->data;
        unset($_POST['donarName']);
        $money = $_POST['money'];
         $moneyO = json_decode($money);
        $money=$moneyO->data;
        unset($_POST['money']);
       

        //insert recipt
        $sql="INSERT INTO `receipt`(`recipient_id`, `amount`, `donar_name`,
          `isdeleted`, `donation_type_id`) values (1,$money,'$donarName',0, $donationTypeId)";
          echo $sql;
          $result = $conn->query($sql);
       $receiptid= $conn->insert_id;
        foreach($_POST as $option) {
            //inset option_values
            $optionValue = json_decode($option);
            $Ovalue=$optionValue->data;
          $id= $optionValue->optionId;
 
        //   $sql="select option_id from donation_options where id=".$id;
        //   $result = $conn->query($sql);
        //   while($row=$result->fetch_assoc())
        //   {
        //          if($row['option_id']=="7")
        //          {
        //             $sql="INSERT INTO child_donation (receipt_id,child_id) values ( $receiptid,$Ovalue) ";
        //             $result = $conn->query($sql);
        //         }
        //   }

         $sql="INSERT INTO `donation_values`(`donation_options_id`,`value`, `receipt_id`, `isdeleted`) 
          VALUES($id,'$Ovalue',$receiptid,0) "; 
           $result = $conn->query($sql);

        }
        //loop on the remaining $_POST {
            //insert in the values
        //}
        
       
        

    }		

?>