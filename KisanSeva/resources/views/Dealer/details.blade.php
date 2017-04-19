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
      <ol class="breadcrumb">
        <li><a href="{{ URL::to('dealer') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ URL::to('viewads') }}"><i class="fa fa-dashboard"></i> View Post</a></li>
        <li class="active">Post Details</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3><b>Farmer Details</b></h3>
              <hr>
              <span class="counter pull-right"></span>
          <div class="row">
                <div class="col-xs-8">
                    <h5><b>{{ $details['userPostDetails'][0]->getField('UserName_xt') }}</b></h5>
                    <p><strong>Email : </strong> {{ $details['userPostDetails'][0]->getField('UserEmail_xt') }} </p>
                    <p><strong>Contact : </strong>{{ $details['userPostDetails'][0]->getField('UserContact_xn') }} </p>
                    <p><strong>Address : </strong>{{ $details['userPostDetails'][0]->getField('UserAddress_xt') }} </p>
                </div>
                <div class="col-sm-4 text-center">
                    <figure>
                      @if($details['userPostDetails'][0]->getField('UserImage_t') == "")
                        <img src="{{ asset('images/userImage.png') }}" alt="User profile picture" class="profile-user-img img-responsive img-circle">
                      @else
                        <img src="{{ asset('images/'.$details['userPostDetails'][0]->getField('UserImage_t')) }}" alt="User profile picture" class="profile-user-img img-responsive img-circle">
                      @endif
                    </figure>
                </div>
            </div>
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
                              <td>Rs {{ number_format($details['cropDetails'][0]->getField('CropPrice_xn')) }}</td>
                              @php
                                $today_time = strtotime($date);
                                $expire_time = strtotime($details['cropDetails'][0]->getField('CropExpiryTime_xi'));
                                if($details['cropDetails'][0]->getField('Sold_n') == 1) { @endphp
                                  <td><span class="label label-success">Sold</span></td>
                                @php } elseif ($details['bidDetails'] != false) { @endphp
                                  <td><span class="label label-danger">In Process</span></td>
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
        <div class="col-xs-6">
        @if($details['imagePosts'] != 0)
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>
              <span class="counter pull-right"></span>
                @foreach($details['imagePosts'] as $imagePost)
                  <img src="{{ asset('images/'.$imagePost->getField('Crop_CropPost_MediaPost::MediaPostUrl_t')) }}">
                @endforeach
            </div>
          </div>
          @endif
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>
              <span class="counter pull-right"></span>
              @if($details['bidDetails'] == false)
                <form class="form-horizontal" action="{{ $details['id'] }}/addBid" method="Post">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="form-group">
                    <label for="bid" class="col-sm-2 control-label">Enter Bid</label>
                    <div class="col-sm-5">
                      <input type="number" class="form-control" id="bid" placeholder="Bid" name="bid">
                      <span class="errorMessage" id="bidError"></span>
                      <input type="hidden" class="form-control" id="basePrice" name="basePrice" value="{{ $details['cropDetails'][0]->getField('CropPrice_xn') }}">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                      <button type="submit" id="submitBid" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
              </form>
              @else
                <h4>Bid Made Of Rs {{  number_format($details['bidDetails'][0]->getField('BidPrice_xn')) }}</h4>
              @endif
            </div>
          </div>
        </div>
    </section>
  <script src="{{ asset('template/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('template/dist/js/script.js?ver=1.4.11') }}"></script>
@stop

