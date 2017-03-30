<!--
* File    : addpost.blade.php
* Author  : Satyapriya Baral
* Date    : 22-Mar-2017
* Purpose : Add Crop Post for farmers  -->

@extends('layouts.master')
@section('title')
  <title>Farmer | AddPost</title>
@stop
@section('header')
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/bootstrap/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/dist/css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/dist/css/skins/_all-skins.min.css') }}">
</head>
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
        <li class="active treeview">
          <a href="{{ URL::to('addpost') }}">
            <i class="fa fa-plus"></i>
            <span>Post Crop</span>
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
        <li class="treeview">
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
        </li>
      </ul>
@stop
@section('content')


   <div class="content-wrapper">
    <section class="content">
      <div class="row">
        <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Quick Example</h3>
            </div>
            <form id="AddPost" action="AddPostData" method="Post" role="form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="box-body">
                <div class="form-group">
                  <label>Select Category</label>
                  <select class="form-control" id="selectCategory" name="Category">
                    <option value="0" disabled="true" selected="true">--Select--</option>
                    @foreach($records as $record)
                      <?php $id = $record->getrecordid() ?>
                      <option value="{{ $record ->getField('___kpn_CategoryId')}}">{{ $record->getField('CategoryName_xt') }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label>Select Crop</label>
                  <select class="form-control cropName" name="Crop">
                    <option value="0" disabled="true" selected="true">Choose Crop</option>
                  </select>
                </div>
                <div class="form-group">
                <div class="row">
                <div class="col-md-6">
                  <label for="Quantity">Quantity</label>
                  <input type="text" class="form-control" name="Quantity" id="quantity" placeholder="Quantity">
                  </div>
                   <div class="col-md-6">
                   <label for="Quantity">Weight</label>
                  <select class="form-control" name="Weight">
                    <option value="0">Kg</option>
                    <option value="1">Ton</option>
                  </select>
                </div></div></div>
                <div class="form-group">
                  <label for="BasePrice">Base Price</label>
                  <input type="text" class="form-control" id="price" name="BasePrice" placeholder="Base Price">
                </div>
                <div class="form-group">
                  <label for="ExpiryTime">Enter Expiry Date</label>
                  <input type="date" class="form-control" id="ExpiryTime" name="ExpiryTime" placeholder="Expiry Time">
                </div>
                <div class="form-group">
                  <label for="exampleInputPhoto">Insert Photo</label>
                  <input type="file" id="exampleInputPhoto">
                </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Post</button>
              </div>
            </form>
          </div>
        </div>
      </div>

    </section>
  </div>

@stop
@section('footer')
<script src="{{ asset('bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ asset('bower_components/AdminLTE/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('bower_components/AdminLTE/plugins/fastclick/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('bower_components/AdminLTE/dist/js/app.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('bower_components/AdminLTE/dist/js/demo.js') }}"></script>
<script type="text/javascript">
var url = "{{ URL::to('viewCrops') }}";
</script>
<script type="text/javascript" src="{{ asset('bower_components/AdminLTE/dist/js/script.js') }}"></script>

</body>
</html>
@stop