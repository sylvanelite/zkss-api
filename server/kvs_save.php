<?php header('Access-Control-Allow-Origin: *'); ?>
<?php
include 'db_connect.php';

if(isset($_POST['data_key']) && isset($_POST['data_value'])) { 
    $key = $_POST['data_key'];
    $value = $_POST['data_value'];
    $stmtStr = "INSERT INTO kvs (data_key, data_value) ";
    $stmtStr = $stmtStr  . " VALUES (?, ?) ";
    $stmtStr = $stmtStr  . " ON DUPLICATE KEY UPDATE ";
    $stmtStr = $stmtStr  . " data_key=?, data_value=?";
    if ($stmt = $mysqli->prepare($stmtStr)) {
        $rc = $stmt->bind_param('ssss', $key, $value, $key, $value); 
        if($rc === false){
            die('{error:"' . $stmt->error .'"}');
        }
        $rc = $stmt->execute(); 
        if($rc === false){
            die('{error:"' . $stmt->error .'"}');
        }
        $stmt->close();
        header ('HTTP/1.1 200 OK');
        echo "success";
    }else{
        die('{error:"failed"}');
    }
} else {
    die('{error:"invalid"}');
}



?>