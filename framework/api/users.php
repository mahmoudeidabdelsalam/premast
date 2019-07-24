<?php
function all_users($data){

  $data=$data->get_params('POST');
  extract($data);
  $page = !empty($page) ? $page : 1;
  $total_users = count_users();
  $total_users = $total_users['total_users'];
  $number = 1; // ie. 20 users page page 

  $args = array(
    'count_total'  => false,
    'fields'       => 'all',
    'offset' => $page ? ($page - 1) * $number : 0,
    'number' => $number,
  ); 
  
  $users = get_users( $args );

  if($users){
    $users_data = [];
    foreach ($users as $post) {
      $users_data[] = [
        'email' => $post->user_email,
        'password' => $post->user_pass,
      ];
    }



    $result = [
      'success' => true,
      'code' => 200,
      'message' => 'successfully retrieved',
      'data' => $users_data,
    ];
    return $result;
  } else {
    $result = [
      'success' => 'false',
      'code' => 404,
      'message' => 'no User found',
    ];
    return $result;
  }
}

add_action('rest_api_init' , function(){
  register_rest_route('wp/api/' ,'users/login',array(
    'methods' => 'GET',
    'callback' => 'all_users',
    'args' => array(
      'page' => array(
        'validate_callback' => function($param,$request,$key){
          return is_numeric($param);
        }
      ),
    )
  ));
});
