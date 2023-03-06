{{-- 
   Template Name: item edit new 
--}}

@php acf_form_head(); @endphp
@extends('layouts.app-dark')



@section('content')
   {{-- Global variables --}}
   @php
   @endphp


   {{-- Get current item from url parameter --}}
   @php
      $item_id = $_GET['item_id'];
      $item = get_post($item_id);
   @endphp

   {{-- Get current user and check permission --}}
   @php
      $current_user = wp_get_current_user();
      $item_author_id = $item->post_author;
      $item_author = get_user_by('id', $item_author_id);
      $user_has_permission = false;
      if ($current_user->ID == $item_author_id) {
          $user_has_permission = true;
      }
      if ($current_user->roles[0] == 'administrator') {
          $user_has_permission = true;
      }
   @endphp


   {{-- //SECTION - Form HTML --}}
   {{-- check If user has permission, show edit form --}}
   @if ($user_has_permission)
      <form method="POST" name="edit_item" action="" enctype="multipart/form-data" id="item-form"
            class='row'>
         <div class='col'>
            <input type="text" name="item_title" value="{{ $item->post_title }}">
            {{-- wordpress contnet editor --}}
            @php wp_editor($item->post_content, 'item_content'); @endphp
            <input type="submit" value="Submit" />

            {{-- check if page has item or empty to set action --}}
            @if ($item_id)
               <input type="hidden" name="action" value="edit_item" />
            @else
               <input type="hidden" name="action" value="add_item" />
            @endif

         </div>
         <div class='col'></div>
      </form>
   @else
      <p>You don't have permission to edit this item.</p>
   @endif



   {{-- //!SECTION edit the post function php --}}
   @php
      if ('POST' == $_SERVER['REQUEST_METHOD'] && !empty($_POST['action']) && $user_has_permission) {
          $item_title = $_POST['item_title'];
          $item_content = $_POST['item_content'];
          $item_update = [
              'ID' => $item_id,
              'post_title' => $item_title,
              'post_content' => $item_content,
          ];
          if ($_POST['action'] == 'edit_item') {
              wp_update_post($item_update);
          } elseif ($_POST['action'] == 'add_item') {
              wp_insert_post($item_update);
          }
          $link = get_permalink();
          $link = add_query_arg('item_id', $item_id, $link);
          wp_redirect($link);
          exit();
      }
   @endphp

@endsection


{{-- //SECTION Scripts --}}
<script>
   console.log('load')
   console.log('///item categories', {!! json_encode($item) !!});
</script>



{{-- //SECTION style --}}
<style>
   .row {
      display: flex;
      flex-direction: row;
      flex-wrap: wrap;
   }

   .col {
      display: flex;
      flex-direction: column;
   }

   #item-form {
      width: 100%;
      max-width: 1200px;
      margin: 50px 16px;
   }
</style>
