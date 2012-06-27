<?php

namespace Miblog\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;


class UserController extends Controller
{
    
    /**
     * @Route("/articles/user/{name}", name="web_user_articles")
     * @Template("MiblogBundle:Default:index.html.twig")
     */
    public function indexAction($name)
    {
        $em = $this->get('doctrine')->getEntityManager();

        $result = $em->getRepository('UserBundle:User')->findArticlesByUserName($name);

        return array(
            'filter' => $name,
            'result' => $result,
        );
        
    }

}

?>
