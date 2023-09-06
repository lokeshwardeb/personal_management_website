<?php
 class conn {

    
private $hostname;
private $db_username;
private $db_password;
private $db_name;

protected function connect(){

    $this->hostname = 'localhost';
    $this->db_username = 'root';
    $this->db_password = '';
    $this->db_name = 'personal_management_website';

    $conn = new mysqli($this->hostname, $this->db_username, $this->db_password, $this->db_name);

    if(mysqli_connect_error()){
        echo 'connect error';
    }else{
        // echo 'connected';
    }

    // echo 'connected';

    return $conn;


}




}

new conn;






?>