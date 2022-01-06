<?php
/**
 * allows the appliction to access user`s form input from the POST and GET variables
 */

class Input {
    /**
     * @param type - type of input to be checked
     * @return - true or false
     */
    public static function exists($type = 'post') {
        switch($type) {
            case 'post':
                return (!empty($_POST)) ? true : false;
                break;
            case 'get':
                return (!empty($_GET)) ? true : false;
                break;
            default:
                return false;
                break;
        }
    }

    /**
     * if item exists in $_POST or $_GET return $_POST[$item] or $_GET[$item]
     * @param item - item were looking for
     * @return item or ' '
     */
    public static function get($item) {// else return  ' '
        if(isset($_POST[$item])) {
            return $_POST[$item];
        } else if(isset($_GET[$item])) {
            return $_GET[$item];
        }

        return '';
    }
}