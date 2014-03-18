<?PHP
/**
 * @package viringolight
 * @author @joseleerazuri
 * @copyright 2014 - JASoft Solutions E.I.R.L.
 */

/**
 * Funciones para obtener las variables de configuración.
 *
 * @package viringolight
 * @author @joseleerazuri
 * @copyright 2014 - JASoft Solutions E.I.R.L.
 * @version 1.0.0.0  18/03/2014
 * @access public
 */
class Class_Config
{

    /**
     * Obtiene un valor de configuración, de $config[$key].
     * 
     * @param string $key Nombre de la variable del arreglo $config
     * @return string
     * @global string $config de config.inc.php
     * @static 
     */
    public static function get($key)
    {

     if(!self::exists($key)) {
           Class_Error::messageError('Key "'. $key .'" Not Found in array $config of Config.inc.php');
      }
         
      global $config;
      
      return $config[$key];
    }


    /**
    * verifica si existe la variable en el array $config
    *
    * @param string $key Nombre de la variable del arreglo $config
    * @return string
    * @static
    */
    public static function exists ($key)
 	{
	   if (!empty($key)) {
            global $config;
	     if(!isset($config[$key])) return false;
	     else return true;
         }	
		return false;
	}


    /**
    * permite setear la variable en el array $config
    *
    * @param string $key Nombre de la variable del arreglo $config
    * @return string
    * @static
    */
    public static function set($key, $value)
   {
	if (!empty($key) and !empty($value)) {
         global $config;
	     $config[$key] = $value;
	     return true;
         }	
	return false;


    }	
}
