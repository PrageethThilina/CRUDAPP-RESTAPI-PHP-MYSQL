<?php

include('connection.php');

$api_object = new API();

if($_GET["action"] == 'insert')
{
 $data = $api_object->insert();
}

echo json_encode($data);

?>