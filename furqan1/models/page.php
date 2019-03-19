<?php

set_include_path('../');
include_once './helpers/db.php';

class page {

    public $id;
    public $physicalAddress;

    function GetByRoleId($roleId) {
        $conn = db::create_connection();
        $sql="SELECT * from page WHERE page.id 
            =(SELECT page_id from user_access WHERE role_id = $roleId)";
        $result = mysqli_query($conn, $sql);
        $result = $result->fetch_assoc();

        $conn->close();

        $this->id = $result['id'];
        $this->physicalAddress = $result['physical_address'];
        return $this;
    }
}

?>