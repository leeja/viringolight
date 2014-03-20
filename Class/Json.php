<?PHP
/**
 * @package viringolight
 * @author Jose Lee <jlee@jasoftsolutions.com>
 * @copyright 2014 - JASoft Solutions E.I.R.L.
 */

/**
 * Funciones para conversión de cadenas o arrays a Json.
 *
 * @package viringolight
 * @author Jose Lee <jlee@jasoftsolutions.com>
 * @copyright 2014 - JASoft Solutions E.I.R.L.
 * @version 1.0.0.0  18/03/2012
 * @access public
 */
class Class_Json
{

    /**
     * Codifica el valor en un unico array
     * @param array|string $array valor a ser codificado
     * @param bool $utf8 Especifica si los valores del array deben ser codificados a utf8, default = true
     * @static
     */
    public static function encodeArray( $array, $utf8 = true, $print = true)
    {
       if($utf8 == true)
           $return = json_encode(Class_App::utf8Array($array));
       else 
           $return = json_encode($array);
        
	if($print == true)
            echo $return;
        
	return $return;

    }

}

