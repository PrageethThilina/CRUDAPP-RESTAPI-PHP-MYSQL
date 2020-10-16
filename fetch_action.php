<?php

    //fetch.php

    $api_url = "http://abc.srilanka.lk/API/Read/read_api.php?action=fetch_all";

    $client = curl_init($api_url);

    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($client);

    $result = json_decode($response);

    $output = '';

    if(count($result) > 0)
    {
        foreach($result as $row)
        {
            $output .= '
            <tr>
            <td class="text-center">'.$row->emp_id.'</td>
            <td class="text-center">'.$row->emp_fname.'</td>
            <td class="text-center">'.$row->emp_lname.'</td>
            <td class="text-center">'.$row->emp_dob.'</td>
            <td class="text-center">'.$row->emp_section.'</td>
            <td class="text-center">'.$row->emp_phone.'</td>
            <td class="text-center">'.$row->emp_email.'</td>
            <td class="text-center">'.$row->emp_address.'</td>
            <td class="text-center"><a name="edit" style="margin-right:10px;" class="btn btn-warning btn-xs edit" id="'.$row->emp_id.'">Edit</a><a name="delete" class="btn btn-danger btn-xs delete" id="'.$row->emp_id.'">Delete</a></td>
            </tr>
            ';
        }
    }
    else
    {
        $output .= '
        <tr>
        <td colspan="10" align="center">No Data Found</td>
        </tr>
        ';
    }

    echo $output;

?>