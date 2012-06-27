<?php

namespace Miblog\MiblogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;

class DefaultController extends Controller {

    /**
     * @Route("/", name="web_main")
     * @Template("MiblogBundle:Default:index.html.twig")
     */
    public function indexAction() {
        $em = $this->get('doctrine')->getEntityManager();

        $articles = $em->getRepository('MiblogBundle:Article')->findAll();

        return array(
            'name' => 'Usuario',
            'articles' => $articles,
        );
    }

}
