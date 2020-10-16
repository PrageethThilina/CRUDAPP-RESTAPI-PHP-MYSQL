<?php

include('connection.php');

$api_object = new API();


if($_GET["action"] == 'fetch_single')
{
 $data = $api_object->fetch_single($_GET["emp_id"]);
}

if($_GET["action"] == 'update')
{
 $data = $api_object->update();
}

echo json_encode($data);

?>