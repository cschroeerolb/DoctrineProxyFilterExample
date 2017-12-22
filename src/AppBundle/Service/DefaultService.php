<?php
namespace AppBundle\Service;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use DeepCopy\DeepCopy;
use DeepCopy\Filter\Doctrine\DoctrineProxyFilter;
use DeepCopy\Matcher\Doctrine\DoctrineProxyMatcher;
use DeepCopy\Matcher\PropertyNameMatcher;
use DeepCopy\Filter\SetNullFilter;
use DeepCopy\Filter\Doctrine\DoctrineCollectionFilter;
use DeepCopy\Matcher\PropertyTypeMatcher;

class DefaultService implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function copyEntity($entity)
    {
        $copier = new DeepCopy();
        
        // Alle Proxy-Objekte laden
        $copier->addFilter(new DoctrineProxyFilter(), new DoctrineProxyMatcher());
        $copier->addFilter(new SetNullFilter(), new PropertyNameMatcher("id"));
        
        $copier->addFilter(new DoctrineCollectionFilter(), new PropertyTypeMatcher('Doctrine\Common\Collections\Collection'));
        
        $this->container->get('logger')->info("#################################### start copy ###############################");
        $newEntity = $copier->copy($entity);
        $this->container->get('logger')->info("#################################### end copy ###############################");
        
        return $newEntity;
    }
}

