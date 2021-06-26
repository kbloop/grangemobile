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
                                <!-- Add contacts -->
                                </span>
                                <button class="rm-st" type="button">
                                <i role="button" data-toggle="modal" data-target=".contacts-modal" class="icons ion-md-add-circle"></i>
                            </button>
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

        <!-- ================= Contacts Modal ==================== -->

        <div class="modal fade contacts-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                    <!-- <div class="contacts-filter input-group mb-3">
                            <input type="text" class="form-control" placeholder="Search Contacts" aria-label="Search Contacts" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                              <button class="btn btn-outline-secondary" type="button">
                                  <i class="icon ion-md-search"></i>
                              </button>
                            </div>
                          </div> -->
                    <div id="contactsList" class="list-group">
            </div>
            </div>
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

        var userIsStudent = isStudent(userID);
        var contactIsStudent = isStudent(otherID);
        var recipientID;

        function initCompose(id){
            recipientID = id;
            getUsers(buildmessages, true);

            function buildmessages(users){
                var otherperson = getUser(id, users);
                $('#contact').text(otherperson.firstName + ' ' + otherperson.lastName);

                // Never gets fired for first message to user.
                if(userID && recipientID) {
                    var arrayofmsgs=[];
                    // $_SESSION['recipientID']
                    $.ajax({
                        url: '../php/json-data-getconversation.php',
                        data: {
                            recipientID: recipientID,

                        },
                        method: 'POST'}).done(function(data){
                            if(data.success){
                                console.log(data);
                                $.each(data.messages, function(index, message){
                                    arrayofmsgs.push(message.msg);
                                    console.log(message);
                                });

                                for(var i=0; i<arrayofmsgs.length; i++){
                                    var sentbyuser = checkMatchingID(userID, arrayofmsgs[i].senderID);
                                    createMessage(arrayofmsgs[i], sentbyuser);
                                };
                            }
                            else {
                                console.log(data);
                            }

                        })


                }
                $('.contacts-modal').modal('hide');
            }
        }

            $(document).ready(function(){
                $.getJSON('../php/json-data-students.php', function(data) {

                    $.each(data.students, function(index, student) {
                        var a = document.createElement('a');
                                a.classList.add('list-group-item', 'list-group-item-action');

                                var div = document.createElement('div');
                                div.classList.add('d-flex', 'w-100', 'justify-content-between');

                                var h5 = document.createElement('h5');
                                h5.classList.add('mb-1');
                                h5.innerText = student.firstName + " " + student.lastName;

                                // Join all the elements.

                                div.appendChild(h5);
                                a.appendChild(div);

                                a.href = '#';

                                a.addEventListener('click', function(ev){
                                    // Trigger message conversation here.

                                    initCompose(student.studentID);
                                });


                        // var contactHtmlStr = `
                        // <a id="${student.studentID}" onclick=(setUserTemplate(this)) href="profile.php?${student.studentID}" class="list-group-item list-group-item-action">
                        //     <div class="d-flex w-100 justify-content-between">
                        //     <h5 class="mb-1">${student.firstName + ' ' +student.lastName}</h5>
                        //         <i class="icon ion-md-contact"></i>
                        //     </div>
                        // </a>`;

                        // Store the student information in localstorage.
                        myStorage.setItem(student.studentID, JSON.stringify(student));


                        // $('#studentData').append('<p> Student ID: ' + student.studentID+ '</p>');
                        // Append HTML
                        $('#contactsList').prepend(a);
                    });
                	});
                });





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
                            "recipient": recipientID}
                            ,
                        method: 'POST'}).done(function(response){
                            response = JSON.parse(response);
                            console.log(response);
                            var message = response.response;
                        });

                } else {
                    $.ajax( {
                        url: '../php/sendMessage.php',
                        data: {
                            "sender": userID,
                            "recipient": recipientID}
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