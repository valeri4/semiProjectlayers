<?php

require_once './includes/DAL.php';
require_once './includes/helpers.php';

//$sql="insert into users(u_email) values ('gggggg')";
//
//$last_id = insert($sql);
//
//var_dump($last_id);
//
//
//
//$text_length = "hello";
//
//var_dump(strlen($text_length));
//
//$user_hash = sha1('user'+time());
//        
//var_dump($user_hash);
//var_dump(time());
//
//$sql = "insert into auto_login(a_u_id, a_u_hash) values ('$last_id', '$user_hash')";
//
//$last_id = insert($sql);
//
//var_dump("Insered id: "+$last_id);


//$sql = "select a_u_hash from auto_login where a_u_id = 65";
//
//$result = get_object($sql);
//
//var_dump(get_object($sql));
//
//printf($result->a_u_hash);
//
//$user_hash = sha1('useeeet' + time());
//var_dump($user_hash);
//$sql = "update auto_login set a_u_hash = '$user_hash' where a_u_id = 65 limit 1";
//$result = update($sql);
//var_dump($result);
//
//$expire = time() + (60 * 60 * 24 * 30);
//setcookie('remember_me', $user_hash, $expire);
//
//var_dump($_COOKIE['remember_me']);
//
//if(isset($_COOKIE['remember_me'])){
//    echo 'LOG IN!';
//}else{
//    echo 'error';
//}


$sql = "select a.a_u_id, u.u_id from auto_login as a where a_u_hash = 
        join users as u
        on a.a_u_id = u.u_id";

$result = get_array($sql);

var_dump($result);



