<<<<<<< HEAD
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>KisanSeva | Registration Page</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{ asset('template/bootstrap/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('template/dist/css/AdminLTE.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('template/plugins/iCheck/square/blue.css') }}">

</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="../../index2.html"><b>Kisan</b>Seva</a>
  </div>
=======
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
>>>>>>> 8f970620b8da5189ab7444e47fbafb20d1af10cd

  <div class="register-box-body">
    <p class="login-box-msg">Register a new membership</p>

    <form action="register" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <span>@if ($errors->has('message')) {{ $errors->first('message') }} @endif</span>
      <div class="form-group has-feedback">
        <select class="form-control" id="selectUserType" name="UserType">
          <option value="0" disabled="true" selected="true">--Select User Type--</option>
          <option value="2">Dealer</option>
          <option value="3">Farmer</option>
        </select>
        <span>@if ($errors->has('UserType')) {{ $errors->first('UserType') }} @endif</span>
      </div>
<<<<<<< HEAD
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Full name" name="Name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        <span>@if ($errors->has('Name')) {{ $errors->first('Name') }} @endif</span>
      </div>
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" name="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        <span>@if ($errors->has('Email')) {{ $errors->first('Email') }} @endif</span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <span>@if ($errors->has('Password')) {{ $errors->first('Password') }} @endif</span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Retype password" name="RetypePassword">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
        <span>@if ($errors->has('RetypePassword')) {{ $errors->first('RetypePassword') }} @endif</span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Address" name="Address">
        <span class="glyphicon glyphicon-home form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="number" class="form-control" placeholder="Number" name="Number">
        <span class="glyphicon glyphicon-phone-alt form-control-feedback"></span>
        <span>@if ($errors->has('Number')) {{ $errors->first('Number') }} @endif</span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> I agree to the <a href="#">terms</a>
            </label>
=======
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
>>>>>>> 8f970620b8da5189ab7444e47fbafb20d1af10cd
          </div>
        </div>
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <a href="{{ URL::to('login') }}" class="text-center">I already have a membership</a>
  </div>
</div>
<!-- jQuery 2.2.3 -->
<script src="{{ asset('template/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ asset('template/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ asset('template/plugins/iCheck/icheck.min.js') }}"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
