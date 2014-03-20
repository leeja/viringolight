<?PHP
/**
 * @package viringolight
 * @author Jose Lee <jlee@jasoftsolutions.com>
 * @copyright 2014 - JASoft Solutions E.I.R.L.
 */

/**
 * Funciones para medir el tiempo de carga de las peticiones.
 *
 * @package viringolight
 * @author Jose Lee <jlee@jasoftsolutions.com>
 * @copyright 2014 - JASoft Solutions E.I.R.L.
 * @version 1.0.0.0  18/03/2012
 * @access public
 */
Class Class_Performance
{
	/**
	 * Almacena el tiempo cuando inicia la web
	 */
    private static $_startLoad;
    private static $_micro;
    private static $_memory;
    private static $_startMemory;
    private static $_controller;
    private static $_action;
	
        
    public static function begin()
    {
       $performance = Class_Config::get('performance');
	   if($performance == 1){
            self::$_startLoad = self::_getMicroTime();
            self::$_startMemory = round(memory_get_usage() / 1024,1);
        }
    }

	/**
	 * Obtiene el tiempo
	 * 
	 * @return string
	 */
	private static function _getMicroTime()
	{
		$micro = microtime();
		$micro = explode(' ',$micro);
		$micro = $micro[1] + $micro[0];

		return $micro;
	}

    /**
    * Captura los valores
    */
    public static function capture($observation = '')
    {
        $performance = Class_Config::get('performance');
	    if($performance == 1){ 
            self::$_micro = self::_getMicroTime();
            self::$_memory = round(memory_get_usage() / 1024,1) - self::$_startMemory;
            
            self::$_controller = Class_FrontController::getController();
            self::$_action = Class_FrontController::getAction();
            
            }
    }

       /**
        * Calcula el tiempo de carga y el consumo de memoria y lo muestra en pantalla
        *
        * @return string
        */
	public static function end()
	{
		
		$performance = Class_Config::get('performance');
	     if($performance == 1){ 

                self::capture('Fin');
                $time = number_format( (self::$_micro - self::$_startLoad) , 10);
                echo '<br/>performance '.$time.' seg '.self::$_memory.' mb in Controller '.self::$_controller.' and action '.self::$_action;
               
        }
	}
	

}