// Set the localstorage globally.
var myStorage = window.localStorage;

//Set the user template for profile.php
function setUserTemplate(elem) {
    var studentid = elem.id ? elem.id : 0;

    if(studentid === 0){
        alert('You\'re selected contact can\'t be loaded, refresh or pick a again');
    }

    // Set the current contact item so the next page can load the template.
    myStorage.setItem("currentContact", JSON.stringify(myStorage[studentid]) );
    // ==============================
}

// Get an individual user from an array and pass the value to the supplied callback.
function getUser(id, users) {
    var result;

    $.each(users, function(index, user){
        // If the user is a teacher.
        if(user.staffNumber) {
            // Does that teacher matches the one we are looking for.
            if(user.staffNumber == id ) {

                result = user;
                return false;
            }
        }
        // If the user is a student.
        else {
            // If that student matches the id we are looking for
            if(user.studentID == id ) {
                result = user;
                return false;
            }
        }
    });
    return result;
}

// Check if the user is a student.
function isStudent(id) {
    if(id === undefined) {
        return null;
    } else {
        id = id.toString();
        var studentBool = id.length > 3 ? false : true;
        return studentBool;
    }
}

// Get a list of all users or find an individual and have the result passed to a callback.
function getUsers(callback, isStudent) {
    // If an id to match is supplied assign it to be used to
    // find an individual, otherwise make it false.
    var users = [];

    // Get all students or if there is an id to match, just get that student.
    if(isStudent) {
        $.getJSON('../php/json-data-students.php', function(data){
            $.each(data, function(index, student){
                users.push(student);
            });
            callback(users[0]);
        });
    }
    // Get all or just one lecturer(s).
    else {
        $.getJSON('../php/json-data-lecturers.php', function(data){
            $.each(data, function(index, lecturer){
                users.push(lecturer);
            });
            callback(users[0]);
        });
    }
}

// Only show a lists' parent div (containing header, styling etc.)
// if there are items in that list
// Otherwise hide it.
function showItems() {
    // Get li's in list
    var listitems = $('li.alert');
    if(listitems.length <= 1) {
        $('#alertgroupParent').hide();
        // parentList.parents('ul').hide();
    }
}


// Find out who teaches a module and return the teacher object.
// Used to match a teacher to a module.
function checkTeachesModule(moduleCode) {
    // Get or set a lecturer array if none to avoid errors
    var lecturersArray = myStorage.getItem('lecturers')!== undefined ? myStorage.getItem('lecturers') : false;
    lecturersArray = JSON.parse(lecturersArray);
    var result;

    // Loop over lecturers to find one that teaches that module code.
    if(lecturersArray) {
    $.each(lecturersArray, function(index, lecturer){
        if(lecturer.moduleNo1 == moduleCode || lecturer.moduleNo2 == moduleCode) {
            result = lecturer;
            return false;
        }
        else{
            result = "error finding lecturer";
            }
        });
        return result;
    }
    return false;
}

// Get all the modules and pass the result to a callback.
// If no callback just store them in local storage for easy access.
function getModules(callback){
    console.log("Loading all modules...");
    var modules = [];
    $.getJSON('../php/json-data-modules.php', function(data){
        // If theres a callback present pass the data to it
        // Other wise save it to localstorage.
        if(callback){
            $.each(data.modules, function(index, module){
                modules.push(module);
            });
            callback(modules);
        }
        // Else save the data to local storage.
        else {
            $.each(data.modules, function(index, module){
                myStorage.setItem(module.moduleNo, JSON.stringify(module));
            });
        }
    });
}


// From an array of modules return one with the matching moduleNo.
// Used to display module information alongside profile information.
// https://stackoverflow.com/questions/6237537/finding-matching-objects-in-an-array-of-objects
function getModule(moduleCode, modules){
    var results = $.map( modules, function(e,i){
        if( e.moduleNo === moduleCode ) {
            return e;
        }
    });
    return results[0];
}

function makeTimeReadable(timeOne){
    var timeTwo = new Date();
    var timeOne = new Date(timeOne);
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