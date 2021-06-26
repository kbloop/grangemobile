<?php
session_start();

if(!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
    exit();
}

$userID = $_SESSION['studentID'];


// DB Info & Credentials
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = 'root';
$DATABASE_NAME = 'collegeData';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if(mysqli_connect_errno()){
    echo "Failed to connect to MYSQLI: " . mysqli_connect_error();
}

$senderID = $_GET["sender"];

// Get all messages sent to a student from this id,
// And all the messages sent back to them.


if($stmt = $con->prepare('SELECT * FROM Messages WHERE (recipientID = ' . $userID .' OR recipientID =' .$senderID. ') AND (senderID = ' . $userID .' OR senderID =' .$senderID.')')){

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
    // print (json_encode($response));
}
else {
    $response['success'] = 0;
    $response['message'] = "no messages to show.";
    // Send JSON
    // print (json_encode($response));
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
   <!-- ========== TOP NAVIGATION ============ -->
<nav class="navbar navbar-expand-lg navbar-light ">
<!-- Brand -->
<a href="home.php" class="navbar-brand">
    <i class="icon ion-md-calendar"></i>
    GrangeMobile
</a>
<!-- Toggler -->
<button id="profileMenuBtn" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#topNav"
    aria-controls="topNav" aria-expanded="false" aria-label="Toggle navigation">
    <i class="text-dark icon ion-md-contact"></i>
</button>
<div class="collapse navbar-collapse" id="topNav">
    <ul class="p-3 navbar-nav ml-auto offset-8 col-4 bg-light">
        <li class="nav-item">
            <a class="nav-link" href="profile.php">
                <i class="icon ion-md-contact"></i>
                Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php">
                <i class="icon ion-md-power"></i>
                Logout</a>
        </li>
    </ul>

    </ul>
</div>
</nav>

<!-- =========== END OF TOP NAVBAR ============= -->

<!-- =========== BOTTOM NAVBAR ============= -->

<nav class="p-0 navbar hidden-all fixed-bottom navbar-inverse bg-light">

<div class=" p-0 col-12" id="navbarNav">
    <ul class="p-0 row m-0 list-inline">
        <li class="p-2 list-inline-item text-center inline-icon-menu-5 m-0">
            <a class="text-dark icon-menu-link" href="home.php">
                <i class="icon ion-md-home"></i>
                <small class="hidden-xs">Home</small>
            </a>
        </li>
        <li class="p-2 list-inline-item text-center inline-icon-menu-5 m-0">
            <a class="text-dark icon-menu-link" href="news.html">
                <i class="icon ion-md-paper"></i>
                <small class="hidden-xs">News</small>
            </a>
        </li>
        <li class="p-2 list-inline-item text-center inline-icon-menu-5 m-0">
            <a class="text-primary icon-menu-link" href="inbox.php">
                <i class="icon ion-md-mail"></i>
                <small class="hidden-xs">Messages</small>
            </a>
        </li>
        <li class="p-2 list-inline-item text-center inline-icon-menu-5 m-0">
            <a class="text-dark icon-menu-link" href="modules.html">
                <i class="icon ion-md-briefcase"></i>
                 <small class="hidden-xs"> Modules </small>
            </a>
        </li>
        <li class="p-2 list-inline-item text-center inline-icon-menu-5 m-0">
            <a class="text-dark icon-menu-link" href="contacts.html">
                <i class="icon ion-md-contacts"></i>
                <small class="hidden-xs"> Contacts </small>
            </a>
        </li>

    </ul>
</div>
</nav>

<!-- =========== END OF BOTTOM NAVBAR ============= -->


        <div class="container pb-5 mb-5">
            <div class="row">

                <!--  -->
                <div class="mt-3 col-12">
                    <!-- <h2 class="main">
                        Messages
                    </h2> -->
                </div>
            </div>
            <div class="row">
                <div id="message-list" class="col-12">
                        <!-- <h4 class="mb-1">Message Subject</h4> -->
                        <h5>
                                <span id="contact" class="badge badge-pill badge-secondary bg-primary">
                                Loading..
                                </span>
                                <!-- <button id="conactsbtn"class="rm-st" type="button">
                                <i role="button" data-toggle="modal" data-target=".contacts-modal" class="icons ion-md-add-circle"></i>
                            </button> -->
                        </h5>

                </div>
                <form action="" method="post" id="messageInput" class="p-0 col-12 mb-0">
                    <div class="input-group">
                        <input id="messageContent" type="text" name="messageContent" placeholder="Enter message.." class="form-control">
                        <div class="input-group-btn">
                            <button id="sendMessage" class="btn btn-default btn-primary" type="button">
                                <i class="icon ion-md-send"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>

        <!-- Bootstrap, jQuery and popper.js -->
        <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

        <!-- Iconic icons -->
        <link href="https://unpkg.com/ionicons@4.5.5/dist/css/ionicons.min.css" rel="stylesheet">

        <script src="scripts/script.js"></script>
        <script>
            var userID = <?php if($userID) {echo $userID;} else {echo "false";} ?>;
            var otherID = <?php if($senderID) {echo $senderID;} else {echo "false";}?>;
            var usertype = isStudent(userID);
            if(usertype) {
                    $("#conactsbtn").hide();
                    $("#messageInput").hide();
            }
            var userIsStudent = isStudent(userID);
            var contactIsStudent = isStudent(otherID);

            var group = getUsers(buildmessages, contactIsStudent);

            function buildmessages(users){

                var otherperson = getUser(otherID, users);
                $('#contact').text(otherperson.firstName + ' ' + otherperson.lastName);
                if(userID && otherID) {
                    var arrayofmsgs = <?php echo json_encode($response)?>.messages;
                    for(var i=0; i<arrayofmsgs.length; i++){
                        var sentbyuser = checkMatchingID(userID, arrayofmsgs[i].senderID);
                        createMessage(arrayofmsgs[i], sentbyuser);
                    };
                }

            }
            function checkMatchingID(id, id2) {
                if(id === id2){
                    return true;
                } else {
                    return false;
                }
            }

            function createMessage(message, sentbyuser) {
                var contact;
                if(sentbyuser){
                    contact=message.recipientID;
                    msgHTMLstr = `
                    <div class="offset-2 col-10 message active right badge-secondary">
                        <p class="message-body">
                                ${message.msg}
                        </p>
                    </div>
                    `;
                } else {
                    contact = message.senderID;
                    msgHTMLstr = `
                    <div class="col-10 message left badge-secondary">
                        <p class="message-body">
                        ${message.msg}
                        </p>
                    </div>
                    `;
                }
                $('#message-list').append(msgHTMLstr);
            }



            // sending message

            $('#sendMessage').click(function(){
                var message = $('#messageContent').val();
                // Clear the message after sending.
                $('#messageContent').val('')

                if(message.length){
                    $.ajax( {
                        url: '../php/sendMessage.php',
                        data: {
                            "messageContent" : message,
                            "sender": userID,
                            "recipient": otherID}
                            ,
                        method: 'POST'}).done(function(response){
                            response = JSON.parse(response);

                            var responseMessage = response.response;
                            msgHTMLstr = `
                            <div class="offset-2 col-10 message active right badge-secondary">
                                <p class="message-body">
                                ${message}
                                </p>
                            </div>
                            `;
                            $('#message-list').append(msgHTMLstr);
                        });

                } else {
                    $.ajax( {
                        url: '../php/sendMessage.php',
                        data: {
                            "sender": userID,
                            "recipient": otherID}
                            ,
                        method: 'POST'}).done(function(response){
                            response = JSON.parse(response);
                            var message = response.response;
                            console.log(message);
                        });
                }
            });

        </script>
    </body>
</html>