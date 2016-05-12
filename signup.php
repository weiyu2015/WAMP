<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">

    <title>
      
        Login &middot; 
      
    </title>

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
    <link href="./assets/css/toolkit.css" rel="stylesheet">
    
    <link href="./assets/css/application.css" rel="stylesheet">

    <style>
      /* note: this is a hack for ios iframe for bootstrap themes shopify page */
      /* this chunk of css is not part of the toolkit :) */
      body {
        width: 1px;
        min-width: 100%;
        *width: 100%;
        background-image: url("./assets/login_background.jpg");
        background-size: cover;
      }
        #logo{
            width: 250px;
        }
        #name{
            height:35px;
        }
        #password{
            height:20px;
        }
    </style>

  </head>


<body>
<div class="container-fluid container-fill-height">
  <div class="container-content-middle">
    <form action="signupcheck.php" method="post" role="form" class="m-x-auto text-center app-login-form">

      <a id="logo" class="app-brand m-b-lg">
        <img src="./assets/musichub.png" alt="brand">
      </a>
      <div id="name" class="form-group">
        <input name="Username" class="form-control" placeholder="Username">
      </div>
      <div id="password" class="form-group m-b-md">
        <input name="Password" type="password" class="form-control" placeholder="Password">
      </div>
      <div id="confirm" class="form-group">
        <input name="Confirm_Password" type="password" class="form-control" placeholder="Confirm Password">
      </div>
      <div id="realname" class="form-group">
        <input name="Realname" class="form-control" placeholder="Real name">
      </div>
      <div id="city" class="form-group">
        <input name="city" class="form-control" placeholder="City">
      </div>
      <div id="gender" class="form-group">
        <input name="Gender" class="form-control" placeholder="Gender">
      </div>
      <div id="birthday" class="form-group">
        <input name="Birthday" type="date" class="form-control" placeholder="Birthday">
      </div>

      <div class="m-b-lg">
        <input id="signup" type="submit" class="btn btn-primary" value="Sign up"/>
      </div>
    </form>
  </div>
</div>


    <script src="./assets/js/jquery.min.js"></script>
    <script src="./assets/js/chart.js"></script>
    <script src="./assets/js/toolkit.js"></script>
    <script src="./assets/js/application.js"></script>
  </body>
</html>