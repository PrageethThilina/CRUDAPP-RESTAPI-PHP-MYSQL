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

    function fetch_all()
    {
        $query = "SELECT * FROM emp_tbl ORDER BY emp_id";
        $statement = $this->connect->prepare($query);
        if($statement->execute())
        {
            while($row = $statement->fetch(PDO::FETCH_ASSOC))
            {
                $data[] = $row;
            }
        return $data;
        }
    }

    function fetch_single($emp_id)
    {

        $query = "SELECT * FROM emp_tbl WHERE emp_id='".$emp_id."'";
        $statement = $this->connect->prepare($query);
        $data =array();
        if($statement->execute())
        {
            foreach($statement->fetchAll() as $row)
            {
                $data['emp_fname'] = $row['emp_fname'];
                $data['emp_lname'] = $row['emp_lname'];
                $data['emp_dob'] = $row['emp_dob'];
                $data['emp_section'] = $row['emp_section'];
                $data['emp_phone'] = $row['emp_phone'];
                $data['emp_email'] = $row['emp_email'];
                $data['emp_address'] = $row['emp_address'];
            }
            return $data;

        }

    }

    function update()
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
                ':emp_id'   => $_POST['emp_id']
            );
            $query = "
            UPDATE emp_tbl 
            SET emp_fname = :emp_fname, 
            emp_lname = :emp_lname, 
            emp_dob = :emp_dob, 
            emp_section = :emp_section, 
            emp_phone = :emp_phone, 
            emp_email = :emp_email, 
            emp_address = :emp_address
            WHERE emp_id = :emp_id
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
