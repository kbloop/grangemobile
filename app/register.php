<?php

session_start();
// DB Info & Credentials
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = 'root';
$DATABASE_NAME = 'collegeData';


$isStudent;

// Connect to db.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if(mysqli_connect_errno()){
    echo "Failed to connect to MYSQL: " . mysqli_connect_error();
}

if(!isset($_POST['collegeID'], $_POST['password'])) {
    // If password or id are not recieved, send error.
    $id = $_POST['collegeID'];
    die('Please fill out College Id or Password');
}


// Retrieve all the data about the lecturers from the database.
if(strlen((string)$_POST['collegeID']) == 6) {
    if($stmt = $con->prepare('SELECT staffID, password FROM lecturerTable WHERE staffID = ?')){
        $stmt->bind_param('s', $_POST['collegeID']);
        $stmt->execute();
        $stmt->store_result();
    }
}
else {
// Else: Retrieve data about Students.
    if($stmt = $con->prepare('SELECT studentID, password FROM studentTable WHERE studentID = ?')){
        $stmt->bind_param('s', $_POST['collegeID']);
        $stmt->execute();
        $stmt->store_result();
    }
    $isStudent = true;
}



// If we get a response, their account already exists.
if($stmt-> num_rows > 0 ){
    header('Location: index.php');
}
else {
    // Create an account.
    if($isStudent) {
        // $sql = "INSERT INTO studentTable (firstname, lastname, studentID, moduleNo1, moduleNo2, courseID )
        // VALUES ('John', 'Doe', '.$id.', '99906', '99903', '888001')";

        if ($con->query($sql) === TRUE) {
            echo "New record created successfully";
            echo $id;
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }

        $con->close();
    }
    elseif ($isStudent != true) {
        // $sql = "INSERT INTO MyGuests (firstname, lastname, email)
        // VALUES ('John', 'Doe', 'john@example.com')";

        if ($con->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }

        $con->close();
    }


    else {
        echo 'Password or ID incorrect';
        // header('Location: index.php');
    }
    session_regenerate_id();
        $_SESSION['loggedin'] = TRUE;
        $_SESSION['studentID'] = $id;
        $_SESSION['password'] = $password;
        // If correct send them to home page.
        header('Location: home.php');
}
?>
<!DOCTYPE html>
<!--
License Info
-->
<html>
    <head>
        <title>Grange Mobile</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="style/main.css">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="text-center">Grange Mobile</h1>
                    <h2 class="main">
                        Sign up
                    </h2>
                    <form action="onboard.html">
                        <div class="form-group">
                            <label for="signupPassword" class="input-label">Enter Password</label>
                            <input type="password" id="signupPassword" class="form-control" aria-describedby="passwordHelp" placeholder="Enter Password">
                        </div>
                        <div class="form-group">
                        <label for="confirmPassword" class="input-label">Confirm Password</label>
                            <input type="password" id="confirmPassword" class="form-control" aria-describedby="passwordHelp" placeholder="">
                        </div>
                        <div class="form-group">
                        <label for="inputMobile" class="input-label">Add Mobile Number</label>
                            <input type="number" id="inputMobile" class="form-control" aria-describedby="numberHelp" placeholder="Enter Mobile Number">
                        </div>

                        <button type="submit" class="btn btn-primary">Continue</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Bootstrap, jQuery and popper.js -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <!-- Iconic icons -->
        <link href="https://unpkg.com/ionicons@4.5.5/dist/css/ionicons.min.css" rel="stylesheet">
    </body>
</html>