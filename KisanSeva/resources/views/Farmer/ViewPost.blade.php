<!DOCTYPE html>
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
        Crop Posts
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ URL::to('farmer') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">View Post</li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
              <div class="col-md-12">
                <div class="fresh-table">
                    <table id="fresh-table" class="table">
                        <thead>
                          <th data-field="Category" data-sortable="true">Category</th>
                          <th data-field="Crop" data-sortable="true">Crop</th>
                          <th data-field="Time" data-sortable="true">Time Posted</th>
                          <th data-field="quantity" data-sortable="true">Quantity</th>
                          <th data-field="basePrice" data-sortable="true">Base Price</th>
                          <th data-field="status">Status</th>
                          <th data-field="action">Action</th>
                          <th data-field="delete">Delete</th>
                        </thead>
                        <tbody>
                          @php
                            date_default_timezone_set('Asia/Kolkata');
                            $date = date("m/d/Y");
                            $time = date("h:i:sa");
                            $i = 0 ;
                          @endphp
                          @if(empty($PostRecords[0]))
                            {{ "You Have not made any post." }}
                          @else
                          @foreach($PostRecords[0] as $PostRecord[0])
                            <tr>
                              <td>{{ $PostRecords[1][$i][0] }}</td>
                              <td>{{ $PostRecord[0]->getField('CropName_t') }}</td>
                              <td>{{ $PostRecord[0]->getField('PublishedTime_t') }}</td>
                              <td>{{ $PostRecord[0]->getField('Quantity_xn') }}</td>
                              <td>Rs {{ number_format($PostRecord[0]->getField('CropPrice_xn')) }}</td>
                              @php
                                $today_time = strtotime($date);
                                $expire_time = strtotime($PostRecord[0]->getField('CropExpiryTime_xi'));
                              @endphp
                                @if($PostRecord[0]->getField('Sold_n') == 1)
                                  <td><span class="label label-success">Sold</span></td>
                                @elseif ($PostRecords[2][$i] != false)
                                  <td><span class="label label-info">Bid Made</span></td>
                                @elseif ($expire_time < $today_time)
                                  <td><span class="label label-danger">Expired</span></td>
                                @else
                                  <td><span class="label label-primary">Active</span></td>
                              @endif
                              <?php $id = $PostRecord[0]->getrecordid() ?>
                              <td><Button class="label label-info" onclick="window.location='{{ url("postDetails",[$id]) }}'">View</Button></td>
                              <td><Button class="label label-danger glyphicon glyphicon-remove-sign" onclick="window.location='{{ url("deletePost",[$id]) }}'">Delete</Button></td>
                            </tr>
                            @php $i = $i+1; @endphp
                            @endforeach
                          @endif
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
        </div>
      </section>
  </div>
  <script src="{{ asset('template/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('template/dist/js/script.js?ver=1.4.11') }}"></script>
  <script type="text/javascript" src="{{ asset('template/dist/js/jquery-1.11.2.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('template/dist/js/bootstrap-table.js') }}"></script>
  <script type="text/javascript" src="{{ asset('template/dist/js/tableScript.js?ver=1.7') }}">
  </script>
@stop

