<?php

namespace Miblog\MiblogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Miblog\MiblogBundle\Entity\Tag;

class LoadTags extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    
    private $container;
    
    public function getOrder() {
        return 202;
    }
    
    public function load(ObjectManager $manager) {
        
        $tags = array('php','java','python','javascript','delphi','.net','ruby','misc');
        
        foreach ($tags as $key=>$tag)
        {
            $elemTag = new Tag();
            $elemTag->setLabel($tag);
            $this->addReference($tag, $elemTag);
            $manager->persist($elemTag);
        }
        $manager->flush();
        
    }
    
    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }
}

?>
