<!DOCTYPE html>
<!--
* File    : addpost.blade.php
* Author  : Satyapriya Baral
* Date    : 22-Mar-2017
* Purpose : Add Crop Post for farmers  -->

@extends('layouts.master')
@section('title')
  <title>Farmer | AddPost</title>
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
        <li class="active treeview">
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
    <section class="content-header">
      <h1>
        Post Crops
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ URL::to('farmer') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add Post Crop</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Quick Example</h3>
            </div>
            <form id="AddPost" action="AddPostData" method="Post" role="form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="box-body">
                <div class="form-group">
                  <label>Select Category</label>
                  <select class="form-control" id="category" name="Category">
                    <option value="0" disabled="true" selected="true">--Select--</option>
                    @foreach($records as $record)
                      <?php $id = $record->getrecordid() ?>
                      <option value="{{ $record ->getField('___kpn_CategoryId')}}">{{ $record->getField('CategoryName_xt') }}</option>
                    @endforeach
                  </select>
                  <span class="errorMessage" id="categoryError"></span>
                </div>
                <div class="form-group">
                  <label>Select Crop</label>
                  <select class="form-control cropName" name="Crop" id="crop">
                    <option value="0" disabled="true" selected="true">Choose Crop</option>
                  </select>
                  <span class="errorMessage" id="cropError"></span>
                </div>
                <div class="form-group">
                <div class="row">
                <div class="col-md-6">
                  <label for="Quantity">Quantity</label>
                  <input type="text" class="form-control" name="Quantity" id="quantity" placeholder="Quantity">
                  <span class="errorMessage" id="quantityError"></span>
                  </div>
                   <div class="col-md-6">
                   <label for="Quantity">Weight</label>
                  <select class="form-control" name="Weight">
                    <option value="0">Kg</option>
                    <option value="1">Ton</option>
                  </select>
                </div></div></div>
                <div class="form-group">
                  <label for="BasePrice">Base Price</label>
                  <input type="text" class="form-control" id="price" name="BasePrice" placeholder="Base Price">
                  <span class="errorMessage" id="basepriceError"></span>
                </div>
                <div class="form-group">
                  <label for="ExpiryTime">Enter Expiry Date</label>
                  <input type="date" class="form-control" id="ExpiryTime" name="ExpiryTime" placeholder="Expiry Time">
                  <span class="errorMessage" id="expirytimeError"></span>
                </div>
                <div class="form-group">
                  <label for="exampleInputPhoto">Insert Photo</label>
                  <input type="file" id="inputPhoto" name="Photo">
                </div>
              </div>
              <div class="box-footer">
                <button type="submit" id="submitPost" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>
@stop
