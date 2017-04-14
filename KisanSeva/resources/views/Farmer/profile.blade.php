<!DOCTYPE html>
<!--
* File    : profile.blade.php
* Author  : Satyapriya Baral
* Date    : 23-Mar-2017
* Purpose : Show Profile Page for farmers  -->

@extends('layouts.master')
@section('title')
  <title>Farmer | Profile</title>
@stop
@section('sidebar')
  <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
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
        <li class="treeview">
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
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ URL::to('farmer') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">User profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture">

              <h3 class="profile-username text-center">{{ Session::get('name') }}</h3>

              <p class="text-muted text-center">@if (Session::get('type') == 2) Dealer
                  @else Farmer @endif</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">

                  <b>Crop Posted</b> <a class="pull-right">{{ $post['countPost'][0] }}</a>
                </li>
                <li class="list-group-item">
                  <b>Crops Sold</b> <a class="pull-right">{{ $post['countPost'][1] }}</a>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About Me</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Email</strong>
              <p class="text-muted">
                {{ $profileData[0]->getfield('UserEmail_xt') }}
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

              <p class="text-muted">{{ $profileData[0]->getfield('UserAddress_xt') }}</p>

              <hr>

              <strong><i class="fa fa-pencil margin-r-5"></i> Contact</strong>

              <p class="text-muted">{{ $profileData[0]->getfield('UserContact_xn') }}</p>

              <p>
              </p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Activity</a></li>
            </ul>
            <div class="tab-content">
            <div class="active tab-pane" id="activity">
                <!-- Post -->
                <div class="post">
                  <div class="user-block">
                      <span class="username">
                        <a href="#">Last Posted</a>
                      </span>
                    <span class="description">{{ $post['countPost'][2] }}</span>
                  </div>
                  <div class="user-block">
                      <span class="username">
                        <a href="#">Profile Status</a>
                      </span>
                      <div class="row">
                        <div class="col-xs-3">
                          @if( $profileData[0]->getfield('EnableDisable_xn') === 0 )
                            <span class="label description label-success">Enabled</span>
                          @else
                            <span class="label description label-danger">Disabled</span>
                          @endif
                        </div>
                      </div>
                  </div>
                  <div class="user-block">
                        <span class="username">
                          <a href="#">Rating</a>
                        </span>
                    <span class="description"></span>
                  </div>
                </div>
                <hr>
                <h5>Edit Profile</h5>
                <hr>
                <form id="editProfileForm" class="form-horizontal" action="editProfile" method="Post">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-1 control-label">Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Name" name="Name" value ="{{ $profileData[0]->getfield('UserName_xt') }}">
                      <span class="errorMessage" id="nameError"></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputAddress" class="col-sm-1 control-label">Address</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputAddress" placeholder="Address" name="Address" value ="{{ $profileData[0]->getfield('UserAddress_xt') }}">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputContact" class="col-sm-1 control-label">Contact</label>
                    <div class="col-sm-10">
                      <input type="number" class="form-control" id="inputContact" placeholder="Contact" name="Contact" value ="{{ $profileData[0]->getfield('UserContact_xn') }}">
                      <span class="errorMessage" id="contactError"></span>
                    </div>
                  </div>
                  <div class="form-group">
                  <label class="col-sm-1 control-label"></label>
                    <div class="col-sm-10">
                      <button type="submit" id="editSubmit" class="btn btn-danger">Save</button>
                    </div>
                  </div>
                </form>
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <div class="control-sidebar-bg"></div>
</div>
@stop