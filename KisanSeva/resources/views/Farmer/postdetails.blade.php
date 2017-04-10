<!--
* File    : viewPost.blade.php
* Author  : Satyapriya Baral
* Date    : 23-Mar-2017
* Purpose : View Post Post for farmers  -->

@extends('layouts.master')
@section('title')
  <title>Farmer | PostDetails</title>
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
<div class="content-wrapper">
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>
              <span class="counter pull-right"></span>
                <table class="table table-hover table-bordered results">
                  <thead>
                    <tr>
                      <th>Category</th>
                      <th>Crop</th>
                      <th>Time Posted</th>
                      <th>Quantity</th>
                      <th>Base Price</th>
                      <th>Status</th>
                    </tr>
                        <tbody>
                          @php
                            date_default_timezone_set('Asia/Kolkata');
                            $date = date("m/d/Y");
                            $time = date("h:i:sa");
                          @endphp
                            <tr>
                              <td>{{ $postDetails['categoryName'][0]->getField('CategoryName_xt') }}</td>
                              <td>{{ $postDetails['cropDetails'][0]->getField('CropName_t') }}</td>
                              <td>{{ $postDetails['cropDetails'][0]->getField('PublishedTime_t') }}</td>
                              <td>{{ $postDetails['cropDetails'][0]->getField('Quantity_xn') }}</td>
                              <td>Rs {{ $postDetails['cropDetails'][0]->getField('CropPrice_xn') }}</td>
                              @php
                                $today_time = strtotime($date);
                                $expire_time = strtotime($postDetails['cropDetails'][0]->getField('CropExpiryTime_xi'));
                                if($postDetails['cropDetails'][0]->getField('Sold_n') == 1) { @endphp
                                  <td><span class="label label-success">Sold</span></td>
                                @php } elseif ($expire_time < $today_time) { @endphp
                                  <td><span class="label label-danger">Expired</span></td>
                                @php } else { @endphp
                                  <td><span class="label label-primary">Active</span></td>
                              @php } @endphp
                              </tr>
                        </tbody>
                    <tr class="warning no-result">
                      <td colspan="4"><i class="fa fa-warning"></i> No result</td>
                    </tr>
                  </thead>
                </table>
            </div>
          </div>
        </div>
      </div>
        <div class="row">
        <div class="col-xs-6">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>
              <span class="counter pull-right"></span>
            </div>
          </div>
        </div>
        <div class="col-xs-6">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>
              <span class="counter pull-right"></span>
                <table class="table table-hover table-bordered results">
                  <thead>
                    <tr>
                      <th>Dealer Name</th>
                      <th>Email</th>
                      <th>Address</th>
                      <th>Contact</th>
                      <th>Bid Made</th>
                      <th>Action</th>
                    </tr>
                        <tbody>
                          @php
                            date_default_timezone_set('Asia/Kolkata');
                            $date = date("m/d/Y");
                            $time = date("h:i:sa");
                            $i = 0;
                          @endphp
                          @foreach($postDetails['bidDetails'] as $bidDetail)
                            <tr>
                              <td>{{ $postDetails['dealerDetails'][$i][0]->getField('UserName_xt') }}</td>
                              <td>{{ $postDetails['dealerDetails'][$i][0]->getField('UserEmail_xt') }}</td>
                              <td>{{ $postDetails['dealerDetails'][$i][0]->getField('UserAddress_xt') }}</td>
                              <td>{{ $postDetails['dealerDetails'][$i][0]->getField('UserContact_xn') }}</td>
                              <td>{{ $bidDetail->getField('BidPrice_xn') }}</td>
                              <?php $id = $bidDetail->getrecordid() ?>
                              <td><Button class="label label-info" onclick="window.location='{{ url("acceptBid",[$id]) }}'">Accept</Button></td>
                              @php
                               $i++;
                              @endphp
                            </tr>
                          @endforeach
                        </tbody>
                    <tr class="warning no-result">
                      <td colspan="4"><i class="fa fa-warning"></i> No result</td>
                    </tr>
                  </thead>
                </table>
            </div>
          </div>
        </div>
        </div>
      </div>
    </section>
  <script src="{{ asset('template/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<script type="text/javascript">
var urlpost = "{{ URL::to('viewRelatedPost') }}";
</script>
<script type="text/javascript" src="{{ asset('template/dist/js/script.js?ver=1.4.11') }}"></script>
@stop

