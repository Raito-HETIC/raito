<?php
namespace APP\HTTP;

use Exception;
use Firebase\JWT\Key;
use \Firebase\JWT\JWT;

class HTTPRequest
{
    private $key = 'DJplHnT6&1qyTa22aYu*d';

    // Check if Method is allowed + Error management
    public function isMethodAllowed($expectedMethod) : string|bool
    {
        $usedMethod = $_SERVER['REQUEST_METHOD'];
        if ($expectedMethod != $usedMethod) {
            http_response_code(405);
            echo('Method Not Allowed : yous send : ' . $usedMethod . ' expected method : ' . $expectedMethod);
            return false;
        } else {
            return $usedMethod;
        }
    }

    // Get the request URI
    public function GetRequestURI()
    {
        return $_SERVER['REQUEST_URI'];
    }
    
    // Get the color send from the frontend
    public function getColor()
    {
        try {
            $color = json_decode(file_get_contents('php://input'));
            error_reporting(E_ALL ^ E_WARNING);
            $colorValue = $color->colorHexadecimal;
            if (!isset ($colorValue)) {
                http_response_code(404);
                return ("Fields 'colorHexadecimal' do not exist");
            } elseif (empty($colorValue)) {
                http_response_code(400);
                return ("'colorHexadecimal' is empty");
            } else {
                return $colorValue;
            }
        } catch (Exception $e) {
            return ('Exception received : '.  $e->getMessage(). "\n");
        }
    }

    public function sendColor($hexadecimal) {
        $data = http_build_query(
            array(
                'hexadecimal' => $hexadecimal,
            )
        );
        $opts = array('http' =>
            array(
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => $data
            )
        );
        $context = stream_context_create($opts);
        $result = file_get_contents('192.168.55.86:80', false, $context);
        echo $result;
    }

    // Get the header of a request
    public function getHeader(){
        return $_SERVER;
    }

    // Check if a token is still valid 
    public function isTokenValid(string $jwt): bool
    {
       
        try {
            // Decode and Analyse
            $JWTDecode = JWT::decode($jwt, new Key($this->key, 'HS256'));
            $expiredDate = $JWTDecode->expiredAt;
            $dateNow = new \DateTime();
            $dateNow->setTimezone(new \DateTimeZone('Europe/Paris'));
            $dateNow = date_timestamp_get($dateNow);

            // Check if it still valid
            if ($expiredDate > $dateNow)
            {
                return True;
            }
            else 
            { 
                return False;
            }
        }
        catch (\Exception $e) {
            return False;
        }
    }

    // Check if a user is allowed 
    public function isUserAllowed() {
        $jwt = $_COOKIE['Token'] ?? null;
        
        if (!isset($jwt) or $jwt == '') {
            http_response_code(401);
            echo json_encode(array(
                'message' => 'A token is required'
            ));
            return false;
        }
        else if (!$this->isTokenValid($jwt)){
            http_response_code(401);
            echo json_encode(array(
                'message' => 'Your token is not valid',
                'jwt' => $jwt
            ));
            return false;
        }
        else return true;
    }

    // Get all information about JWT 
    public function getJWTDetailled(){
        
        if ($this->isUserAllowed()) {
            $jwt = $_COOKIE['Token'];
            $jwtDetailled = JWT::decode($jwt, new Key($this->key, 'HS256'));
            return $jwtDetailled; 
        }
    }
    
    // Get Email and Password from a basic auth + Error Management
    public function getBasicAuthentification()
    {
        // echo json_encode($_SERVER, JSON_PRETTY_PRINT);
        if (!isset ($_SERVER['PHP_AUTH_USER']) && !isset ($_SERVER['PHP_AUTH_PW'])) {
            http_response_code(404);
            return ('Fields password and email do not exist');
        }
        elseif (!isset ($_SERVER['PHP_AUTH_USER'])) {
            http_response_code(404);
             return('Field email does not exist');
        }
        elseif (!isset ($_SERVER['PHP_AUTH_PW'])) {
            http_response_code(404);
            return('Field password does not exist');
        }
        elseif (empty($_SERVER['PHP_AUTH_USER'])) {
            http_response_code(400);
            return('Email is empty');
        }
        elseif (empty($_SERVER['PHP_AUTH_PW'])) {
            http_response_code(400);
            return('Password is empty');
        }
        else return array(
            "email" => $_SERVER['PHP_AUTH_USER'],
            "password" =>$_SERVER['PHP_AUTH_PW'],
        );

    }
}