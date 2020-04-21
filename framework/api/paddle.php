<?php
function subscription_created($data){

  $data=$data->get_params('POST');
  extract($data);



  $result = [
    'success' => true,
    'code' => 200,
    'message' => $message,
    'data' => $array,
  ];
  
  return $result;
  
}

add_action('rest_api_init' , function(){
  register_rest_route('wp/api/' ,'created',array(
    'methods' => 'POST',
    'callback' => 'subscription_created',
  ));
});
