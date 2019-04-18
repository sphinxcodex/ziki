<?php
function success(array $data){
    $rdata["status"] = "success";
    $rdata["data"] =$data;
<<<<<<< HEAD:src/classes/api/utils.php
    //header("Content-Type:text/json");
    //echo json_encode($rdata);
=======
>>>>>>> 23978ebc75a5c6d42c1a3f9d1fdb7e8bae75ad6e:src/helpers.php
    return $rdata;
}

function error($message){
    $data["status"] = "error";
    $data["message"] = $message;
    return $data;
}