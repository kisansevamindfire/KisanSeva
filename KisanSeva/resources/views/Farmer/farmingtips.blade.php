<!DOCTYPE html>
<!--
* File    : farmingtips.blade.php
* Author  : Satyapriya Baral
* Date    : 22-Mar-2017
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
            <span>Post Crop</span>
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
        <li class="active">Farming Tips</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th class="lead"><b>Title</b></th>
                </tr>
                  @if(empty($records))
                      Nothing to show.
                  @else
                      @foreach($records as $record)
                <tr>
                  <td>
                      <div class="lead">
                        <?php $id = $record->getrecordid() ?>
                        <a href="{{ URL::to('tipsdetails',[$id]) }}">{{ $record->getField('TipName_xt') }}</a>
                      </div>
                  </td>
                </tr>
                @endforeach
                @endif
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@stop