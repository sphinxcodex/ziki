<?php
namespace Ziki\Core;

use Ziki\Core\filesystem as FileSystem;
class Auth {
    /**
     * This function will get the auth details from specified url
     */
    public static function getAuth($data, $role){
        session_start();
        $_SESSION['name'] = $data->name;
        $_SESSION['email'] = $data->email;
        $_SESSION['image'] = $data->image;
        $_SESSION['last_login'] = $data->updated_at;
        $_SESSION['role'] = $role;
        return $_SESSION;
    }

    public function validateAuth($params) {
        $auth_response =  array();
        $data =  explode(",", $params);
        $provider = $data[0];
        $token = $data[1];
        $ch = curl_init();
        //Set the URL that you want to GET by using the CURLOPT_URL option.
        curl_setopt($ch, CURLOPT_URL, "http://localhost:8000/api/authcheck/{$provider}/{$token}");
        
        //Set CURLOPT_RETURNTRANSFER so that the content is returned as a variable.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        //Set CURLOPT_FOLLOWLOCATION to true to follow redirects.
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        
        //Execute the request.
        $result = curl_exec($ch);
        
        //Close the cURL handle.
        curl_close($ch);
        $res = json_decode($result);
        //var_dump($result); die();
        //Save User data to settings.json
        $dir = "./src/config/settings.json";
        $check_settings = FileSystem::read($dir);
        if(!$check_settings) {
            $json_user = FileSystem::write($dir, $result);
            if($json_user){
                $role = "admin";
                $auth =self::getAuth($res, $role);
                $auth_response = $auth;
            }
        }
        else{
            $check_prev = json_decode($check_settings);
            if($check_prev->email == $res->email){
                $role = "admin";
                $auth = self::getAuth($check_prev, $role);
                $auth_response = $auth;
            }
            else{
                $role = "guest";
                $auth =self::getAuth($res, $role);
                $auth_response = $auth;
            }
        }  
        return $auth_response;  
    }
}
