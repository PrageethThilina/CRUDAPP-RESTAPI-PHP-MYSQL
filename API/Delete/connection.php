<?php

class API
{
    private $connect = '';

    function __construct()
    {
        $this->database_connection();
    }

    function database_connection()
    {
        $this->connect = new PDO("mysql:host=localhost;dbname=rest_api_crud_db", "root", "");
    }

    function delete($id)
    {
        $query = "DELETE FROM emp_tbl WHERE emp_id = '".$id."'";
        $statement = $this->connect->prepare($query);
        if($statement->execute())
        {
            $data[] = array(
                'success' => '1'
            );
        }
        else
        {
            $data[] = array(
                'success' => '0'
            );
        }
        return $data;
    }
}

?>