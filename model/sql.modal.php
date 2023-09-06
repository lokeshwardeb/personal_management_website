<?php

require_once __DIR__ . '/../config/config.php';


class modal_sql extends conn{

public function get_data($table_name){

    $sql = "SELECT * FROM `$table_name`";
    $result = $this->connect();



}


public function insert_data(){

    $sql = "INSERT INTO `users` (`user_id`, `username`, `password`, `datetime`) VALUES (NULL, 'd', 's1', current_timestamp());";

}



}


$conn = new conn;



?>