<!--
* File    : viewPost.blade.php
* Author  : Satyapriya Baral
* Date    : 23-Mar-2017
* Purpose : View Post Post for farmers  -->

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
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/dist/css/skins/_all-skins.min.css') }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
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
        <li class="active treeview">
          <a href="{{ URL::to('viewpost') }}">
            <i class="fa fa-files-o"></i>
            <span>View Post</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="{{ URL::to('farmingtips') }}">
            <i class="fa fa-edit"></i> <span>Farming Tips</span>
          </a>
        </li>
      </ul>
@stop
@section('content')
<?php
//  date_default_timezone_set('Asia/Kolkata');
  //$date = date("Y/m/d");
  //$time = date("h:i:sa");
  //echo $date;
?>
<div class="content-wrapper">
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search" id="searchPost">
                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            @php
              date_default_timezone_set('Asia/Kolkata');
              $date = date("m/d/Y");
              $time = date("h:i:sa");
              $i = 0 ;
            @endphp
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>Category</th>
                  <th>Crop</th>
                  <th>Time Posted</th>
                  <th>Quantity</th>
                  <th>Base Price</th>
                  <th>Status</th>
                </tr>
                @foreach($PostRecords[0] as $PostRecord[0])
                  <tr>
                    <td>{{ $PostRecords[2][$i][0] }}</td>
                    <td>{{ $PostRecords[1][$i][0] }}</td>
                    <td>{{ $PostRecord[0]->getField('PublishedTime_t') }}</td>
                    <td>{{ $PostRecord[0]->getField('Quantity_xn') }}</td>
                    <td>Rs {{ $PostRecord[0]->getField('CropPrice_xn') }}</td>
                    @php
                      $today_time = strtotime($date);
                      $expire_time = strtotime($PostRecord[0]->getField('CropExpiryTime_xi'));
                      if($PostRecord[0]->getField('Sold_n') == 1) { @endphp
                        <td><span class="label label-success">Sold</span></td>
                      @php }
                      elseif ($expire_time < $today_time) { @endphp
                        <td><span class="label label-danger">Expired</span></td>
                      @php } else { @endphp
                        <td><span class="label label-primary">Active</span></td>
                    @php } @endphp
                    <td><Button class="label label-info">View</Button></td>
                  </tr>
                  @php $i = $i+1; @endphp
                @endforeach
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

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
<script type="text/javascript">
var url = "{{ URL::to('viewRelatedPost') }}";
</script>
<script type="text/javascript" src="{{ asset('bower_components/AdminLTE/dist/js/script.js') }}"></script>
</body>
</html>
@stop