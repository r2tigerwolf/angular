<?php
    $ch = curl_init('http://localhost/rubber/angular/rest/');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");    
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);
    echo $result;    
?>