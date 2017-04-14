<!--
* File    : details.blade.php
* Author  : Saurabh Mehta
* Date    : 24-Mar-2017
* Purpose : Show details of an individual advertisement  -->
<!DOCTYPE html>
@extends('layouts.master')
  @section('title')
    <title>Dealer | Details</title>
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
      <li class="treeview">
        <a href="{{ URL::to('viewads') }}">
          <i class="fa fa-files-o"></i>
          <span>View Ads</span> 
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
    <section class="content-header">
      <h1>
        Crop Details
      </h1>
    </section>
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
                            $j = 0;
                          @endphp
                            <tr>
                              <td>{{ $details['categoryName'][0]->getField('CategoryName_xt') }}</td>
                              <td>{{ $details['cropDetails'][0]->getField('CropName_t') }}</td>
                              <td>{{ $details['cropDetails'][0]->getField('PublishedTime_t') }}</td>
                              <td>{{ $details['cropDetails'][0]->getField('Quantity_xn') }}</td>
                              <td>Rs {{ $details['cropDetails'][0]->getField('CropPrice_xn') }}</td>
                              @php
                                $today_time = strtotime($date);
                                $expire_time = strtotime($details['cropDetails'][0]->getField('CropExpiryTime_xi'));
                                if($details['cropDetails'][0]->getField('Sold_n') == 1) { @endphp
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
            <form action="{{ $details['id'] }}/commentData" method="post">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <textarea class="form-control " rows="5"
                  name="commentData" id="commentData"
                  placeholder="Comment"></textarea>
                <button type="submit">Comment</button>
            </form>
            @if($details['commentRecords'] != 0)
              @foreach($details['commentRecords'] as $commentRecord)
                @if($details['commentUser'][$j][0]->getField('__kfn_UserType') == 2)
                  <div class="dialogboxUser">
                    <div class="bodyUser">
                      <span class="tip tip-left"></span>
                      <div class="message">
                        <span><b>{{ $details['commentUser'][$j][0]->getField('UserName_xt') }}</b></span>
                        <span class="pull-right">{{ $commentRecord->getField('CommentTime_t') }}</span></br>
                        <span>{{ $commentRecord->getField('CommentData_xt') }}</span>
                      </div>
                    </div>
                  </div>
                @else
                  <div class="dialogbox col-md-offset-5">
                    <div class="body">
                      <span class="tip tip-right"></span>
                      <div class="message">
                        <span><b>{{ $details['commentUser'][$j][0]->getField('UserName_xt') }}</b></span>
                        <span class="pull-right">{{ $commentRecord->getField('CommentTime_t') }}</span></br>
                        <span>{{ $commentRecord->getField('CommentData_xt') }}</span>
                      </div>
                    </div>
                  </div>
                @endif
              @php $j++; @endphp
              @endforeach
            @endif
        </div>
    </section>
  <script src="{{ asset('template/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('template/dist/js/script.js?ver=1.4.11') }}"></script>
@stop

