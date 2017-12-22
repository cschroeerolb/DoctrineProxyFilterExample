<?php
use Symfony\Component\ClassLoader\MapClassLoader;

/**
 * Autoloader des Systems.
 *
 * @copyright Oldenburgische Landesbank AG
 * @author $Author: b13253 $
 * @version $Revision: 1.1 $
 * @package Kairos
 *
 */
class Autoloader
{

    /**
     * Hauptnamespace des Systems
     *
     * @var string
     */
    private $cNamespace;
    
    /**
     * Directory, ab dem gesucht wird.
     *
     * @var string
     */
    private $cBaseDir;

    /* ---------------------------------------------------------------------- */

    /**
     * Construktor
     */
    public function __construct($cNamespace = null, $cBaseDir = null)
    {
        $this->cNamespace = $cNamespace;
        $this->cBaseDir = $cBaseDir;
    }

    /* ---------------------------------------------------------------------- */

    /**
     * Diese Funktion registriert den Autoloader beim SPL-Autoloader,
     * so dass dieser den eigenen Autoloader mit aufruft.
     */
    public function register($bClassMap = false)
    {
        if($bClassMap){
            
            $map = require 'classmap_app.php';
            $oLoader = new MapClassLoader($map);
            $oLoader->register();
            
        } else {
            spl_autoload_register(array(
                $this,
                'loadClass'
            ));
        }
    }

    /* ---------------------------------------------------------------------- */

    /**
     * Eigener Autoloader für das gesammte System.
     *
     * Dabei wird der qualifizierte Klassenname übergeben und der Hauptnamespace
     * entfernt. So kann die zu ladene Klasse eindeutig identifiziert und im
     * Dateisystem gefunden werden.
     *
     * @param string $cKlassenname
     *            qualifiziert (inkl. Namespace)
     *
     * @return void
     */
    public function loadClass($cKlassenname)
    {
        // Hauptnamespace wird entfernt
        if ($this->cNamespace !== null) {
            $cKlassenname = str_replace($this->cNamespace . '\\', '', $cKlassenname);
        }

        $cKlassenname = str_replace('\\', DIRECTORY_SEPARATOR, $cKlassenname);

        $file = $this->cBaseDir . DIRECTORY_SEPARATOR . $cKlassenname . '.php';
        

        if (file_exists($file)) {
            require_once $file;
            return true;
        } else {
            return false;
        }
    }

    /* ---------------------------------------------------------------------- */
}