<?php

namespace Miblog\MiblogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Miblog\MiblogBundle\Entity\Article;

class LoadArticles extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    
    private $container;

    public function getOrder(){
        return 203;
    }
    
    public function load(ObjectManager $manager){
        
        $content = 'Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos. Eu sit tincidunt incorrupte definitionem, vis mutat affert percipit cu, eirmod consectetuer signiferumque eu per. In usu latine equidem dolores. Quo no falli viris intellegam, ut fugit veritus placerat per. Ius id vidit volumus mandamus, vide veritus democritum te nec, ei eos debet libris consulatu. No mei ferri graeco dicunt, ad cum veri accommodare. Sed at malis omnesque delicata, usu et iusto zzril meliore. Dicunt maiorum eloquentiam cum cu, sit summo dolor essent te';
         
        $articleOne = new Article();
        $articleOne->setTitle('Introducing Symfony');
        $articleOne->setContent($content);
        $articleOne->setCreatedAt(new \DateTime());
        $articleOne->setUpdatedAt(new \DateTime());
        $articleOne->setUser($manager->merge($this->getReference('superuser')));
        $articleOne->addTag($manager->merge($this->getReference('php')));
        $articleOne->addTag($manager->merge($this->getReference('misc')));
        $this->addReference('articleOne', $articleOne);
        $manager->persist($articleOne);
        
        $articleTwo = new Article();
        $articleTwo->setTitle('Installing Symfony');
        $articleTwo->setContent($content);
        $articleTwo->setCreatedAt(new \DateTime());
        $articleTwo->setUpdatedAt(new \DateTime());
        $articleTwo->setUser($manager->merge($this->getReference('superuser')));
        $articleTwo->addTag($manager->merge($this->getReference('php')));
        $this->addReference('articleTwo', $articleTwo);
        $manager->persist($articleTwo);
        
        $manager->flush();
        
    }
    public function setContainer(ContainerInterface $container = null){
        $this->container = $container;
    }
    
    public function addComment()
    {
        
        
        
    }
}
?>
