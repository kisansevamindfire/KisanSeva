<!--
* File    : viewadds.blade.php
* Author  : Saurabh Mehta
* Date    : 24-Mar-2017
* Purpose : View Advertisements for Dealers  -->
<!DOCTYPE html>
@extends('layouts.master')
  @section('title')
    <title>Dealer | View Previous</title>
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
        <a href="{{ URL::to('viewadds') }}">
          <i class="fa fa-files-o"></i>
          <span>View Ads</span>
          <span class="pull-right-container">
            <span class="label label-primary pull-right">4</span>
          </span>
        </a>
      </li>
      <li class="active treeview">
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
              <h3><center>Purchasing History</center></h3>
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
                  <th>Your Price</th>
                </tr>
                <tr>
                  <td>Vegetables</td>
                  <td>Beans</td>
                  <td>11-7-2014</td>
                  <td>1 kg</td>
                  <td>280</td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  @stop
