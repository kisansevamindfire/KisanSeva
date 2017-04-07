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
        <a href="{{ URL::to('viewadds') }}">
          <i class="fa fa-files-o"></i>
          <span>View Ads</span>
          <span class="pull-right-container">
            <span class="label label-primary pull-right">4</span>
          </span>
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
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3><center>Details</center></h3>
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
                    <th>Your Price</th>
                    <th>Rating</th>
                    <th>Post</th>
                  </tr>
                  <tr>
                    <td>Vegetables</td>
                    <td>Beans</td>
                    <td>11-7-2014</td>
                    <td>1 kg</td>
                    <td>290</td>
                    <td><input type="text" id="yourbid" placeholder="Your Price"></td>
                    <td><input type="text" id="rate" placeholder="Rate between 1 to 5"></td>
                    <td><button type="submit" class="btn btn-success">Post</button></td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  @stop
