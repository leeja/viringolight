<?php
/**
 * @package viringolight
 * @author Jose Lee <jlee@jasoftsolutions.com>
 * @copyright 2014 - JASoft Solutions E.I.R.L.
 */

/**
 * Proxy para Mysqli.
 *
 * @package viringolight
 * @author Jose Lee <jlee@jasoftsolutions.com>
 * @copyright 2014 - JASoft Solutions E.I.R.L.
 * @version 1.0.0.0  15/03/2012
 * @access public
 */
class Class_DB_Mysqli
{
    private static $_singleInstancia = array();
    
    public static function getInstance($newInstance = false, $nameDataBase = NULL, $urlServer = NULL,
        $userDataBase = NULL , $passwordUserDataBase = NULL , $portServerDataBase = NULL){
        
        if(!isset($nameDataBase))
            $nameDataBase = Class_Config::get('prefixDb').'_db';
        
        if(!isset($urlServer))
            $urlServer = Class_Config::get ('urlServerDataBase');
        
        if(!isset($userDataBase))
            $userDataBase = Class_Config::get ('userDataBase');
        
        if(!isset($passwordUserDataBase))
            $passwordUserDataBase = Class_Config::get ('passwordUserDataBase');
        
        if(!isset($portServerDataBase))
            $portServerDataBase = Class_Config::get ('portServerDataBase');
        
        if(!isset(self::$_singleInstancia[$nameDataBase][$userDataBase]) || $newInstance == TRUE){
            self::$_singleInstancia[$nameDataBase][$userDataBase] = new mysqli($urlServer, $userDataBase, $passwordUserDataBase, $nameDataBase, $portServerDataBase);
	}
	
        return self::$_singleInstancia[$nameDataBase][$userDataBase];
        
                
    }
    
   
            
}