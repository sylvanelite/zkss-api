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
if(isset($_GET['uid']) && isset($_GET['area']) && isset($_GET['mid'])) { 
    $uid = $_GET['uid'];
    $area = $_GET['area'];
    $mid = $_GET['mid'];
    if ($stmt = $mysqli->prepare("SELECT id,message FROM messages WHERE (id > ? and user != ? and area = ?)")) {
        $rc = $stmt->bind_param('sss', $mid, $uid, $area); 
        if($rc === false){
            die('{error:"' . $stmt->error .'"}');
        }
        $rc = $stmt->execute(); 
        if($rc === false){
            die('{error:"' . $stmt->error .'"}');
        }
        $stmt->bind_result($messageId, $messageText);
        header ('HTTP/1.1 200 OK');
        echo "<root>";
        while ($stmt->fetch()) {
            echo "<m><i>" . $messageId . "</i>";
            echo "<t>" . $messageText . "</t></m>";
        }
        echo "</root>";
        $stmt->close();
    }else{
        die('{error:"failed"}');
    }
} else {
    die('{error:"invalid"}');
}



?>