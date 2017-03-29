<?php
/*
* File    : register.blade.php
* Author  : Saurabh Mehta  
* Date    : 15-Mar-2017
* Purpose : Registration page for the users  -->
*/

if (isset($_POST['btn-register'])) {
    
    $userType = trim($_POST['UserType']);
    $userType = strip_tags($userType);
    $userType = htmlspecialchars($userType);

    $userName = trim($_POST['UserName']);
    $userName = strip_tags($userName);
    $userName = htmlspecialchars($userName);

    $UserContact = trim($_POST['UserContact']);
    $UserContact = strip_tags($UserContact);
    $UserContact = htmlspecialchars($UserContact);

    $UserAddress = trim($_POST['UserAddress']);
    $UserAddress = strip_tags($UserAddress);
    $UserAddress = htmlspecialchars($UserAddress);

    $UserEmail = trim($_POST['UserEmail']);
    $userEmail = strip_tags($userEmail);
    $userEmail = htmlspecialchars($userEmail);

    $UserPassword = trim($_POST['UserPassword']);
    $UserPassword = strip_tags($UserPassword);
    $UserPassword = htmlspecialchars($UserPassword);


}

?>

<html>
  <head>
    <title>Kisan Seva | Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css">
  </head>

  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <h1>Kisan Seva</h1>
      </div>
    </div>
  </nav>
  
  <div class="row">
   <div class="col-sm-8">
    <div id="jumb" class="jumbotron text-center">
      <div id="myCarousel" class="carousel slide text-center" data-ride="carousel">
        <!-- Indicators -->
        <div class="carousel-indicators">
          <a data-target="#myCarousel" data-slide-to="0" class="active"></a>
          <a data-target="#myCarousel" data-slide-to="1"></a>
          <a data-target="#myCarousel" data-slide-to="2"></a>
          <a data-target="#myCarousel" data-slide-to="2"></a>
        </div>
          <!-- Wrapper for slides -->
          <div class="carousel-inner" role="listbox">
            <div class="item active">
              <img src="assets/background/1.jpg">
            </div>
            <div class="item">
              <img src="assets/background/2.jpg">
            </div>
            <div class="item">
              <img src="assets/background/3.jpg">
            </div>
            <div class="item">
              <img src="assets/background/4.jpg">
            </div>
          </div>
          <!-- Left and right controls -->
          <a class="left carousel-control" href="#myCarousel" role="button" 
           data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel" role="button" 
           data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <form id="myForm">
        <div class="form-group">
          <div class="row">
            <div class="col-sm-6">
              <h2 class="user"><a href="/KisanSeva/KisanSeva/public/">Login</a></h2>
            </div>
            <div class="col-sm-6">
              <h2 class="user"><a href="/KisanSeva/KisanSeva/public/register"><strong>Register</strong></a></h2>
            </div>
            <div class="form-group col-md-12">
              <label>Register As</label>
              <select class="form-group col-md-12" name="UserType">
                <option value="3">Farmer</option>
                <option value="2">Dealer</option>
              </select>
            </div>
            <div class="form-group col-md-12">
              <label for="name">Name</label>
              <input type="text" class="form-control" id="name" name="UserName"
              placeholder="Name" maxlength="25">
            </div>
            <div class="form-group col-md-12">
              <label for="contact">Contact</label>
              <input type="text" class="form-control" id="contact" name="UserContact"
               placeholder="contact" maxlength="10">
            </div>
            <div class="form-group col-md-12">
              <label for="address">Address</label>
              <input type="text" class="form-control" id="address" name="UserAddress"
               placeholder="Address" maxlength="40">
            </div>
            <div class="form-group col-md-12">
              <label for="email">Email</label>
              <input type="text" class="form-control" id="email" name="UserEmail"
               placeholder="example@gmail.com" maxlength="25">
            </div>
            <div class="form-group col-md-12">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" name="UserPassword"
               placeholder="******" maxlength="20">
            </div>
            <div class="form-group col-md-12">
              <label for="ConfirmPassword">Confirm Password</label>
              <input type="ConfirmPassword" class="form-control" id="ConfirmPassword"
               placeholder="******" maxlength="20">
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                  <button type="button" class="btn btn-success"
                   id="submit" name="btn-register">Submit</button>
                  <button type="reset" class="btn btn-primary">Reset</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
    
<footer class="text-center">
  <a class="up-arrow" href="#myPage" data-toggle="tooltip" title="TO TOP">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a><br><br>
  <p class="lead">Welcome to Kisan Seva.</p> 
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </body>
</html>

    
  
