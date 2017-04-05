<!--
* File    : tipsdetails.blade.php
* Author  : Satyapriya Baral
* Date    : 28-Mar-2017
* Purpose : View Farming Tips for farmers  -->

@extends('layouts.master')
@section('title')
  <title>Farmer | Farming Tips</title>
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
          @if(empty($tips))
              Nothing to show.
          @else
            @foreach($tips as $tip)
              <div class="box-header with-border">
                <h3 class="box-title">{{ $tip->getField('TipName_xt') }}</h3>
             </div>
              <div class="box-body">
                {{ $tip->getField('TipData_xt') }}
              </div>
            @endforeach
          @endif
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@stop