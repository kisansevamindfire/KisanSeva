<!--
* File    : details.blade.php
* Author  : Saurabh Mehta
* Date    : 24-Mar-2017
* Purpose : Show details of an individual advertisement  -->

@extends('layouts.master')
@section('title')
  <title>Dealer | Details</title>
@stop
@section('header')
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/bootstrap/css/bootstrap.min.css') }}">

  <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/dist/css/AdminLTE.min.css') }}">

  <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/dist/css/skins/_all-skins.min.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/iCheck/flat/blue.css') }}">

  <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/morris/morris.css') }}">

  <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">

  <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/datepicker/datepicker3.css') }}">

  <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/daterangepicker/daterangepicker.css') }}">

  <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
</head>
@stop
@section('sidebar')
  <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
          <a href="{{ URL::to('dealer') }}">
            <i class="fa fa-home"></i>
            <span>Home</span>
          </a>
        </li>
       <!-- <li class="treeview">
          <a href="{{ URL::to('addpost') }}">
            <i class="fa fa-plus"></i>
            <span>Add Post</span>
          </a>
        </li>-->
        <li class="treeview">
          <a href="{{ URL::to('viewadds') }}">
            <i class="fa fa-files-o"></i>
            <span>View Adds</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
          </a>
        </li>
        <!--<li class="treeview">
          <a href="{{ URL::to('viewbids') }}">
            <i class="fa fa-files-o"></i>
            <span>View Bids</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="{{ URL::to('farmingtips') }}">
            <i class="fa fa-edit"></i> <span>Farming Tips</span>
          </a>
        </li>-->
      </ul>
@stop
@section('content')
   <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">


      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>

              <!--<div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>-->
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>Category</th>
                  <th>Crop</th>
                  <th>Date Posted</th>
                  <th>Quantity</th>
                  <th>Base Price</th>
                  <th>Your Price</th>
                  <th>Rating</th>
                  <th>Post</th>
                </tr>
                <tr>
                  <td>Vegetables</td>
                  <td>Beans</td>
                  <td>11-7-2014</td>
                  <td>1 kg</td>
                  <td>290</td>
                  <td><input type="text" id="yourbid" placeholder="Your Price"></td>
                  <td><input type="text" id="rate" placeholder="Rate between 1 to 5"></td>
                  <td><button type="submit" class="btn btn-success">Post</button></td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

@stop
@section('footer')
<script src="{{ asset('bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>

<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>

<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>

<script src="{{ asset('bower_components/AdminLTE/bootstrap/js/bootstrap.min.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{ asset('bower_components/AdminLTE/plugins/morris/morris.min.js') }}"></script>

<script src="{{ asset('bower_components/AdminLTE/plugins/sparkline/jquery.sparkline.min.js') }}"></script>

<script src="{{ asset('bower_components/AdminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('bower_components/AdminLTE/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>

<script src="{{ asset('bower_components/AdminLTE/plugins/knob/jquery.knob.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="{{ asset('bower_components/AdminLTE/plugins/daterangepicker/daterangepicker.js') }}"></script>

<script src="{{ asset('bower_components/AdminLTE/plugins/datepicker/bootstrap-datepicker.js') }}"></script>

<script src="{{ asset('bower_components/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>

<script src="{{ asset('bower_components/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>

<script src="{{ asset('bower_components/AdminLTE/plugins/fastclick/fastclick.js') }}"></script>

<script src="{{ asset('bower_components/AdminLTE/dist/js/app.min.js') }}"></script>

<script src="{{ asset('bower_components/AdminLTE/dist/js/pages/dashboard.js') }}"></script>

<script src="{{ asset('bower_components/AdminLTE/dist/js/demo.js') }}"></script>
</body>
</html>
@stop