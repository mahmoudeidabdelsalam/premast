{{--
  Template Name: Plus Template
--}}

@extends('layouts.app-blank')

@section('content')

@php 
  $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
@endphp

<div class="container-fiuld vh-100">
  <div class="row h-100">
    <div class="col-3 side-tabs">
      <h1 class="logos">
        <a class="navbar-brand p-0 align-self-center col" href="{{ home_url('/') }}" title="{{ get_bloginfo('name') }}">
            <img class="img-fluid" src="{{ get_theme_file_uri().'/dist/images/logo-plus.png' }}" alt="{{ get_bloginfo('name', 'display') }}" title="{{ get_bloginfo('name') }}"/>
            <span class="sr-only"> {{ get_bloginfo('name') }} </span>
        </a>
      </h1>
      <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="fa fa-th-large" aria-hidden="true"></i> {{ _e('All items', 'premast') }}</a>
        <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false"><i class="fa fa-plus-square" aria-hidden="true"></i> {{ _e('Add Items', 'premast') }}</a>
      </div>
    </div>
    <div class="col-9 p-0">
      <div class="tab-content" id="v-pills-tabContent">
        <div class="tab-pane fade show active all-items" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
          @include('partials/incloud/all-item-plus')
        </div>
        <div class="tab-pane fade add-items" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
          @include('partials/incloud/add-item-plus')
        </div>
      </div>
    </div>
  </div>
</div>
@endsection



<style>
.side-tabs {
  padding-left: 50px !important;
  background-color: #fff;
  padding-right: 0 !important;
}
.side-tabs .logos {
  text-align: center;
  margin: 20px auto 40px;
}
.side-tabs .nav .nav-link {
    font-size: 20px;
    line-height: 23px;
    letter-spacing: 0.114083px;
    text-transform: capitalize;
    padding: 14px;
    border-radius: 5px 0 0 5px !important;
}
.side-tabs .nav .nav-link i {
    margin-right: 10px;
}
.all-items {
    padding: 100px 30px 0;
    background: #E5E5E5;
    height: 100%;
}
.all-items .card {
    background: #FFFFFF;
    box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.06);
    border-radius: 6px;
    height: 170px;
    margin-bottom: 30px;
}
.all-items .card {
    display: flex;
    justify-content: space-between;
    flex-flow: wrap;
    align-items: center;
}
.all-items .card .card-body {
    padding: 0;
    margin-top: auto;
}
.all-items .card .card-body h5 {
    font-size: 17px;
    line-height: 20px;
    text-align: center;
    letter-spacing: 0.114083px;
    text-transform: capitalize;
    color: rgba(40, 47, 57, 0.84);
    margin: 0;
    font-weight: 300;
}
ul#myTab {
    background: #FFFFFF;
    box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.25);
    border-radius: 7px;
    margin: 10px 0 50px;
    padding: 10px;
    align-items: center;
}
ul#myTab li.nav-first {
    border-right: 1px solid rgba(0, 0, 0, 0.09);
    padding-right: 30px;
    margin-right: 70px;
    font-size: 20px;
    line-height: 23px;
    text-align: center;
    letter-spacing: 0.114083px;
    text-transform: capitalize;
    color: #282F39;
    padding-left: 10px;
}
ul#myTab .nav-link.active, ul#myTab .nav-link {
    border: none !important;
    font-weight: 500;
    font-size: 20px;
    line-height: 23px;
    letter-spacing: 0.114083px;
    text-transform: capitalize;
    color: #282F39 !important;
}
ul#myTab .nav-link.active:after, ul#myTab .nav-link:after {
    content: "";
    height: 20px;
    width: 20px;
    border: 2px solid #282F39;
    display: inline-block;
    float: left;
    margin-right: 10px;
    border-radius: 100%;
}
ul#myTab .nav-link.active:after {
    background: #1E6DFB;
    box-shadow: 0 0 0 2px #333;
    border-color: #fff !important;
}
.add-items {
    background: #E5E5E5;
    height: 100%;
    padding: 30px;
    position: relative;
}
.add-items h2 {
    font-style: normal;
    font-weight: normal;
    font-size: 20px;
    line-height: 23px;
    letter-spacing: 0.114083px;
    text-transform: capitalize;
    color: rgba(40, 47, 57, 0.51);
}
.add-item-plus {
    box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.25);
    border-radius: 7px;
    width: 100%;
    display: inline-block;
    background-color: #fff;
    padding: 40px 40px 5px;
    position: relative;
}
.add-item-plus label.label-cover, .add-item-plus label.custom-download-label {
    background: #EDF1F5;
    border: 1px solid rgba(0, 0, 0, 0.1);
    box-sizing: border-box;
    border-radius: 7px;
    display: flex;
    flex-flow: column;
    align-items: center;
    justify-content: center;
    min-height: 140px;
}
.add-item-plus label.label-cover img, .add-item-plus label.custom-download-label img {
    margin: 0 0 5px 0 !important;
}
.add-item-plus span.select2 {
    background: #e6edf2;
    width: 100% !important;
}
.add-item-plus li.select2-search {
    margin: 0 !important;
    height: 45px;
    width: 100%;
}
.add-item-plus li.select2-search input {
    width: 100% !important;
}
.add-item-plus span.select2-selection.select2-selection--multiple {
    min-height: 82px !important;
}
.add-item-plus form#publish_product input {
    min-height: 40px !important;
    background: #e6edf2;
    border: 1px solid rgba(61, 69, 82, 0.15) !important;
    -webkit-box-sizing: border-box !important;
    box-sizing: border-box !important;
    border-radius: 5px;
    padding: 5px;
}
button#submit {
    background: #2F80ED;
    border-radius: 7px;
    color: #fff;
    padding: 5px 20px;
    float: right;
}

.all-items .card img {
    max-height: 100px;
    width: auto;
    margin: auto;
}

.img-top-card {
    width: 100%;
    overflow: hidden;
    border-radius: 3px;
    text-align: center;
}

p.register-message {
    position: absolute;
    bottom: 30px;
}

span#add-loader {
    position: absolute;
    z-index: 9;
    font-size: 40px;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 123, 255, 0.16);
    color: #2ed355;
    padding: 10%;
    text-align: center;
}
</style>