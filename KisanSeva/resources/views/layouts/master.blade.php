<!DOCTYPE html>
<!--
* File    : master.blade.php
* Author  : Satyapriya Baral
* Date    : 28-Mar-2017
* Purpose : Master template for all pages  -->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  @yield('title')
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('assets/custom/css/main.css?ver=1.4.156') }}">

  <link rel="icon" type="image/png" href="{{ asset('assets/template/dist/img/favicon.ico') }}">
  <link rel="stylesheet" href="{{ asset('assets/template/dist/css/fresh-bootstrap-table.css') }}">
  <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/template/dist/css/AdminLTE.min.css?ver=1.4.10') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins -->
  <link rel="stylesheet" href="{{ asset('assets/template/dist/css/skins/_all-skins.min.css') }}">

  <link rel="stylesheet" href="{{ asset('assets/template/plugins/datatables/dataTables.bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/template/plugins/iCheck/flat/blue.css') }}">

  <link rel="stylesheet" href="{{ asset('assets/template/plugins/morris/morris.css') }}">

  <link rel="stylesheet" href="{{ asset('assets/template/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/template/plugins/datepicker/datepicker3.css') }}">

  <link rel="stylesheet" href="{{ asset('assets/template/plugins/daterangepicker/daterangepicker.css') }}">

  <link rel="stylesheet" href="{{ asset('assets/template/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <div class="logo">
      <span class="logo-lg"><b>Kisan</b>Seva</span>
    </div>
    <nav class="navbar navbar-static-top">

      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
        <div id="google_translate_element"></div>
        </ul>
        <ul class="nav navbar-nav">

          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{ asset('images/'.Session::get('userImage')) }}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{ Session::get('name') }}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <img src="{{ asset('images/'.Session::get('userImage')) }}" class="img-circle" alt="User Image">
                <p>
                  {{ Session::get('name') }} - @if (Session::get('type') == 2) Dealer
                  @else Farmer @endif
                  <small>Member since Apr. 2017</small>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                @if (Session::get('type') == 2)
                  <a href="{{ URL::to('profileDealer') }}" class="btn btn-default btn-flat">Profile</a>
                @else
                  <a href="{{ URL::to('profile') }}" class="btn btn-default btn-flat">Profile</a>
                @endif
                </div>
                <div class="pull-right">
                  <a href="{{URL::to('signout')}}" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('images/'.Session::get('userImage')) }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Session::get('name') }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      @yield('sidebar')
    </section>
    <!-- /.sidebar -->
  </aside>
@yield('content')

<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<script src="{{ asset('assets/template/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ asset('assets/template/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- FastClick -->
<script src="{{ asset('assets/template/plugins/fastclick/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/template/dist/js/app.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>

<script src="{{ asset('assets/template/dist/js/demo.js') }}"></script>
<script src="{{ asset('assets/template/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/template/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<!-- SlimScroll -->
<script type="text/javascript" src="{{ asset('assets/custom/js/script.js?ver=1.4.3455532') }}"></script>
<script type="text/javascript" src="{{ asset('assets/custom/js/rating.js?ver=1.4.3') }}"></script>
<script src="{{ asset('assets/template/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>

<script src="{{ asset('assets/template/plugins/sparkline/jquery.sparkline.min.js') }}"></script>

<script src="{{ asset('assets/template/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('assets/template/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<script src="{{ asset('assets/template/plugins/knob/jquery.knob.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="{{ asset('assets/template/plugins/daterangepicker/daterangepicker.js') }}"></script>

<script src="{{ asset('assets/template/plugins/datepicker/bootstrap-datepicker.js') }}"></script>

<script src="{{ asset('assets/template/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<script type="text/javascript">
var url = "{{ URL::to('viewCrops') }}";
</script>
</body>
</html>
