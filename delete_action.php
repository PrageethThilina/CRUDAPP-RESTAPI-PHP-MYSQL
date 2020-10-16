<?php

if(isset($_POST["action"]))
{
 
    if($_POST["action"] == 'delete')
    {
        $id = $_POST['emp_id'];
        $api_url = "http://abc.srilanka.lk/API/Delete/delete_api.php?action=delete&emp_id=".$id."";
        $client = curl_init($api_url);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        echo $response;
    }

}


?>