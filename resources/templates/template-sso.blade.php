{{--
  Template Name: SSO
--}}

@extends('layouts.app-dark')

@section('content')
   {{-- SSO login button --}}
   @php
      $sso_url = 'https://premast-app.bubbleapps.io/version-test/api/1.1/oauth/authorize';
      $client_id = '41afd12c752b465d7c4e607388576339';
      $redirect_uri = 'https://premast.com/wp-json/pmst/v1/sso';
      $response_type = 'code';
   @endphp

   <button>
      <a
         href="{{ $sso_url }}?client_id={{ $client_id }}&redirect_uri={{ $redirect_uri }}&response_type={{ $response_type }}">
         Login
      </a>
   </button>


   @php
      
   @endphp
@endsection
