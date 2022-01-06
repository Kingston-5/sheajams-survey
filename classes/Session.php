<?php
/**
 * Controls the sessions by checking for existence, getting, setting and deleting
 */

class Session {

    /**
     * check if the session exists
     * @param name - session name
     */
    public static function exists($name) {
        return (isset($_SESSION[$name])) ? true : false;
    }

    /**
     * puts/creates the value into the session variable under the given name
     * @param name - session name
     * @param valuue - session value
     */
    public static function put($name, $value) { 
        return $_SESSION[$name] = $value;
    }

    /**
     * @return - the value of session variable/name
     * @param name - session name
     */
    public static function get($name) {//gets 
        return $_SESSION[$name];
    }

    /**
     * deletes session variable
     */
    public static function delete($name) {  
        if(self::exists($name)) {
            unset($_SESSION[$name]);
        }
    }

    // public static function flash ($name, $string = 'null') {
    //     if(self::exists($name)) {//if the session exists
    //         $session = self::get($name);
    //         self::delete($name);//destroy session varaible/name value
    //         return $session;//return empty session
    //     } else {
    //         self::put($name, $string);// create the seesion variable
    //     }
    // }
}