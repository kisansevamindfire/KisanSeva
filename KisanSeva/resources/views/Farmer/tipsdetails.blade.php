<!--
* File    : tipsdetails.blade.php
* Author  : Satyapriya Baral
* Date    : 28-Mar-2017
* Purpose : View Farming Tips for farmers  -->

@extends('layouts.master')
@section('title')
  <title>Farmer | Farming Tips</title>
@stop
@section('header')
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/bootstrap/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/dist/css/AdminLTE.min.css') }}">

  <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/dist/css/skins/_all-skins.min.css') }}">

</head>
@stop
@section('username')
  {{ $sessionArray['name'] }}
@stop
@section('sidebar')
  <ul class="sidebar-menu">
    <li class="header">MAIN NAVIGATION</li>
      <li class="treeview">
        <a href="{{ URL::to('farmer') }}">
          <i class="fa fa-home"></i>
          <span>Home</span>
        </a>
      </li>
      <li class="treeview">
        <a href="{{ URL::to('addpost') }}">
          <i class="fa fa-plus"></i>
          <span>Add Post</span>
        </a>
      </li>
      <li class="treeview">
        <a href="{{ URL::to('viewpost') }}">
          <i class="fa fa-files-o"></i>
          <span>View Post</span>
          <span class="pull-right-container">
          <span class="label label-primary pull-right">4</span>
          </span>
        </a>
      </li>
      <li class="active treeview">
        <a href="{{ URL::to('farmingtips') }}">
          <i class="fa fa-edit"></i> <span>Farming Tips</span>
        </a>
      </li>
    </ul>
@stop
@section('content')
 <div class="content-wrapper">
    <section class="content">

      <!-- Default box -->
      <div class="box">
               @if(empty($records))
                      Nothing to show.
                    @else
                      @foreach($records as $record)
        <div class="box-header with-border">
          <h3 class="box-title">{{ $record->getField('TipName_xt') }}</h3>
        </div>
        <div class="box-body">
          {{ $record->getField('TipData_xt') }}
        </div>
                      @endforeach
                      @endif

        <!-- /.box-body -->
        <div class="box-footer">
          Footer
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@stop
@section('footer')
<!-- jQuery 2.2.3 -->
<script src="{{ asset('bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ asset('bower_components/AdminLTE/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('bower_components/AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<!-- SlimScroll -->
<script src="{{ asset('bower_components/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('bower_components/AdminLTE/plugins/fastclick/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('bower_components/AdminLTE/dist/js/app.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('bower_components/AdminLTE/dist/js/demo.js') }}"></script>
<!-- page script -->
</body>
</html>
@stop