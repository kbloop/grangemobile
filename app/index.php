<?php
session_start();

if(isset($_SESSION['loggedin'])){
    $loggedin = TRUE;
    $id = $_SESSION['studentID'];
    // $pword = $_SESSION['password'];
    // echo $_SESSION['password'];
}

if(isset($_SESSION['loginErrorMsg'])){
    $loginError = true;
    $errmsg = $_SESSION['loginErrorMsg'];
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
                    <div class="mt-3 card card-body shadow form-card">
                    <h3 class="mb-5 text-center main">
                        Login
                    </h3>
                    <form action="authenticate.php" method="post">
                    <?php if($errmsg && !$loggedin): ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong><?=$errmsg?>.</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php endif;?>
                    <div class="form-group">
                            <label for="inputStudentNumber" class="input-label">Student / Staff Number</label>
                        <input value="<?=$id ?>"  name="collegeID" autocomplete="on" id="inputStudentNumber" type="number" class="form-control" aria-describedby="numberHelp" placeholder="Enter Student Number">
                        </div>
                        <div class="form-group">
                            <label for="inputPassword">Password</label>
                            <input value="" name="password" autocomplete="current-password" type="password" class="form-control" id="inputPassword" placeholder="Password">
                        </div>

                        <div class="foru-group form-check">
                            <a href="#" class="forgotpassword">forgot password?</a>
                        </div>
                        <button type="submit" class="mt-3 offset-3 col-6 btn btn-primary">Login</button>
                    </form>
                </div>
                <!-- <div class="mt-5 mb-5 card card-body shadow form-card">


                    <h2 class="main">
                        Sign up
                    </h2>
                    <form action="register.php" method="post">
                        <div class="form-group">
                            <label for="signupStudentNumber" class="input-label">Student Number</label>
                            <input type="number" name="collegeID" id="signupStudentNumber" class="form-control" aria-describedby="numberHelp" placeholder="Enter Student Number">
                            <div class="form-group">
                            <label for="signupPassword">Password</label>
                            <input value="" name="password" autocomplete="current-password" type="password" class="form-control" id="signupPassword" placeholder="Password">
                        </div>
                        </div>
                        <button type="submit" class="offset-3 col-6 btn btn-primary">Sign up</button>
                    </form>
                </div> -->
                </div>
            </div>
        </div>

        <!-- Bootstrap, jQuery and popper.js -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>
