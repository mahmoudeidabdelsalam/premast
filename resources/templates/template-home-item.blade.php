{{--
  Template Name: Template Home Item
--}}
@extends('layouts.app')

@section('content')
    <pmst-home nonce='{{ wp_create_nonce('wp_rest') }}'>
    </pmst-home>
@endsection

