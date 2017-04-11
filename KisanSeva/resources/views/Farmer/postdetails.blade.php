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
            <span>Post Crop</span>
          </a>
        </li>
        <li class="active treeview">
          <a href="{{ URL::to('viewpost') }}">
            <i class="fa fa-files-o"></i>
            <span>View Crops Posted</span>
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
    <section class="content-header">
      <h1>
        Crop Details
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ URL::to('farmer') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ URL::to('viewpost') }}"><i class="fa fa-dashboard"></i> View Post</a></li>
        <li class="active">Post Details</li>
      </ol>
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
            <form action="{{ $postDetails['id'] }}/commentData" method="post">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <textarea class="form-control " rows="5"
                  name="commentData" id="commentData"
                  placeholder="Comment"></textarea>
                <button type="submit">Comment</button>
            </form>
            @if($postDetails['commentRecords'] != 0)
              @foreach($postDetails['commentRecords'] as $commentRecord)
                @if($postDetails['commentUser'][$j][0]->getField('__kfn_UserType') == 3)
                  <div class="dialogboxUser">
                    <div class="bodyUser">
                      <span class="tip tip-left"></span>
                      <div class="message">
                        <span><b>{{ $postDetails['commentUser'][$j][0]->getField('UserName_xt') }}</b></span>
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
                        <span><b>{{ $postDetails['commentUser'][$j][0]->getField('UserName_xt') }}</b></span>
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
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>
              <span class="counter pull-right"></span>
                <table class="table table-hover table-bordered results">
                  <thead>
                     @php
                        date_default_timezone_set('Asia/Kolkata');
                        $date = date("m/d/Y");
                        $time = date("h:i:sa");
                        $i = 0;
                      @endphp
                      @if($postDetails['bidDetails'] != false)
                    <tr>
                      <th>Dealer Name</th>
                      <th>Email</th>
                      <th>Address</th>
                      <th>Contact</th>
                      <th>Bid Made</th>
                      <th>Action</th>
                    </tr>
                        <tbody>
                          @foreach($postDetails['bidDetails'] as $bidDetail)
                            <tr>
                              <td>{{ $postDetails['dealerDetails'][$i][0]->getField('UserName_xt') }}</td>
                              <td>{{ $postDetails['dealerDetails'][$i][0]->getField('UserEmail_xt') }}</td>
                              <td>{{ $postDetails['dealerDetails'][$i][0]->getField('UserAddress_xt') }}</td>
                              <td>{{ $postDetails['dealerDetails'][$i][0]->getField('UserContact_xn') }}</td>
                              <td>{{ $bidDetail->getField('BidPrice_xn') }}</td>
                              @if($postDetails['cropDetails'][0]->getField('Sold_n') == 1 )
                                <td><button type="button" class="btn-sm-info" disabled="disabled">Accepted</button></td>
                              @else
                                <?php $id = $bidDetail->getrecordid() ?>
                                <td><Button class="btn-sm label-info" onclick="window.location='{{ url::to("acceptBid",[$id]) }}'">Accept</Button></td>
                              @endif
                              @php
                               $i++;
                              @endphp
                            </tr>
                          @endforeach
                        </tbody>
                    <tr class="warning no-result">
                      <td colspan="4"><i class="fa fa-warning"></i> No result</td>
                    </tr>
                        @else
                          {{'No bids Made till now'}}
                        @endif
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

