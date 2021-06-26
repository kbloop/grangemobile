<?php
session_start();

if(!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
    exit();
}

$user = $_SESSION['studentID'];

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
    <i class="icon ion-md-contact"></i>
</button>
<div class="collapse navbar-collapse" id="topNav">
    <ul class="p-3 navbar-nav ml-auto offset-8 col-4 bg-light">
        <li class="nav-item">
            <a class="nav-link" href="profile.php">
                <i class="text-dark icon ion-md-contact"></i>
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

<nav class="p-0 navbar fixed-bottom navbar-inverse bg-light">

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


        <div class="container mb-5 pb-5">
            <div class="row mt-4">
                <!-- Adding compose option for lecturers only  -->
                <div id="compose" class="col-12 compose">
                    <a role="button" href="compose.php" class="text-white col-12 btn btn-primary">
                        Compose
                    </a>
                </div>


                <!--  -->
                <div class="mt-3 col-12">
                    <h2 class="main">
                        Inbox
                    </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div id="inboxList" class="list-group">

                    </div>
                </div>
            </div>

        <!-- Bootstrap, jQuery and popper.js -->
        <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

        <!-- Iconic icons -->
        <link href="https://unpkg.com/ionicons@4.5.5/dist/css/ionicons.min.css" rel="stylesheet">

        <script src="scripts/script.js" ></script>

        <script>
        // Global Users var.
        var Users = {};


        var userID = <?php echo $user; ?>;
        console.log(`${userID} is logged in, student: ${isStudent(userID)}`);

        // Wait until the page is loaded.
        // Get all messages sent to user.
        $(document).ready(function(){
            var usertype = isStudent(userID);
            if(usertype) {
                    $("#compose").hide();
            }
        		$.getJSON('../php/json-data-allmessages.php', function(data) {
                if(data.success){

                // get all users and pass them to the createmessages function.
                getUsers(createMessages, usertype);

                // Wait until the users are loaded via getUsers() and pass them in.
                function createMessages(users) {

                    /*
                        All users the same type as whoever is logged in.

                        i.e. If lecturer is logged in we have the rest of lecturers,
                        if student we have all the students.
                    */
                    var allUsers = users;


                    /* -----------------------------------------
                    LOOP over all the messages to output them
                    & get info about the sender & recipients.
                    */
                   getUsers(function(allstudents){
                       $.each(data.messages, function(index, message) {

                           if (message.recipientID !== recipient){

                                var recipient = getUser(message.recipientID, allstudents);
                                var recipientCopy = recipient;
                                recipient = recipient.firstName + " " + recipient.lastName

                            } else
                            {
                                // The logged in user is the recipient.
                                var recipient = getUser(userID, allUsers);
                                var recipientCopy = recipient;
                                recipient = recipient.firstName + " " + recipient.lastName
                            }
                                // Time now & msg sent at.
                            var currentDate = new Date();

                            var sentDate = new Date(message.timestamp);
                                // Get the difference so it can be present in 'x hours ago' format.
                            var time = getTimeDifference(currentDate, sentDate);

                            // Incase the messages are sent on different days.
                            // Help found at:
                            // https://stackoverflow.com/questions/1787939/check-time-difference-in-javascript

                            if(currentDate < sentDate) {
                                sentDate.setDate(sentDate.getDate() + 1)
                            }
                            // Check if the sender and user type are the same
                            // Or just get whatever type is needed for each.
                            var senderType = isStudent(message.senderID);
                            var sender = " " ;

                            // If they are different they require different set of user data.
                            // If not we can use the same one.
                            if(senderType !== usertype){

                                // Another way of using a callback function.
                                // https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Functions/Arrow_functions

                                getUsers((users) => {
                                    // All users of the same type as the sender so we can grab senders info.

                                    sender = getUser(message.senderID, users);
                                    appendMessageList(sender);
                                    // senderType below is the second param in the getUser function.
                                }, senderType);

                            }
                            //  They are of the same type, so use the same dataset.
                            else {
                                var sender = getUser(message.senderID, allUsers);
                                appendMessageList(sender);
                            }




                            function appendMessageList(sender){
                                if((sender.staffNumber || sender.studentNumber)== userID){
                                    // Swap the names around so it's easier to read.
                                    var senderobj = recipientCopy;
                                    recipient = sender.firstName + " " + sender.lastName;
                                } else {
                                    var senderobj = sender;
                                }

                                sender = senderobj.firstName + " " + senderobj.lastName;

                                // Only show a snippet of the full message.
                                if(message.msg.length > 30) {
                                    message.msg = message.msg.slice(0,30);
                                    message.msg+="...";
                                } else {
                                    message.msg = message.msg;
                                }

                                var a = document.createElement('a');
                                a.classList.add('list-group-item', 'list-group-item-action');

                                var div = document.createElement('div');
                                div.classList.add('d-flex', 'w-100', 'justify-content-between');

                                var h5 = document.createElement('h5');
                                h5.classList.add('mb-1');
                                h5.innerText = sender;

                                var small = document.createElement('small');
                                small.innerText = time;

                                var p = document.createElement('p');
                                p.innerText = message.msg;

                                var small2 = document.createElement('small');
                                small2.classList.add('text-secondary');
                                small2.innerText = recipient;

                                // Join all the elements.

                                div.appendChild(h5);
                                div.appendChild(small);

                                a.appendChild(div);
                                a.appendChild(p);
                                a.appendChild(small2);

                                a.href = 'message.php?sender=';
                                a.href += (senderobj.staffNumber || senderobj.studentID);

                                a.addEventListener('click', function(ev){
                                    // Post new page data with ajax here.

                                    var conversationURL = 'message.php';

                                    // $.ajax({
                                    //     type: 'get',
                                    //     url: conversationURL,
                                    //     data: senderobj,
                                    //     dataType: 'text json',
                                    //     contentType: 'application/json; charset=utf-8',
                                    //     success: function(response){
                                    //         console.log('success');
                                    //         console.log(response);

                                    //     },
                                    //     error: function(xhr){
                                    //         console.log("error");
                                    //         console.log(xhr.status);
                                    //         console.log(xhr.statusText);
                                    //     }
                                    // })


                                });

                                // Replaced with created elements to append event listeners and pass in vars.
                                var mdlHTMLStr =
                                `
                                <a href="message.php?${senderobj.staffNumber || senderobj.studentID + "#" + message.msgID}" class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1 ">${sender}</h5>
                                    <small>${time}</small>
                                    </div>
                                    <p class="mb-1">${message.msg}</p>
                                    <small class="text-secondary">to ${recipient}</small>
                                    </a>
                                `;


                                $('#inboxList').append(a);
                                }
                            });
                   }, true);
                    }
                }
                else {// Replaced with created elements to append event listeners and pass in vars.
                    var noMsgsHTMLstr =
                    `
                    <a class="alert alert-danger">
                        <p class="mb-1">No messages to be found</p>
                    </a>
                    `;
                    $('#inboxList').append(noMsgsHTMLstr);
                }
        	});
        });

        function getTimeDifference(timeOne, timeTwo){
            var difference = timeOne - timeTwo;

            var msec = difference;
            var days = Math.floor(msec / 1000 / 60 / 60 / 24)
            msec -= days * 1000 * 60 * 60 *24;
            // Hour differential
            var hrs = Math.floor(msec /1000 / 60 / 60);
            msec -= hrs * 1000 * 60 * 60;
            // Minutes differential
            var mins = Math.floor(msec / 1000 / 60);
            msec -= mins * 1000 * 60;

            // Not used, too indepth
            // Seconds differential
            var secs = Math.floor(mins / 1000);
            msec -= secs * 1000;

            if(days > 0){
                return days+"d "+hrs+"hrs "+mins+"mins ago";
            }
            else {
                return hrs+"hrs "+mins+"mins ago";
            }
        }
        </script>
    </body>
</html>