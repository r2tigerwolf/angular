<?php    
    class Connect {
        private $db_host = 'localhost';
        private $db_user = 'root';
        private $db_password = '';
        private $db_db = 'angular';
    
        function dbconnect(){           
            $conn = mysqli_connect($this->db_host, $this->db_user, $this->db_password, $this->db_db);
            return $conn;
        }
    } 
   
    class Guest {
        private $result;
        
        public function insertguest($sqlArray, $id, $firstname, $lastname, $comment) {
            $sql = "INSERT INTO `guestbook` (" . $sqlArray['rows'] . ") VALUES ('". $id . "', '" . $firstname ."', '" . $lastname ."', '". $comment ."')";
            $sqlArray['conn']->query($sql);
        }
        
        public function updateguest($sqlArray, $id, $firstname, $lastname, $comment) {
            $sql = "UPDATE `" . DB_NAME . "`.`" . TABLE_NAME . "` set firstname = '" . $firstname ."', lastname = '" . $lastname . "', comment = '" . $comment . "' where id = ". $id;
            $sqlArray['conn']->query($sql);
        }
        public function deleteguest($id) {
            $sql = "DELETE from " . TABLE_NAME . " where id = " . $id;
        }
        public function select($sqlArray) {

            if($sqlArray['where']) {
                $sqlArray['where'] = ' WHERE ' . $sqlArray['where'];
            }
            
            $sql = 'SELECT ' . $sqlArray['rows'] . ' FROM `' . $sqlArray['table'] . '` ' . $sqlArray['join'] . $sqlArray['where'] . ' ' . $sqlArray['order'] . ' ' . $sqlArray['limit'];

            $result =  $sqlArray['conn']->query($sql);
            $keyResult = $sqlArray['conn']->query($sql);
                        
            $guestInfo = array_keys($keyResult->fetch_assoc());
            
            if($result->num_rows) { 
                $i = 0;
                
                while ($bus = $result->fetch_assoc()) {
                    for($j = 0; $j < count($guestInfo); $j++) {
                        $this->result[$i][$guestInfo[$j]] = $bus[$guestInfo[$j]];
                    }
                    $i++;
                }
      
                return $this->result;
                mysqli_close($con); 
            }
            else {
                return false;
                mysqli_close($con); 
            }
        }
    }
?>