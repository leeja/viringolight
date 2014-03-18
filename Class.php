<?PHP
/**
 * @package viringolight
 * @author Jose Lee <jlee@jasoftsolutions.com>
 * @copyright 2014 - JASoft Solutions E.I.R.L.
 */

define( 'VERSION' , 'viringolight');

/**
* Manejo de errores
*
*/
set_error_handler ('functionError');
function functionError($errno, $errstr, $errfile, $errline)
{
 if( 0 != error_reporting () )
  {
  switch ($errno) {
    case E_ERROR:
        $error = "<b>ERROR</b> [$errno] $errstr<br />\n";
        $error .=  "  Error fatal en la línea $errline en el archivo $errfile";
	if(class_exists ('Class_Error'))
        	Class_Error::messageError($error);
       else
       	 die($error);
        break;

    case E_WARNING:
        $error = "<b>WARNING</b> [$errno] $errstr en la línea $errline de $errfile<br />\n";
        if(class_exists ('Class_Error'))
        	Class_Error::messageError($error, E_NOTICE);
       else
	 	echo $error;

        break;
        
    case E_PARSE:
        $error = "<b>PARSE</b> [$errno] $errstr en la línea $errline de $errfile<br />\n";
        if(class_exists ('Class_Error'))
       	 Class_Error::messageError($error);
       else
        	die($error);

        break;

    case E_NOTICE:
        $error = "<b>NOTICE</b> [$errno] $errstr en la línea $errline de $errfile<br />\n";
	if(class_exists ('Class_Error'))
        	Class_Error::messageError($error, E_NOTICE);
       else
		 echo $error;
        break;

    default:
        $error = "<b>Error:</b> [$errno] $errstr en la línea $errline de $errfile<br />\n";
        if(class_exists ('Class_Error'))
       	 Class_Error::messageError($error);
       else
       	 die($error);

        break;
    }
  }
}

spl_autoload_register('viringoAutoload');
function viringoAutoload($className)
{
    $structClass = explode('_', $className);
    if ($structClass[0] == 'Class'){
    	$include = VERSION . DIRECTORY_SEPARATOR . str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
	
        require_once($include);
                
    }
    
    else{
        
    	$include = str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
    		require_once ($include);

  }
}