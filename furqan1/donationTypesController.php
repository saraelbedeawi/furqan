<?php

set_include_path('./');
include_once './models/options.php';
include_once './models/options_types.php';
include_once './models/donations_types.php';
include_once './models/donationOptions.php';
include_once './models/options.php';

if(isset($_GET['method']) && $_GET['method']=="getoptions")
{
    getOptions();
}
else if(isset($_GET['method']) && $_GET['method']=="getoptionsTypes")
{
    getOptionsTypes();
}
else if(isset($_POST['method']) && $_POST['method']=="addDonationType")
{
    addDonationType();
}
else if(isset($_GET['method']) && $_GET['method']=="addNewType")
{
    addNewType();
}
else if(isset($_POST['method']) && $_POST['method']=="EditDonationType")
{
    updateDonation();
}
else if(isset($_POST['method']) && $_POST['method']=="deleteDonation")
{
    DeleteDonation();
}

function getOptions()
{
    $id = $_GET["id"];
    $options = new options();
    $dontation_type_option=new donationsTypes();
    $option = $options->GetAll();
    if($id != 0) {
        $selectedOptions = $dontation_type_option->getDonationOptionDetails($id);
        for($i = 0; $i < sizeof($option); $i++) {
            $option[$i]["selected"] = false;
            $option[$i]['donationName']=false;
           
            for($j =0; $j < sizeof($selectedOptions); $j++)
            {
                if($option[$i]["id"] === $selectedOptions[$j]['optionId'])
                 {
                     $option[$i]['donationName']=$selectedOptions[$j]['name'];
                    $option[$i]["selected"] = true;
                    $option[$i]['donationId']=$id;
                    break;
                }
            }
        }
    }
    echo json_encode($option);
}
function getOptionsTypes()
{
    $type = new optionsTypes();
    $types = $type->GetAll();
    echo json_encode($types);
}
function addDonationType()
{
    $optionType=new options();
    $type= new donationsTypes();
    $donationOption=new donationOptions();
    $type->name=$_POST['donationType'];
        $donationId= $type->Insert();

        $options=json_decode($_POST['selectedValues']);
    if($_POST['selectedValues'])
    {
        for($i=0;$i<count($options);$i++)
        {
            $donationOption->donationTypeId=$donationId;
            $donationOption->optionId=$options[$i];
            $donationOption->Insert();
        }
    }
    $optionTypes = json_decode($_POST['type']); 

    if($_POST['type'])
    {
        foreach($optionTypes as $optionTypes) {
            //inset option_values
            $optionType->name=$optionTypes->name;
            $optionType->optionTypeId= $optionTypes->TypeId;
           $optionsId=  $optionType->Insert();
            $donationOption->donationTypeId=$donationId;
            $donationOption->optionId=$optionsId;
            $donationOption->Insert();
            
    }

    }
}
function updateDonation()
{
    $optionType=new options();
    $id=$_POST['id'];
    $name=$_POST['donationType'];
    $donationType=new donationsTypes();
    $donationType->id=$id;
    $donationType->name=$name;
    $donationType->UPDATE();
    $donationTypeRelation=new donationOptions();
    $donationTypeRelation->donationTypesId=$id;
    $donationTypeRelation->deleteRelations();



    $options=json_decode($_POST['selectedValues']);
    if($_POST['selectedValues'])
    {
        for($i=0;$i<count($options);$i++)
        {
            $donationTypeRelation->donationTypeId=$id;
            $donationTypeRelation->optionId=$options[$i];
            $donationTypeRelation->Insert();
        }
    }
    $optionTypes = json_decode($_POST['type']); 

    if($_POST['type'])
    {
        foreach($optionTypes as $optionTypes) {
            //inset option_values
            $optionType->name=$optionTypes->name;
            $optionType->optionTypeId= $optionTypes->TypeId;
           $optionsId=  $optionType->Insert();
            $donationTypeRelation->donationTypeId=$id;
            $donationTypeRelation->optionId=$optionsId;
            $donationTypeRelation->Insert();
            
    }

    }

}
function DeleteDonation()
{
    $id=$_POST['id'];
    $donationType=new donationsTypes();
    $donationType->id=$id;
    $donationType->Delete();
    $donationTypeRelation=new donationOptions();
    $donationTypeRelation->donationTypesId=$id;
    $donationTypeRelation->deleteRelations();
}
?>