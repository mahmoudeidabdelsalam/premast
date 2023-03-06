{{--
  Template Name: Items search
--}}

@extends('layouts.app-dark')

@section('content')
   @php
      global $current_user;
      wp_get_current_user();
      $loop_items;
      $counter = $loop_items->found_posts;
      $refine = isset($_GET['refine']) ? $_GET['refine'] : '';
   @endphp

   <script>
      console.log('loop', {!! json_encode($loop_items) !!})
      console.log('refine', '{{ $refine }}')
   </script>

   <pmst-items parentCategoryId="" parentCategoryLink=""
               params='{ "category": "0", "per_page": 24, "search": "{{ $refine }}" }'
               nonce='{{ wp_create_nonce('wp_rest') }}'>
   </pmst-items>

   <style>
      body {
         background-color: unset !important;
      }

      section.banner-items {
         margin-top: 0px !important;
      }
   </style>
@endsection
