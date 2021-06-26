<?php

session_start();


if(!isset($_SESSION['loggedin'])){
    header('Location: index.php');
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


            <div class="container pb-5 mb-5">
                <div class="row">
                    <div id="profileInformation" class="col-12">

                    </div>
                </div>
            </div>


        <!-- Bootstrap, jQuery and popper.js -->
        <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <!-- Iconic icons -->
        <link href="https://unpkg.com/ionicons@4.5.5/dist/css/ionicons.min.css" rel="stylesheet">
        <!-- My script -->
        <script src="scripts/script.js"></script>

        <script>

        $('document').ready(function (){
            // Get url so the address bar always sets the page. Individual links to each page so people can
            // go to  a profile from their search history.
            var url = window.location.href;
            var qmark = url.indexOf('?');

            var id = url.slice(qmark+1, url.length);

            // if there is no profile query.
            // Go to the users own profile.
            if (qmark === -1) {
                id = <?php echo $_SESSION['studentID']; ?>;
            }
            loadProfileTemplate(id);
        });



        function loadProfileTemplate(studentid) {

            var targ = $('#profileInformation');
            var isset = myStorage.getItem(123);
            var profile = myStorage[studentid];

            // If undefined use the last set contact.
            // TEMP Change to set it as false instead of last contact as this may be a bad idea.
            profile = profile === undefined ? myStorage.currentContact === undefined ? false : false : profile;

            // If this profile exists load the template with this data.
            if(profile){
                profile = JSON.parse(profile);

                // Get all modules and pass it into templatefunction.
                getModules(buildTemplate);

                function buildTemplate(modules) {

                    moduleOne = getModule(profile.moduleNo1, modules);
                    moduleTwo = getModule(profile.moduleNo2, modules);

                    if(profile.staffNumber) {
                        var profileHtmlStr = `
                        <div class="border-0 card text-center">
                            <img src="assets/user.png" alt="" style="width:100%">
                            <h1>${profile.firstName + ' ' + profile.lastName}</h1>
                            <p><button class="rm-st">${profile.firstName+profile.lastName}@dit.ie</button></p>
                        </div>`;

                        var card = `
                        <div class="card">
                        <h5 class="text-primary card-header">${profile.firstName} is a Lecturer</h5>
                        <div class="card-body">
                            <p class="card-text">This Lecturer teaches in TU Dublin GrangeGorman. He teaches modules <a href="module.html?${profile.moduleNo1}">${moduleOne.moduleName}</a> and <a href="module.html?${profile.moduleNo2}">${moduleTwo.moduleName}</a>.</p>
                            <a href="module.html?${profile.moduleNo1}" class="mt-2 btn btn-primary">${moduleOne.moduleName}</a>
                            <a href="module.html?${profile.moduleNo2}" class="mt-2 btn btn-primary">${moduleTwo.moduleName}</a>
                        </div>
                        </div>`;
                        profileHtmlStr+=card;
                        targ.append(profileHtmlStr);
                    }
                    // Otherwise load the student profile.
                    else{
                        var profileHtmlStr = `
                        <div class="border-0 card text-center">
                            <img src="assets/user.png" alt="" style="width:100%">
                            <h1>${profile.firstName + ' ' + profile.lastName}</h1>
                        </div>
                        `;
                        var card = `
                        <div class="card">
                        <h5 class="text-primary card-header">${profile.firstName} is a student</h5>
                        <div class="card-body">
                            <p class="card-text">This student is a member of the ${profile.courseID} course in TU Dublin. This course contains modules <a href="module.html?${profile.moduleNo1}">${moduleOne.moduleName}</a> and <a href="module.html?${profile.moduleNo2}">${moduleTwo.moduleName}</a>.</p>
                            <a href="module.html?${profile.moduleNo1}" class="mt-2 btn btn-primary">${moduleOne.moduleName}</a>
                            <a href="module.html?${profile.moduleNo2}" class="mt-2 btn btn-primary">${moduleTwo.moduleName}</a>
                        </div>
                        </div>`;
                        profileHtmlStr+=card;

                        targ.append(profileHtmlStr);
                    }
                }
            }
            else {

                if(isset == null) {

                }
                // 404 error handling
                var profileHtmlStr = `
                <div class="border-0 card text-center">
                    <img src="assets/404-Person.png" alt="" style="width:100%">
                    <h1>404</h1>
                    <p class="title">The person you are looking for can't be found!</p>
                    <p>:(</p>
                </div>`;

                targ.append(profileHtmlStr);
            }
            }

        </script>
    </body>
</html>