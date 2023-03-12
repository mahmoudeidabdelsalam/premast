{{--
  Template Name: Template Home Item
--}}

@php
    $test_users_ids = [1, 3210, 3625, 2226, 2804, 2269, 217, 1010];
    $current_user = wp_get_current_user();
    // get old from url
    $old = $_GET['old'];
@endphp
@extends('layouts.app-dark')

@section('content')
    <pmst-home nonce='{{ wp_create_nonce('wp_rest') }}'>
    </pmst-home>
@endsection
