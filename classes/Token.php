<?php
/**
 * Manages the tokens used to check if a session is valid
 */

class Token {
    public static function generate() {
        return Session::put(Config::get('sessions/token_name'), md5(uniqid()));
    }

    public static function check($token) {
        $tokenName = Config::get('sessions/token_name');// get the token name

        if(Session::exists($tokenName) && $token === Session::get($tokenName)) {//if session is valid/exists and token exists in session var
            Session::delete($tokenName);//delete session variable
            return true;
        }

        return false;
    }
}