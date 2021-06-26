<?php

session_start();
// DB Info & Credentials
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = 'root';
$DATABASE_NAME = 'collegeData';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if(mysqli_connect_errno()){
    echo "Failed to connect to MYSQL: " . mysqli_connect_error();
}

if(!isset($_POST['messageContent'])) {
    // If password or id are not recieved, send error.
    die('{"response": "No Message Sent!", "status":"0"}');
}
else {

    $sender = $_POST['sender'];
    $recipient = $_POST['recipient'];
    $message = $_POST['messageContent'];

    if($stmt = $con->prepare('INSERT INTO Messages (senderID, recipientID, msg, msgID)
    VALUES (?, ?, ?, UUID())')){
            $stmt->bind_param('sss', $sender, $recipient, $message);
            $stmt->execute();
            $stmt->store_result();
    };

    echo '{"response": "Message Sent!", "status":"1"}';
}
?>