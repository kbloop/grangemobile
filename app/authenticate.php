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

if(!isset($_POST['collegeID'], $_POST['password'])) {
    // If password or id are not recieved, send error.
    die('Please fill out College Id or Password');
}


// Retrieve all the data about the student from the database.
if(strlen((string)$_POST['collegeID']) > 3) {
    if($stmt = $con->prepare('SELECT staffNumber, pword FROM lecturerTable WHERE staffNumber = ?')){
        $stmt->bind_param('s', $_POST['collegeID']);
        $stmt->execute();
        $stmt->store_result();
    }
}
else {
        if($stmt = $con->prepare('SELECT studentID, password FROM studentTable WHERE studentID = ?')){
            $stmt->bind_param('s', $_POST['collegeID']);
            $stmt->execute();
            $stmt->store_result();
        }
}



// If we get a response.
if($stmt-> num_rows > 0 ){
    $stmt->bind_result($id, $password);
    $stmt->fetch();
    // Authenticate password.
    if(password_verify($_POST['password'], $password)) {

        session_regenerate_id();
        $_SESSION['loggedin'] = TRUE;
        $_SESSION['studentID'] = $id;
        $_SESSION['password'] = $password;
        // If correct send them to home page.
        header('Location: home.php');
    }

    else {
        $_SESSION['loginErrorMsg'] = 'Password or ID incorrect';
        header('Location: index.php');
    }
}
else {
    // Password and id incorrect.
    $_SESSION['loginErrorMsg'] = 'Password or ID does not exist';
    header('Location: index.php');
}
?>