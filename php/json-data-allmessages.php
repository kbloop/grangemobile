<?php
session_start();

if(!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
    exit();
}

$user = $_SESSION['studentID'];


// DB Info & Credentials
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = 'root';
$DATABASE_NAME = 'collegeData';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if(mysqli_connect_errno()){
    echo "Failed to connect to MYSQLI: " . mysqli_connect_error();
}




// Get all messages sent to a student.
if($stmt = $con->prepare('SELECT * FROM Messages WHERE senderID = ? OR recipientID = ?')){
    $stmt->bind_param('ss', $_SESSION['studentID'], $_SESSION['studentID']);
    $stmt->execute();
    $stmt->store_result();
}
// If we recieve a response.
if($stmt-> num_rows > 0){
    // Response array for JSON
    $response = array();
    // Where Messages will be stored in JSON
    $response['messages'] = array();
    $stmt->bind_result($sender_id, $recipient_id, $timestamp, $msg_id, $msg);

    while($stmt->fetch())
    {
        $message = array();
        $message["msgID"] = $msg_id;
        $message["senderID"] = $sender_id;
        $message["recipientID"] = $recipient_id;
        $message["msg"] = $msg;
        $message["timestamp"] = $timestamp;

        array_push($response['messages'], $message);
    }

    // The call was successfull/
    $response['success'] = 1;

    // Send JSON
    print (json_encode($response));
}
else {
    $response['success'] = 0;
    $response['message'] = "no messages to show.";
    // Send JSON
    print (json_encode($response));
}

?>