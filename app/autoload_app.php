<?php

/**
 * Script wird ben�tigt f�r das Autoloaden des globalen Namespaces im app-Ordner.
 */

function app_autoloader($className)
{
    $currentDir = dirname(__FILE__);
    if (file_exists($currentDir . '/' . $className . '.php')) {
        include $currentDir . '/' . $className . '.php';
    }
}

spl_autoload_register('app_autoloader');