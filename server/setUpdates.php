<?php header('Access-Control-Allow-Origin: *'); ?>
<?php
include 'db_connect.php';
/*
messages of the form:
<root>
    <m><i>id</i><t>message</t></m>
</root>

['uid','area','mid']
*/
if(isset($_GET['uid']) && isset($_GET['area']) && isset($_GET['message'])) { 
    $uid = $_GET['uid'];
    $area = $_GET['area'];
    $message = $_GET['message'];
    if ($stmt = $mysqli->prepare("INSERT INTO messages (user,area,message) VALUES (?,?,?)")) {
        $rc = $stmt->bind_param('sss', $uid, $area, $message); 
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