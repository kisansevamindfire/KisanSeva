<!DOCTYPE html>
<!--
* File    : register.blade.php
* Author  : Satyapriya Baral
* Date    : 23-Mar-2017
* Purpose : page to register new user  -->

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>KisanSeva | Registration Page</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{ asset('assets/template/bootstrap/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/template/dist/css/AdminLTE.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('assets/template/plugins/iCheck/square/blue.css') }}">

  <link rel="stylesheet" href="{{ asset('assets/custom/css/main.css?ver=1.4.17') }}">

</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="../../index2.html"><b>Kisan</b>Seva</a>
  </div>
  <div class="register-box-body">
    <p class="login-box-msg">Register a new membership</p>

    <form action="register" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <span class="errorMessage">@if ($errors->has('message')) {{ $errors->first('message') }} @endif</span>
      <div class="form-group has-feedback">
        <select class="form-control" id="selectUserType" name="UserType">
          <option value="0" disabled="true" selected="true">--Select User Type--</option>
          <option value="2">Dealer</option>
          <option value="3">Farmer</option>
        </select>
        <span class="errorMessage">@if ($errors->has('UserType')) {{ $errors->first('UserType') }} @endif</span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Full name" name="Name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        <span class="errorMessage">@if ($errors->has('Name')) {{ $errors->first('Name') }} @endif</span>
      </div>
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" name="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        <span class="errorMessage">@if ($errors->has('Email')) {{ $errors->first('Email') }} @endif</span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <span class="errorMessage">@if ($errors->has('Password')) {{ $errors->first('Password') }} @endif</span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Retype password" name="RetypePassword">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
        <span class="errorMessage">@if ($errors->has('RetypePassword')) {{ $errors->first('RetypePassword') }} @endif</span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Address" name="Address">
        <span class="glyphicon glyphicon-home form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="number" class="form-control" placeholder="Number" name="Number">
        <span class="glyphicon glyphicon-phone-alt form-control-feedback"></span>
        <span class="errorMessage">@if ($errors->has('Number')) {{ $errors->first('Number') }} @endif</span>
      </div>
      <div class="row">
        <div class="col-xs-8">
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
<script src="{{ asset('assets/template/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ asset('assets/template/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ asset('assets/template/plugins/iCheck/icheck.min.js') }}"></script>
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
