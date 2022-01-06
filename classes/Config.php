<?php
/**
 * Config class - used to configure the global variables to be used such as session names mysql connections
 * 
 */

class Config {

    /**
     * @param path - path of the value we want e.g mysql/username
     * 
     * @return config - the value we want (if the path exists) or false 
     */
    public static function get($path = null) {
        if ($path){
            $config = $GLOBALS['config']; // - init.php -set config to array of 'mysql', 'remember', 'sessions'
            $path = explode('/', $path); //split path

            foreach($path as $bit) { // for each ['sessions', 'token_name'] - results of explode
                if(isset($config[$bit])) {// if $config[sessions] or $config[token_name] isset
                    $config = $config[$bit];// set config to session name or token name
                }
            }

            return $config;// return the session name or token name or mysql value
        }

        return false;
    }
}
