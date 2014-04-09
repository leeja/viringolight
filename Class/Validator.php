<?php
/**
 * @package viringolight
 * @author Jose Lee <jlee@jasoftsolutions.com>
 * @copyright 2014 - JASoft Solutions E.I.R.L.
 */

/**
 * Funciones para validar datos entrantes.
 *
 * @package viringolight
 * @author Jose Lee <jlee@jasoftsolutions.com>
 * @copyright 2014 - JASoft Solutions E.I.R.L.
 * @version 1.0.0.0  18/03/2012
 * @access public
 */
class Class_Validator
{
    /**
    * valida datos tipo nombre
    * 
    * @param string $name Variable Nombre 
    * @param integer $length longitud de caracteres del nombre
    * @return boolean
    */
    public static function name($name, $length = NULL){
        
        $lengthName = strlen($name);
        if($length == NULL) $length = $lengthName;
        
        if($lengthName <= $length && $lengthName > 0 && gettype($name) == 'string'){
            return TRUE;
        }
        return FALSE;
        
    }
    
    /**
    * valida datos tipo string
    * 
    * @param string $string Variable tipo string 
    * @param integer $length longitud de caracteres del string
    * @return boolean
    */
    public static function string($string, $length = NULL){
        
         $lengthName = strlen($string);
        if($length == NULL) $length = $lengthName;
        
        if($lengthName <= $length && gettype($string) == 'string'){
            return TRUE;
        }
        return FALSE;
        
    }
    
    /**
    * valida datos tipo email
    * 
    * @param string $email Variable tipo email 
    * @param integer $length longitud de caracteres del email
    * @return boolean
    */
    public static function email($email, $length = NULL){
        
        if(self::string($email, $length) && filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        }
        return false;
    }
    
    /**
    * valida datos tipo phone
    * 
    * @param string $phone Variable tipo phone 
    * @param integer $length longitud de caracteres del phone
    * @return boolean
    */
    public static function phone($phone, $length = NULL){
        
        if(self::string($phone, $length)){
            return true;
        }
        return false;
        
    }
     
    /**
    * valida datos tipo id
    * 
    * @param string $id Variable tipo id 
    * @return boolean
    */
    public static function id($id){
        
        if(filter_var($id, FILTER_VALIDATE_INT)){
            return true;
        }
        return false;
        
    }
    
    /**
     * 
     */
    public static function ip($ip){
        if(filter_var($ip, FILTER_VALIDATE_IP)){
            return true;
        }
        return false;
    }
            
    
}