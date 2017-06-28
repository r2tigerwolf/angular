<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    define("DB_NAME", "angular");
    define("TABLE_NAME", "guestbook");
    include("db.class.php");
    
    $conn = new Connect();
    $guestConn = $conn->dbconnect();
    
    $guest = new Guest; 
    
     $part = explode ("/", $_SERVER['REQUEST_URI']);
    $where = "";
    $id = end($part);   
    
	if ($id) {
        $where = " where id = " . $id;
    }
    
    $method = strtolower($_SERVER['REQUEST_METHOD']);
    $json = file_get_contents('php://input');
    $obj = json_decode($json, true);
    
    switch( $method ) {
        case "get":
            $where = '';
            $order = 'ORDER BY id ASC';
            $sqlArray = array('conn' => $guestConn, 'rows' => 'id, firstname, lastname, comment', 'table' => 'guestbook', 'join' => '', 'where' => $where, 'order' => $order, 'limit' => '');
            $routeResult = $guest->select($sqlArray); 
            $outp = '';
            
            foreach($routeResult as $key => $val) {
                if ($outp != '') {$outp .= ',';}
                $outp .= '{"id":"' . $val['id'] . '",';
                $outp .= '"firstname":"' . $val['firstname'] . '",';
                $outp .= '"lastname":"' . $val['lastname'] . '",';
                $outp .= '"method":"' . $method . '",';
                $outp .= '"comment":"' . $val['comment'] . '"}';  
            }
            
            $outp ='{"records":['.$outp.']}';
            
            echo($outp);
            break;
    
        case "put":
            $sql = "UPDATE `" . DB_NAME . "`.`" . TABLE_NAME . "` set firstname = '" . $obj['firstname'] ."', lastname = '" . $obj['lastname'] . "', comment = '" . $obj['comment'] . "' where id = ". $obj['id'];
            $sqlArray = array('conn' => $guestConn, 'rows' => 'id, firstname, lastname, comment', 'table' => TABLE_NAME);
            $routeResult = $guest->updateguest($sqlArray, $obj['id'], $obj['firstname'], $obj['lastname'], $obj['comment']); 
            break;       
    
        case "post":        
            $sqlArray = array('conn' => $guestConn, 'rows' => 'id, firstname, lastname, comment', 'table' => TABLE_NAME);
            $routeResult = $guest->insertguest($sqlArray, $obj['id'], $obj['firstname'], $obj['lastname'], $obj['comment']);
            break;
    
        case "delete":
            $sql = "DELETE FROM `" . DB_NAME . "`.`" . TABLE_NAME . "` where id = " . $obj['id'];
            $guestConn->query($sql);
            break;
    }

    function message($message) {
        if ($message === TRUE) {
    	   echo '{"message": "Successful!"}';
        } else {
            echo "{'message':'" . addslashes($conn->error) . "'}";
        }
    }
?>