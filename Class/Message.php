<?PHP
/**
 * @package viringolight
 * @author @joseleerazuri
 * @copyright 2014 - JASoft Solutions E.I.R.L.
 */

/**
 * Funciones para obtener los mensajes.
 *
 * @package viringolight
 * @author @joseleerazuri
 * @copyright 2014 - JASoft Solutions E.I.R.L.
 * @version 1.0.0.0  15/03/2014
 * @access public
 */
class Class_Message
{

    /**
     * Obtiene un mensaje, de $message[$key].
     * 
     * @param string $key Nombre de la variable del arreglo $messages
     * @param bool $htmlentities aplica o no la función htmlentities de PHP
     * @return string
     * @global string message.inc.php o LangSpanish.php
     * @static 
     */
    public static function get($key, $htmlentities = false)
    {

	 if(!self::exists($key)) {
           Class_Error::messageError('Key "'. $key .'" Not Found in array $message of /Componets/Messages/Lang'.Class_Config::get('language').'.php');
      }
         
        global $messages;

        if ($htmlentities)
               return htmlentities($messages[$key], ENT_QUOTES, ini_get('default_charset'));
        else
               return $messages[$key];
	
    }
    

    /**
    * verifica si existe el mensaje en el array $messages
    *
    * @param string $key Nombre de la variable del arreglo $messages
    * @return string
    * @static
    */
    public static function exists ($key)
 	{
	   if (!empty($key)) {
            global $messages;
	     if(!isset($messages[$key])) return false;
	     else return true;
         }	
		return false;
	}

}
