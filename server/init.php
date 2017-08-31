<?php header('Access-Control-Allow-Origin: *'); ?>
<?php
include 'db_connect.php';

if ($stmt = $mysqli->prepare("SELECT MAX(id) FROM messages")) {
    $rc = $stmt->execute(); 
    if($rc === false){
        die('{error:"' . $stmt->error .'"}');
    }
    $stmt->store_result();
    if($stmt->num_rows === 1) {
        $stmt->bind_result($db_id);
        $stmt->fetch();
        header ('HTTP/1.1 200 OK');
        echo $db_id;
    }
    //try delete old messages
    try {
        if ($delStmt = $mysqli->prepare("DELETE FROM messages WHERE timestamp < UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL 7 DAY))")) {
            $delRc = $delStmt->execute();
        }//no else, silent failure
    } catch (Exception $e) {
        //silently absorb old messages. it's not impertive if a delete fails
    }
}else{
    die('{error:"failed"}');
}

?>