<!--
* File    : viewbids.blade.php
* Author  : Satyapriya Baral
* Date    : 22-Mar-2017
* Purpose : View Bids made by Dealers for farmers  -->

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
        <li class="treeview">
          <a href="{{ URL::to('farmingtips') }}">
            <i class="fa fa-edit"></i> <span>Farming Tips</span>
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

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>Category</th>
                  <th>Crop</th>
                  <th>Date Posted</th>
                  <th>Quantity</th>
                  <th>Base Price</th>
                  <th>Dealer</th>
                  <th>Bid Price</th>
                </tr>
                <tr>
                  <td>Vegetables</td>
                  <td>Beans</td>
                  <td>11-7-2014</td>
                  <td>1 kg</td>
                  <td>290</td>
                  <td>satya</td>
                  <td>500</td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

@stop