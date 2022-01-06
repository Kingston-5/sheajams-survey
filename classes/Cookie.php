<?php
/**
 * Controls all the cookies by checking for existence , getting, setting and deleting them
 */

class Cookie {

    /** @param name - name of the cookie
     * 
     * return true or false if the cookie issset or not
     */
    public static function exists($name) {
        return (isset($_COOKIE[$name])) ? true : false;
    }

    /** get() : @param name - name of the cookie
    *    return the cookie
    */
    public static function get($name) {
        return $_COOKIE[$name];
    }

    /** 
    * put() : @param name - name of the cookie
    *      @param value - value of the cookie
    *      @param expiry - expiry date
    *      set the cookie
    */
    public static function put($name, $value, $expiry) {
        if(setcookie($name, $value, time() + $expiry, '/')) {//if cookie is create return true
            return true;
        }
        return false;
    }

    /** 
    * delete() : @param name - name of the cookie
    *      set the expiry date of the cookie to a date that has passed thus the browser will delete it
    */
    public static function delete($name) {
        self::put($name, '', time() -1);
    }
}