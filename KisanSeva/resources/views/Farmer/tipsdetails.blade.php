<!DOCTYPE html>
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
          <span>Post Crops</span>
        </a>
      </li>
      <li class="treeview">
        <a href="{{ URL::to('viewpost') }}">
          <i class="fa fa-files-o"></i>
          <span>View Crops Posted</span>
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
     <section class="content-header">
      <h1>
        Tips Details
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ URL::to('farmer') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ URL::to('farmingtips') }}"><i class="fa fa-dashboard"></i> Farming Tips</a></li>
        <li class="active">Tips Details</li>
      </ol>
    </section>
    <section class="content">
      <!-- Default box -->
      <div class="box">
          @if(empty($tips))
              Nothing to show.
          @else
            @foreach($tips as $tip)
              <div class="box-header with-border">
                <h3 class="box-title"><b>{{ $tip->getField('TipName_xt') }}</b></h3>
             </div>
              <div class="box-body text-justify">
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