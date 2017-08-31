<?php header('Access-Control-Allow-Origin: *'); ?>
<?php
include 'db_connect.php';

if(isset($_POST['data_key'])) { 
    $key = $_POST['data_key'];
    if ($stmt = $mysqli->prepare("SELECT data_value FROM kvs WHERE (data_key=?)")) {
        $rc = $stmt->bind_param('s', $key); 
        if($rc === false){
            die('{error:"' . $stmt->error .'"}');
        }
        $rc = $stmt->execute(); 
        if($rc === false){
            die('{error:"' . $stmt->error .'"}');
        }
        $stmt->bind_result($value);
        header ('HTTP/1.1 200 OK');
        while ($stmt->fetch()) {
            echo $value;
        }
        $stmt->close();
    }else{
        die('{error:"failed"}');
    }
} else {
    die('{error:"invalid"}');
}



?>