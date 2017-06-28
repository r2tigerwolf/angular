<?php
    $data = json_decode(file_get_contents("php://input"));
    $data_string = json_encode($data);
    
    $ch = curl_init('http://localhost/rubber/angular/rest/rest.php');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string))
    );
    
    $result = curl_exec($ch);
?>