<?php

include('connection.php');

$api_object = new API();

if($_GET["action"] == 'delete')
{
 $data = $api_object->delete($_GET["emp_id"]);
}

echo json_encode($data);

?>