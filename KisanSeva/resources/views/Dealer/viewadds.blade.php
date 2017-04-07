<!--
* File    : viewadds.blade.php
* Author  : Saurabh Mehta
* Date    : 24-Mar-2017
* Purpose : View Advertisements for Dealers  -->
<!DOCTYPE html>
@extends('layouts.master')
  @section('title')
    <title>Dealer | View Adds</title>
  @stop
  @section('sidebar')
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>
      <li class="treeview">
        <a href="{{ URL::to('dealer') }}">
          <i class="fa fa-home"></i>
          <span>Home</span>
        </a>
      </li>
      <li class="active treeview">
        <a href="{{ URL::to('viewadds') }}">
          <i class="fa fa-files-o"></i>
          <span>View Ads</span>
          <span class="pull-right-container">
            <span class="label label-primary pull-right">4</span>
          </span>
        </a>
      </li>
      <li class="treeview">
        <a href="{{ URL::to('viewprevious') }}">
          <i class="fa fa-files-o"></i>
          <span>Purchasing History</span>
        </a>
      </li>
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
                <div class="form-group pull-right">
                  <input type="text" class="search form-control" placeholder="What you looking for?">
                </div>
                @php
                  date_default_timezone_set('Asia/Kolkata');
                  $date = date("m/d/Y");
                  $time = date("h:i:sa");
                  $i = 0 ;
                @endphp
                <!-- /.box-header -->
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
                      <th>Action</th>
                    </tr>
                    <tr class="warning no-result">
                      <td colspan="4"><i class="fa fa-warning"></i> No result</td>
                    </tr>
                  </thead>
                  <tbody>
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
  <script src="{{ asset('template/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('template/dist/js/script.js?ver=1.4.11') }}"></script>
@stop
