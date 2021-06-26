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
    <i class="text-dark icon ion-md-calendar"></i>
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

<nav class="p-0 navbar fixed-bottom navbar-inverse bg-light">

<div class=" p-0 col-12" id="navbarNav">
    <ul class="p-0 row m-0 list-inline">
        <li class="p-2 list-inline-item text-center inline-icon-menu-5 m-0">
            <a class="text-primary icon-menu-link" href="home.php">
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
            <a class="text-dark icon-menu-link" href="inbox.php">
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


        <div class="container">
            <div class="row">
                <div class="col-12" id="alertgroupParent">
                    <h2 class="main">
                        Notifications
                    </h2>
                    <ul id="alertgroupTarget" class="listgroup pl-0">

                        <li role="alert" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center list-group-item-primary alert alert-dismissible fade show">
                            <a href="message.php">
                                    Message from @lecturer
                            </a>

                            <!-- <i class="icon ion-md-close"></i> -->
                            <button onclick="showItems(this)" type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                            </button>
                        </li>
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center list-group-item-danger alert alert-dismissible fade show">
                            <a href="module.html" class="module">
                            Hand in date missed by 2hrs
                            </a>
                            <!-- <i class="icon ion-md-close"> -->
                            <button onclick="showItems(this)" type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                            </button>
                            </i>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- ================== CALENDAR SCHEDULE ===================== -->

        <div class="container-fluid pb-5 mb-2">
            <div class="row">
                <div class="col-12">
                    <h2>Schedule</h2>
                    <nav class="calendarbar navbar navbar-dark bg-dark">
                        <a href="#" class="navbar-brand">
                            <i class="icon ion-md-arrow-dropleft"></i>
                        </a>
                        <a id="ScheduleDate"class="text-light dateStr navbar-text">Wednesday 20th</a>
                        <a href="#" class="navbar-brand">
                            <i class="icon ion-md-arrow-dropright"></i>
                        </a>
                        <ul class="navbar-nav">
                            <li class="navbar-item">
                                <a href="#" class="text-light navbar-link">
                                    <i class="icon ion-md-settings"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <ul class="schedule-calendar list-group list-group-flush">
                            <li class="list-group-item">
                                    <span class="calendarTimeIndicator">9</span>
                            </li>
                            <li class="list-group-item">
                                    <span class="calendarTimeIndicator">10</span>
                            </li>
                            <li class="list-group-item">
                                    <span class="calendarTimeIndicator">11</span>
                            </li>
                            <li id="timeslot-12" class="list-group-item">
                                <span class="calendarTimeIndicator">12</span>

                            </li>
                            <li id="timeslot-13" class="list-group-item">
                                <span class="calendarTimeIndicator">13</span>

                            </li>
                            <li id="timeslot-14" class="list-group-item">
                                <span class="calendarTimeIndicator">14</span>
                            </li>
                            <li id="timeslot-15" class="list-group-item">
                                <span class="calendarTimeIndicator">15</span>
                                <div data-toggle="modal" data-target="#moduleModal" class="event clickable bg-info align-items-center">
                                        <p class="align-items-center text-center"> Law <span> C109</span></p>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <span class="calendarTimeIndicator">16</span>
                            </li>
                            <li class="list-group-item">
                                <span class="calendarTimeIndicator">17</span>
                            </li>
                            <li class="list-group-item">
                                <span class="calendarTimeIndicator">18</span>
                            </li>
                          </ul>
                </div>
            </div>
        </div>

        <!-- Bootstrap, jQuery and popper.js -->
        <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <!-- Iconic icons -->
        <link href="https://unpkg.com/ionicons@4.5.5/dist/css/ionicons.min.css" rel="stylesheet">
        <script src="scripts/maps.js"></script>
        <script src="scripts/script.js"></script>

      <!-- Modal -->
      <div class="modal fade" id="moduleModal" tabindex="-1" role="dialog" aria-labelledby="moduleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div id="modalContent" class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="moduleModalLabel">Economics <span>C102</span></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p id='modal-module-location'>Room #323, Building HG.</p>
              <div class="col-12" id="map">map</div>
            </div>
            <b>Mode of Travel: </b>
            <select id="mode">
              <option value="DRIVING">Driving</option>
              <option value="WALKING">Walking</option>
              <option value="BICYCLING">Bicycling</option>
              <option value="TRANSIT">Transit</option>
            </select>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <a id="modal-module-link" href="module.html?999002" role="button" class="btn btn-primary">Go to module</a>
            </div>
            <div id="floating-panel">
          </div>
        </div>

    </div>
    <script>
        var userID = <?php echo $user; ?>;
        console.log(`user: ${userID} is logged in, student status: ` + isStudent(userID));

        $(document).ready(function(){
            // Get the currently loggedin user.
            // First get all users, then get the individual that matches.
            var usertype = isStudent(userID);
            var allUsers = getUsers(setSchedule, usertype);

            // Modal content parent
            var modalTarget = $('#modalContent');


            // Request modules data be passed onto setSchedule callback.
            // var modules = getModules(setSchedule);

            function setSchedule(allusers){
                // All users
                var users = allusers;
                // Our user
                var user = getUser(userID, allusers);
                var course = user.courseID;
                //  Get modules from localstorage


                getModules(createModuleTemplate);



                function createModuleTemplate(modules) {

                    var module1 = getModule(user.moduleNo1, modules);
                    var module2 = getModule(user.moduleNo2, modules);

                    // Since there is no classtimes available for the modules
                    // I am using placeholder timeslots, but the functionality
                    // would work if the timeSlots information was passed in dynamically.


                    // This is where, if they had more modules assosiated it would
                    // loop until all of their Modules.length.

                    // First module calendar info.
                    var div1 = document.createElement('div');
                    div1.addEventListener('click', function(){
                        setModal(module1);
                    });
                    div1.classList.add('event', 'clickable', 'bg-primary', 'align-items-center');

                    var par1 = document.createElement('p');
                    par1.classList.add('align-items-center', 'text-center');
                    par1.innerText = module1.moduleName;
                    par1.id = "moduleName";
                    var span1 = document.createElement('span');
                    span1.innerText = " "+module1.moduleNo;
                    span1.id = "moduleNo";

                    par1.appendChild(span1);
                    div1.appendChild(par1);

                    // Second module calendar info.
                    var div2 = document.createElement('div');
                    div2.addEventListener('click', function(){
                        setModal(module2);
                    });
                    div2.classList.add('event', 'clickable', 'bg-secondary', 'align-items-center', 'bg-info');

                    var par2 = document.createElement('p');
                    par2.classList.add('align-items-center', 'text-center');
                    par2.innerText = module2.moduleName;
                    par2.id = "moduleName";
                    var span2 = document.createElement('span');
                    span2.innerText = " "+module2.moduleNo;
                    span2.id = "moduleNo";

                    par2.appendChild(span2);
                    div2.appendChild(par2);

                    // Placeholder times used now but this is where
                    // "#timeslot-" + timeVariable; would be used
                    // if that info was available.
                    $('#timeslot-12').append(div1);
                    $('#timeslot-15').append(div2);
                }
            }

        });

        // Sets the modal popup to contain the relevant information
        // of whatever calendar event triggered it.

        function setModal(module) {
        $("#moduleModal").modal('show');
        $("#moduleModalLabel").text(module.moduleName + " " + module.moduleNo);
        $("#moduleModalLabel").text(module.moduleName + " " + module.moduleNo);
        $("#modal-module-location").text("Room: "+module.room+", Building: "+module.location);
        $("#modal-module-link").attr('href', "module.html?"+module.moduleNo);
            // Get users location and use it to guide to module location.
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(pos){

                    var userLatLng = {lat: pos.coords.latitude, lng: pos.coords.longitude};
                    // createModuleMarker(module);

                    var modulelocation = {lat: Number(module.lat), lng: Number(module.long)};

                    loadDirections(userLatLng, modulelocation);
                });
                } else {
                    // else return dublins lat lng as default.

                    var userLatLng = {lat: 53.3498, lng: -6.2603};
                    // createModuleMarker(module);

                    var modulelocation = {lat: Number(module.lat), lng: Number(module.long)};

                    loadDirections(userLatLng, modulelocation);
                }
            }


        function notificationsDisplay(){
            var notificationsParentHTML = $('#alertgroupTarget');
            var htmlSTR = `<li role="alert" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center list-group-item-primary alert alert-dismissible fade show">
                            <a href="message.php">
                                    Message from @lecturer
                            </a>

                            <!-- <i class="icon ion-md-close"></i> -->
                            <button onclick="showItems(this)" type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                            </button>
                        </li>`;
            notificationsParentHTML.innerHTML = ' ';

        }
        notificationsDisplay();
        var today = new Date();
        var week = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
        var date = today.getDate();
        switch(date){

            default:
            date+="th";
            break;
            case 1:
            date += "st";
            break;
            case 2:
            date += "nd";
            break;
            case 3:
            date += "rd";
            break;
            case 21:
            date += "st";
            break;
            case 22:
            date += "nd";
            break;
            case 23:
            date += "rd";
            break;
            case 31:
            date += "st";
            break;

        }




        $('#ScheduleDate').text(week[today.getDay()] + " " + date);
    </script>
    <script async defer
        src=
        "https://maps.googleapis.com/maps/api/js?libraries=places,geometry,drawing&key=AIzaSyDsIL5AgB8LOigO0Jc8ylPQxyS3on3smqw&v=3&callback=initMap">
    </script>
    </body>
</html>