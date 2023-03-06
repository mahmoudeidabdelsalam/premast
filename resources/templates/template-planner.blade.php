{{--
  Template Name: planner tool iframe template
--}}
@php
   $current_user = wp_get_current_user();
@endphp

@extends('layouts.app-blank')

{{-- add Iframe to page  --}}
@section('content')
   <iframe src="" width="100%" height="100%" frameborder="0"></iframe>
@endsection

{{-- Script --}}
<script>
   // load iframe before page load 
   window.onload = function() {
      var iframe = document.getElementsByTagName('iframe')[0];
      console.log(iframe);
      // send current user email
      let email = '{{ $current_user->user_email }}';
      console.log(email);
      iframe.src = 'https://plus.premast.com/version-test/planner?email=' + email;
   };
</script>

{{-- style --}}
<style>
   html,
   body {
      height: 100%;
      margin: 0;
      padding: 0;
      overflow: hidden;
   }

   .main {
      height: 100vh;
   }
</style>
