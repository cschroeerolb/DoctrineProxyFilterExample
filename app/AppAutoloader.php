<?php

/**
 * 
 * Autoloader für den globalen Namespace im app-Ordner.
 * 
 * @copyright Oldenburgische Landesbank AG
 * @author $Author: b15455 $
 * @version $Revision$
 * @package Kairos2
 *
 */
class AppAutoloader
{

    public static function register()
    {
        function app_autoloader($className)
        {
            $currentDir = dirname(__FILE__);
            if (file_exists($currentDir . '/' . $className . '.php')) {
                include $currentDir . '/' . $className . '.php';
            }
        }
        
        spl_autoload_register( 
                'app_autoloader' );
        
    }

}