<?php

if(isset($_POST["action"]))
{
    if($_POST["action"] == 'insert')
    {
            $form_data = array(
            'emp_fname' => $_POST['emp_fname'],
            'emp_lname'  => $_POST['emp_lname'],
            'emp_dob' => $_POST['emp_dob'],
            'emp_section'  => $_POST['emp_section'],
            'emp_phone' => $_POST['emp_phone'],
            'emp_email'  => $_POST['emp_email'],
            'emp_address' => $_POST['emp_address'],
            );

            $api_url = "http://abc.srilanka.lk/API/Create/create_api.php?action=insert";

            $client = curl_init($api_url);
            curl_setopt($client, CURLOPT_POST, true);
            curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
            curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($client);
            curl_close($client);
            $result = json_decode($response, true);
            foreach($result as $keys => $values)
            {
                if($result[$keys]['success'] == '1')
                {
                    echo 'insert';
                }
                else
                {
                    echo 'error';
                }
            }
    }

    if($_POST["action"] == 'fetch_single')
    {
        $id = $_POST["emp_id"];
        $api_url = "http://abc.srilanka.lk/API/Update/update_api.php?action=fetch_single&emp_id=".$id."";

        $client = curl_init($api_url);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        echo $response;
    }

    if($_POST["action"] == 'update')
    {
        $form_data = array(
        'emp_fname' => $_POST['emp_fname'],
        'emp_lname'  => $_POST['emp_lname'],
        'emp_dob' => $_POST['emp_dob'],
        'emp_section'  => $_POST['emp_section'],
        'emp_phone' => $_POST['emp_phone'],
        'emp_email'  => $_POST['emp_email'],
        'emp_address' => $_POST['emp_address'],
        'emp_id'   => $_POST['hidden_id']
        );

        $api_url = "http://abc.srilanka.lk/API/Update/update_api.php?action=update";
        $client = curl_init($api_url);
        curl_setopt($client, CURLOPT_POST, true);
        curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        curl_close($client);
        $result = json_decode($response, true);
        foreach($result as $keys => $values)
        {
            if($result[$keys]['success'] == '1')
            {
                echo 'update';
            }
            else
            {
                echo 'error';
            }
        }
    }
}

?>