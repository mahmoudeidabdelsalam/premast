<?php
add_action('wp_ajax_get_author_follower', 'author_follow');
add_action('wp_ajax_nopriv_get_author_follower', 'author_follow');
function author_follow() {

  $user_id = $_POST["user_id"];
  $author_id = $_POST["author_id"];

  $follow_authors = get_user_meta( $author_id, 'follow_authors' , true );

  $following_user = get_user_meta( $user_id, 'following_user' , true );

  $event = $_POST["event"];

  if ($event == "follow") {
    $followers = [];
    if($follow_authors) {
      foreach ($follow_authors as $follow ) {
        $followers[] = $follow;
      }
    }
    array_push($followers, $user_id);


    $followings = [];
    if($following_user) {
      foreach ($following_user as $following ) {
        $followings[] = $following;
      }
    }
    array_push($followings, $author_id);


  } elseif ($event == "unfollow") {
    $followers = [];
    if($follow_authors) {
      foreach ($follow_authors as $follow ) {
        if ($user_id != $follow) {
          $followers[] = $follow;
        }
      }
    }

    $followings = [];
    if($following_user) {
      foreach ($followings as $following ) {
        if ($author_id != $following) {
          $followings[] = $following;
        }
      }
    }
  }

  update_user_meta( $author_id, 'follow_authors', $followers );
  update_user_meta( $user_id, 'following_user', $followings );

  echo $event;
  
  die;
}


function get_author_role($author_id)
{
    $author = get_user_by( 'id', $author_id );

    // global $authordata;

    $author_roles = $author->roles;
    $author_role = array_shift($author_roles);

    return $author_role;
}