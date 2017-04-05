<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  @yield('title')
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('template/bootstrap/css/bootstrap.min.css') }}">

  <link rel="stylesheet" href="{{ asset('template/dist/css/main.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('template/dist/css/AdminLTE.min.css?ver=1.4.10') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins -->
  <link rel="stylesheet" href="{{ asset('template/dist/css/skins/_all-skins.min.css') }}">

  <link rel="stylesheet" href="{{ asset('template/plugins/datatables/dataTables.bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('template/plugins/iCheck/flat/blue.css') }}">

  <link rel="stylesheet" href="{{ asset('template/plugins/morris/morris.css') }}">

  <link rel="stylesheet" href="{{ asset('template/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
  <link rel="stylesheet" href="{{ asset('template/plugins/datepicker/datepicker3.css') }}">

  <link rel="stylesheet" href="{{ asset('template/plugins/daterangepicker/daterangepicker.css') }}">

  <link rel="stylesheet" href="{{ asset('template/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">

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

          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{ asset('template/dist/img/user2-160x160.jpg') }}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{ Session::get('name') }}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <img src="{{ asset('template/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
                <p>
                  {{ Session::get('name') }} - Web Developer
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{ URL::to('profile') }}" class="btn btn-default btn-flat">Profile</a>
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
          <img src="{{ asset('template/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Session::get('name') }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      @yield('sidebar')
    </section>
    <!-- /.sidebar -->
  </aside>
@yield('content')

<script src="{{ asset('template/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('template/dist/js/script.js?ver=1.4.11') }}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ asset('template/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- FastClick -->
<script src="{{ asset('template/plugins/fastclick/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('template/dist/js/app.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('template/dist/js/demo.js') }}"></script>
<script src="{{ asset('template/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('template/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<!-- SlimScroll -->
<script src="{{ asset('template/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="{{ asset('template/plugins/morris/morris.min.js') }}"></script>

<script src="{{ asset('template/plugins/sparkline/jquery.sparkline.min.js') }}"></script>

<script src="{{ asset('template/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('template/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<script src="{{ asset('template/plugins/knob/jquery.knob.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="{{ asset('template/plugins/daterangepicker/daterangepicker.js') }}"></script>

<script src="{{ asset('template/plugins/datepicker/bootstrap-datepicker.js') }}"></script>

<script src="{{ asset('template/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<script type="text/javascript">
var url = "{{ URL::to('viewCrops') }}";
</script>
</body>
</html>
