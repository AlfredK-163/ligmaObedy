<?php 
require_once 'config.php';


/*function connect() {
    $C = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

    if($C->connect_error) {
        return false;
    }
    return $C;
}*/

function connect() {
    $C = pg_connect("host=127.0.0.1 dbname=kufaalcz user=kufaalcz001 password=x1f0wt6n+++");
    if($C->connect_error) {
        return false;
    }
    return $C;
}

function sqlSelect($C, $query, $format = false, ...$vars) {
    $stmt = $C->prepare($query);
    if($format) {
        $stmt->bind_param($format, ...$vars);
    }
    if($stmt->execute()) {
        $res = $stmt->get_result();
        $stmt->close();
        return $res;
    }
    $stmt->close();
    return false;
}


function sqlInsert($C, $query, $format = false, ...$vars) {
    $stmt = $C->prepare($query);
    if($format) {
        $stmt->bind_param($format, ...$vars);
    }
    if($stmt->execute()) {
        $id = $stmt->insert_id;
        $stmt->close();
        return $id;
    }
    $stmt->close();
    return -1;
}




//--------------------PART 22222222222222222222222222222
function createToken() {
    $seed = random_bytes(8);
    $t = time();
    //$hash = hash_hmac('sha256', session_id() . $seed . $time, CSRF_TOKEN_SECRET, true);
    //return urlSafeEncode($hash . '|' . $seed . '|' . $t);
}



function validateToken($token) {
    $parts = explode('|', $token);
}

function urlSafeEncode($m) {
    return rtrim(strtr(base64_encode($m), '+/', '-_'), '=');
}

function urlSafeDecode($m) {
    return base64_decode(strtr($m, '-_', '+/'));
}

?>