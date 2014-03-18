<?PHP
/**
 * @package viringolight
 * @author Jose Lee <jlee@jasoftsolutions.com>
 * @copyright 2014 - JASoft Solutions E.I.R.L.
 */

/**
 * Funciones para manejo de errores.
 *
 * @package viringolight
 * @author Jose Lee <jlee@jasoftsolutions.com>
 * @copyright 2014 - JASoft Solutions E.I.R.L.
 * @version 1.0.0.0  15/03/2012
 * @access public
 */
class Class_Error
{

    /**
     * Constante para definir que el mensaje se guardará en el log y no se mostrará en la aplicación
     */
    const E_LOG = 'E_LOG';

    /**
     * Servidor Mail Configurado $config['configurationMailServer'] = 1.
     */
    const MAILSERVER = 1;

    /**
     * Modo desarrollo $config['modeDevelopment'] = 1.
     */
    const MODEDEVELOPMENT = 1;


            

    /**
     * Abre el archivo error.log y guarda el mensaje suministado por _bodyMsg.
     * 
     * @see Class_Error::_bodyMsg
     * @param string $msgError
     * @return void
     */
    private static function _logError($msgError)
    {
        
        $path = Class_Config::get('pathAndFileErrorLog');
    	error_log ($msgError , 3 , $path);

    }
    
    /**
    * Obtiene el nombre del archivo donde se efectuo el error
    */
    private static function _getFileError($v)
    {
        if(isset($v['file'])) $file = $v['file']."::";
        else $file = '';
        
        return $file;
    }
    
    /**
    * Obtiene la línea del archivo donde se efectuo el error
    */
    private static function _getLineError($v)
    {
        if(isset($v['line'])) $line = $v['line']."::";
        else $line = '';
        
        return $line;
    }
    
    /**
    * Obtiene el nombre de la clase donde se efectuo el error
    */
    private static function _getClassError($v)
    {
        if(isset($v['class'])) $class = $v['class']."::";
        else $class = '';
        
        return $class;
    }
    
    /**
    * Obtiene el nombre de la función donde se efectuo el error
    */
    private static function _getFunctionError($v)
    {
        if(isset($v['function'])) $function = $v['function']."::";
        else $function = '';
        
        return $function;
    }
    
    /**
    * Recorre todo el error para armar una cadena de trazado del error.
    */
    private static function _walkDebugError()
    {
        $backtrace = "";
                
        foreach(debug_backtrace() as $k=>$v){ 
            if($k != 0){
            
                if(self::_getFunctionError($v) == "include" || self::_getFunctionError($v) == "include_once" || self::_getFunctionError($v) == "require_once" || self::_getFunctionError($v) == "require"){ 
                    $backtrace .= "#".$k." ".self::_getClassError($v).self::_getFunctionError($v)."(".$v['args'][0].") called at [".self::_getFileError($v).":".self::_getLineError($v)."]\r\n"; 
                }else{ 
                    $backtrace .= "#".$k." ".self::_getClassError($v).self::_getFunctionError($v)."() called at [".self::_getFileError($v).":".self::_getLineError($v)."]\r\n"; 
                }
            
            } 
        } 
        return $backtrace;
    }
   

   
    private static function _setMsgError($msgError)
    {
               
        $msg = 'Name Application = '.Class_Config::get('nameApplication')."\r\n";
        $msg .= 'Ip Client= '.$_SERVER['REMOTE_ADDR']."\r\n";
        $msg .= 'Ip Server= '.$_SERVER['SERVER_ADDR']."\r\n";
        $msg .= 'Date = '.Class_App::getDateTimeNow()."\r\n";
        $msg .= 'Url = '.$_SERVER['SCRIPT_NAME']."\r\n";
        $msg .= 'Post = '.json_encode($_POST)."\r\n";
        $msg .= 'Get = '.json_encode($_GET)."\r\n";
        if(isset($_SESSION))
            $msg .= 'Session ='.json_encode($_SESSION)."\r\n";
      
        $msg .= "Controller = ".Class_FrontController::getController()."\r\n";
        $msg .= "Action = ".Class_FrontController::getAction()."\r\n";
        $msg .= self::_walkDebugError()."\r\n";
        $msg .= $msgError;
        
      
        return $msg;
        
    }
    
    /**
     * Envia el mensaje de error al correo del webmaster o imprime el mensaje en pantalla.
     * 
     * <b>[algoritmo]</b><br>
     * <i>Condición:</i> $config['modeDevelopment'] != 1  y $config['configurationMailServer'] == 1.<br>
     * <i>Verdadero:</i> Envia un email con el error y le muestra un mensaje amigable al usuario.<br>
     * <i>Falso:</i> Muestra el mensaje de error en pantalla.
     * 
     * Los errores en modo ejecución obligatoriamente se guarden en el archivo error.log.
     *  
     * @param string $msgError Mensaje de error, definido por el desarrollador.
     * @param integer si $typeError = E_ERROR, E_WARNING o E_PARSE, el error obligatoriamente se muestra en pantalla.
     * @return void
     */
    public static function messageError($msgError, $typeError = E_ERROR)
    {
        
        if (isset($msgError)) {
        
                       
            $msgErrorHtml = nl2br(self::_setMsgError($msgError));
            $msgErrorText = self::_setMsgError($msgError);
                            
            if (Class_Config::get('modeDevelopment') === Class_Error::MODEDEVELOPMENT) {
                
                if ($typeError == E_ERROR or $typeError == E_WARNING or $typeError == E_PARSE)
                    die($msgErrorHtml);
                elseif($typeError != self::E_LOG)
                    echo ($msgErrorHtml);
            } else{
                self::_logError($msgErrorText);
                
                if (Class_Config::get('configurationMailServer') === Class_Error::MAILSERVER) {
                    $tempEmail = Class_Config::get('sendMailFrom');
                    $tempDeveloperEmail = Class_Config::get('developerEmail');
                    $header = 'From: ' . $tempEmail ;
                    error_log($msgErrorHtml, 1, $tempDeveloperEmail, $header);
                } 
                    
                if ($typeError == E_ERROR or $typeError == E_WARNING or $typeError == E_PARSE)
                   die(Class_Error_Language::get('error'));
                    
                
		}
        } else {
            die('Error Not Found, Message Empty');
            exit(0);
        }


    }

    
}