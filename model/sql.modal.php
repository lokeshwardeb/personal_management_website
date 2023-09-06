<?php

require_once __DIR__ . '/../config/config.php';


class modal_sql extends conn{

public function get_data($table_name){

    $sql = "SELECT * FROM `$table_name`";
    $result = $this->connect()->query($sql);

    return $result;



}

public function get_data_where($table_name, $grabpoints_and_grabpointvalues){

    $sql = "SELECT * FROM `$table_name` WHERE $grabpoints_and_grabpointvalues";
    $result = $this->connect()->query($sql);

    return $result;


}

public function pure_data($pure_data){
    $the_data = htmlspecialchars(mysqli_real_escape_string($this->connect(), $pure_data), ENT_QUOTES);
    return $the_data;
    
}

public function insert_data($table_name, $insert_table_names, $insert_tables_values){

    $sql = "INSERT INTO `$table_name` ($insert_table_names) VALUES ($insert_tables_values);";
    $result = $this->connect()->query($sql);

    return $result;

    // $sql = "INSERT INTO `$table_name` (`username`, `password`, `datetime`) VALUES ('$username', 's1', current_timestamp());";

}



}


$conn = new conn;



?>