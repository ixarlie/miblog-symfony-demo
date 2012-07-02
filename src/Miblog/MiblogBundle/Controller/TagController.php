<?php

namespace Miblog\MiblogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;

class TagController extends Controller {

    /**
     * @Route("/tag/{slug}", name="web_tag")
     * @Template("MiblogBundle:Default:index.html.twig")
     */
    public function indexAction($slug) {
        $em = $this->get('doctrine')->getEntityManager();

        $result = $em->getRepository('MiblogBundle:Tag')->findArticlesByTag($slug);
        
        $rs = $em->getRepository('MiblogBundle:Tag')->findOneBy(
                array(
                   'slug' => $slug, 
                ));

        return array(
            'filter' => $rs->getLabel(),
            'result' => $result,
        );
    }

}

?>
