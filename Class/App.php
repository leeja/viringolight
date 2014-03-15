<?PHP
/**
 * @package viringolight
 * @author Jose Lee <jlee@jasoftsolutions.com>
 * @copyright 2014 - JASoft Solutions E.I.R.L.
 */

/**
 * Funciones Comunes de un Aplicativo.
 *
 * @package viringolight
 * @author Jose Lee <jlee@jasoftsolutions.com>
 * @copyright 2014 - JASoft Solutions E.I.R.L.
 * @version 1.0.0.0  15/03/2012
 * @access public
 */
class Class_App
{

    /**
     * Decodifica la cadena ($string) de uf8. 
	 *
	 * <b>[algoritmo]</b><br>
	 * <i>Condición:</i> Verifica si la cadena ($string), no esta vacia y esta codificada.<br>
     * <i>Verdadero:</i> Retorna la cadena ($string) decodificada.<br>
     * <i>False:</i> Retorna la cadena ($string).
     * 
     * @param string $string (cadena)
     * @return string
     * @static
     */
    public static function aUtf8($string)
    {

        if (self::isUtf8($string) and !empty($string) and gettype($string) == 'string')
            $string = utf8_decode($string);
        
        return $string;
    }


    /**
     * Obtiene la fecha local del Servidor. La zona por defecto es America/Lima.
     * 
     * <b>[algoritmo]</b><br>
     * Setea la zona por defecto 'America/Lima' con la función: date_default_timezone_set().<br>
     * Obtiene la fecha segun el formato ($format), por defecto 'Y-m-d'.<br>
     * retorna la fecha.
     * 
     * @param string $zone valor de la zona
     * @param string $format por defecto Y-m-d
     * @return string
     */
    public static function getDate($zone = 'America/Lima', $format = 'Y-m-d')
    {

        date_default_timezone_set($zone);
        $date = @date($format);
        if (empty($date))
            Class_Error::messageError('Incorrect Date in @date($format)');
        return $date;

    }

    /**
     * Obtiene la fecha y hora local del Servidor. La zona por defecto es America/Lima.
     * 
     * <b>[algoritmo]</b><br>
     * Setea la zona por defecto 'America/Lima' con la función: date_default_timezone_set().<br>
     * Obtiene la fecha y hora segun el formato ($format), por defecto 'Y-m-d H:i:s'.<br>
     * retorna la fecha y hora.
     * 
     * @param string $zone valor de la zona 
     * @param string $format por defecto Y-m-d H:i:s
     * @return string Fecha y Hora Y-m-d H:i:s
     * @static
     */
    public static function getDateTimeNow($zone = 'America/Lima', $format =
        'Y-m-d H:i:s')
    {
           return self::getDate($zone, $format);
    }

    
    /**
     * 
     * Obtiene la hora local del Servidor. La zona por defecto es America/Lima.
     * 
     * <b>[algoritmo]</b><br>
     * Setea la zona por defecto 'America/Lima' con la función: date_default_timezone_set().<br>
     * Obtiene la hora segun el formato ($format), por defecto 'H:i:s'.<br>
     * retorna la hora.
     * 
     * @param string $zone valor de la localidad
     * @param string $format por defecto H:i:s
     * @return string Hora H:i:s
     * @static
     */
    public static function getTime($zone = 'America/Lima', $format = 'H:i:s')
    {

        return self::getDate($zone, $format);

    }


    /**
     * Verifica si la cadena ($string) esta codificada con utf8.
     * 
     * @param string $string
     * @return boolean
     * @static
     */
    public static function isUtf8($string)
    {
       return mb_detect_encoding($string, 'UTF-8', true);   
    }


    /**
     * Codifica la cadena ($string) con uf8. Si la cadena  esta codificada, la función no la codifica. 
     * 
     * @param string $string
     * @return string
     * @static
     */
    public static function utf8($string)
    {
        if(!empty($string) and !self::isUtf8($string) and gettype($string) == 'string')
                $string = utf8_encode($string);
        return $string;
    }

    
    /**
     * Codifica a Utf8 todo un array. 
     * 
     * @param array $array
     * @return array
     * @static
     */
    public static function utf8Array($array)
    {
        $array = self::_walk ($array, true);
        return $array;
    }
    
    /**
     * Decodifica a Utf8 todo un array. 
     * 
     * @param array $array
     * @return array
     * @static
     */
    public static function aUtf8Array($array)
    {
        $array = self::_walk ($array, false);
        return $array;
    }
    
    
    /**
     * Recorre recursivamente una entrada. 
     */
    private static function _walk( $input, $utf8 = true)
    {
	if(is_object($input)){
            $input = $input->getValue();
        }

        if(!is_array($input)) {
            if($utf8 == true) return Class_App::utf8($input);
            return Class_App::aUtf8($input);
        }
	$output = array();
	foreach($input as $key => $value){
		$output[$key] = self::_walk($value, $utf8);
	}
	return $output;
    }


	/**
     * Agrega Slash a cadenas de arreglos. 
     * 
     * @param array $input
     * @return array
     * @static
     */
    public static function addSlash($input)
    {
        $typeData = gettype($input);
        
        if($typeData == 'string'){
            return addslashes($input);
        }
        elseif($typeData == 'array'){
        
            foreach( $input as $k => $v){
                $input[$k] = self::addSlash($v);
            }
            return $input;
                
            
        }
    }

}

