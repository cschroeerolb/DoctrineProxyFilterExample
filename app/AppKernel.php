<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    
    private $cBaseTmpDir;
    
    public function __construct($environment, $debug){
        parent::__construct($environment, $debug);
        
        $matches = array();
        preg_match("/\/.*\/(.*){1,1}\/app/", dirname(__FILE__), $matches);
        $projectName = $matches[1];
        
        $this->cBaseTmpDir = "/nfs/tmp/chronos/$projectName";
    }
    
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new AppBundle\AppBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'), true)) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');
    }
    
    public function getCharset()
    {
        return 'ISO-8859-15';
        //             return 'UTF-8';
    }
    
    public function getCacheDir(){
        return $this->cBaseTmpDir."/cache/".$this->getEnvironment();
    }
    
    public function getLogDir()
    {
        return $this->cBaseTmpDir."/logs/".$this->getEnvironment();
    }
}
