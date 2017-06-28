<?php
    $urlParts = explode('/',$_SERVER['REQUEST_URI']);
    $method = end($urlParts);
    
    $data = json_decode(file_get_contents("php://input"));    
    $data_string = json_encode($data);
    $ch = curl_init('http://localhost/rubber/angular/rest/rest.php');
    
    switch( $method ) {
        case "get":
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            break;
        case "put":
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            break;
        case "post":
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            break;
        case "delete":
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
            break;
    }
    
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string))
    );
    $result = curl_exec($ch);
    echo $result;    
?>