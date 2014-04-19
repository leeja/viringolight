<?php
/**
 * @package viringolight
 * @author Jose Lee <jlee@jasoftsolutions.com>
 * @copyright 2014 - JASoft Solutions E.I.R.L.
 */

/**
 * Funciones para darle seguridad a la aplicación.
 *
 * @package viringolight
 * @author Jose Lee <jlee@jasoftsolutions.com>
 * @copyright 2014 - JASoft Solutions E.I.R.L.
 * @version 1.0.0.0  18/03/2012
 * @access public
 */
class Class_Security
{
    
    public function makeToken($key){
        
        $key .= Class_Performance::getMicroTime();
        return hash("sha256",$key);
        
    }
    
    public static function post()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
               return true;
        header("HTTP/1.0 405 Method Now Allowed");
    }
    
    public static function get(){
        if($_SERVER['REQUEST_METHOD'] == 'GET')
               return true;
        header("HTTP/1.0 405 Method Now Allowed");;
    }
    
}