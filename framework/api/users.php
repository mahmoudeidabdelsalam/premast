<?php
function all_users($data){

  $data=$data->get_params('GET');
  extract($data);
  $login = !empty($login) ? $login : false;
  $page = !empty($page) ? $page : 1;

  if($login){
    
    $total_users = count_users();
    $total_users = $total_users['total_users'];
    $number = 20; // ie. 20 users page page 

    $args = array(
      'count_total'  => false,
      'fields'       => 'all',
      'offset' => $page ? ($page - 1) * $number : 0,
      'number' => $number,
    ); 
    
    $users = get_users( $args );

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
    'message' => 'no Doctors found',
  ];
    return $result;
  }
}

add_action('rest_api_init' , function(){
  register_rest_route('wp/v1/' ,'users',array(
    'methods' => 'GET',
    'callback' => 'all_users',
    'args' => array(
      'login' => array(
        'required' => true,
        'validate_callback' => function($param, $request, $key){
          return true;
        }
      ),
      'page' => array(
        'validate_callback' => function($param,$request,$key){
          return is_numeric($param);
        }
      ),
    )
  ));
});
