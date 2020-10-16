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
            }
            return $data;
        }
    }

?>
