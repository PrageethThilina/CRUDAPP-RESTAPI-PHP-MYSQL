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

    function insert()
    {
        if(isset($_POST["emp_fname"]))
        {
            $form_data = array(
                ':emp_fname'  => $_POST["emp_fname"],
                ':emp_lname'  => $_POST["emp_lname"],
                ':emp_dob'  => $_POST["emp_dob"],
                ':emp_section'  => $_POST["emp_section"],
                ':emp_phone'  => $_POST["emp_phone"],
                ':emp_email'  => $_POST["emp_email"],
                ':emp_address'  => $_POST["emp_address"],
            );
            $query = "
            INSERT INTO emp_tbl 
            (emp_fname, emp_lname, emp_dob, emp_section, emp_phone, emp_email, emp_address) VALUES 
            (:emp_fname, :emp_lname, :emp_dob, :emp_section, :emp_phone, :emp_email, :emp_address)
            ";
            $statement = $this->connect->prepare($query);
            if($statement->execute($form_data))
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