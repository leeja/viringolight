<?PHP
/**
 * @package viringolight
 * @author Jose Lee <jlee@jasoftsolutions.com>
 * @copyright 2014 - JASoft Solutions E.I.R.L.
 */

/**
 * Funciones para MVC.
 *
 * @package viringolight
 * @author Jose Lee <jlee@jasoftsolutions.com>
 * @copyright 2014 - JASoft Solutions E.I.R.L.
 * @version 1.0.0.0  18/03/2012
 * @access public
 */ 
class Class_FrontController
{

    /**
     * Controlador
     * @static
     */
    static $_controller;
    
    /**
     * Controlador
     * @static
     */
    static $_module;
    
     /**
     * Acción
     * @static
     */
    static $_action;

    /**
     * @static
     */
    static $_instance;
    
    
    /**
     * Método contructor, que obtiene el url y asigna el Controlador, Acción y los parametros $_GET
     *
	 * <b>[algoritmo]</b><br>
	 * Obtiene Url y asigna valores a la variable $controller y $action de http://Server/Application/$Controller/$Action/$Pameter1/$Value1/$ParameterN/$ValueN.
	 * 
	 * También reconoce cadenas como http://Server/Application/Index.php?controller=$Controller&action=$Action&$parameter1=value1.
	 * 
     * 
     * Si la aplicación se encuentra en mantenimiento Class_Config::get('maintenanceApplication') == 1 sólo pueden ingresar los usuarios WEBMASTER == 1
     *   
     * @return void
     */

public function __construct()
{
        
	if(isset($_GET['controller']))
	   $controller = $_GET['controller'];
    if(isset($_GET['action']))
	   $action = $_GET['action'];
    
       
     if (isset($controller) && isset($action) ){
       	self::$_controller = $controller;
       	self::$_action = $action;
        
     }
     else{
        $request = $_SERVER['REQUEST_URI'];
        $request = substr($request, strlen(NAME_SITE) + 1, strlen($request));
            
		
        $splits = explode('/', trim($request, '/'));
        self::$_controller = !empty($splits[0]) ? $splits[0] : 'Index';
		self::$_action = !empty($splits[1]) ? $splits[1] : '';
	
                
        if (!empty($splits[2])) {
           $keys = $values = array();
           $count = count($splits);
           for ($idx = 2; $idx < $count; $idx += 2) {
               if (isset($splits[$idx + 1])){ 
               	  $_GET[$splits[$idx]] = $splits[$idx + 1];
                  $_REQUEST[$splits[$idx]] = $splits[$idx + 1];
				}
            }
        }
   }

}

    /**
     * Obtiene la Instancia de esta clase
     *  
     * @return object
     */
    public static function getInstance()
    {
        
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }
        return self::$_instance;
        
    
    }


    /**
     * Obtiene el nombre del controlador
     * 
     * @return string
     */
    public static function getController()
    {
        return self::$_controller;
    }

    /**
     * Obtiene la acción del controlador
     * 
     * @return string
     */
    public static function getAction()
    {
        return self::$_action ;
    }
    
    /**
     * Obtiene la acción del controlador
     * 
     * @return string
     */
    public static function getModule()
    {
        return self::$_module;
    }

    /**
     * Instalacia la clase Controlador y llama al metodo dependiendo de la acción.
     * <br>
     * Ejemplo de url que acepta:<br>
     * http://webtalaradev/example_mvc/index.php?controller=Test&action=Delete&pkTest=10
     * <br>
     * http://webtalaradev/example_mvc/Test/Delete/pkTest/10
     * 
     * @return object $objController
     */
    public function route()
    {
       $controller =  'Application_Controllers_'. self::$_controller .'Controller';
	   $action = self::$_action . 'Action';
       return new $controller($action);
       
    }
}
