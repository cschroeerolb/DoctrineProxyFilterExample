<?php
use Doctrine\Common\Annotations\AnnotationRegistry;
use Composer\Autoload\ClassLoader;

/**
 *
 * @var ClassLoader $loader Diese Datei wird benötigt zum Autoloaden während des Composer-Build-Prozesses.
 *      Als Autoload-Quelle wird das vendor-Verzeichnis genutzt.
 *     
 * @var unknown $loader
 */

$loader = require __DIR__ . '/../vendor/autoload.php';

AnnotationRegistry::registerLoader(array(
    $loader,
    'loadClass'
));

$oAppAutoloader = new AppAutoloader();
$oAppAutoloader->register();

$oAutoloader = new Autoloader(null, __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "src");


// AnnotationRegistry::register(array(
//     $oAutoloader,
//     'loadClass'
// ));

// AnnotationRegistry::registerAutoloadNamespace('AntragBundle\KostenFinanzierung\Validator', __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "src");
// AnnotationRegistry::registerAutoloadNamespace('AntragBundle\KostenFinanzierung\Entity', __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "src");

// $oAutoloader2 = new Autoloader(null, __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "src");

AnnotationRegistry::registerLoader(array(
    $oAutoloader,
    'loadClass'
));

$oAutoloader->register();

return $loader;
