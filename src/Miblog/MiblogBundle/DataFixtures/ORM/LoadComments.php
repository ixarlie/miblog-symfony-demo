<?php

namespace Miblog\MiblogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Miblog\MiblogBundle\Entity\Comment;

class LoadComment extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface {

    private $container;

    public function getOrder() {
        return 204;
    }

    public function load(ObjectManager $manager) {
        
        $articleOne = $manager->merge($this->getReference('articleOne'));
        $articleTwo = $manager->merge($this->getReference('articleTwo'));
        $superuser = $manager->merge($this->getReference('superuser'));
        
        $comments = array(
            array(
                'message' => 'Ya podéis comentar',
                'user' => $superuser,
                'article' => $articleOne
            ),
            array(
                'message' => 'Me gusto mucho, gracias!',
                'user' => $manager->merge($this->getReference('user1')),
                'article' => $articleOne
            ),
            array(
                'message' => 'Y a mí!',
                'user' => $manager->merge($this->getReference('user2')),
                'article' => $articleOne
            ),
            array(
                'message' => 'Para cuando estará el siguiente?',
                'user' => $manager->merge($this->getReference('user3')),
                'article' => $articleTwo
            ),
            array(
                'message' => 'Pronto, no seáis impacientes',
                'user' => $superuser,
                'article' => $articleTwo
            ),
        );
        
        foreach($comments as $key=>$dataComment)
        {
            $comment = new Comment();
            
            foreach($dataComment as $prop=>$value) {
                $comment->{'set'.ucfirst($prop)}($value);
            }
            $comment->setCreatedAt(new \DateTime());
            $this->addReference('comment'.$key, $comment);
            $manager->persist($comment);
        }
        $manager->flush();
    }

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

}

?>
