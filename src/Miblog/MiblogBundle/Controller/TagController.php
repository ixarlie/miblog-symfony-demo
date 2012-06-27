<?php

namespace Miblog\MiblogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;

class TagController extends Controller {

    /**
     * @Route("/tag/{label}", name="web_tag")
     * @Template("MiblogBundle:Default:index.html.twig")
     */
    public function indexAction($label) {
        $em = $this->get('doctrine')->getEntityManager();

        $result = $em->getRepository('MiblogBundle:Tag')->findArticlesByTag($label);

        return array(
            'filter' => $label,
            'result' => $result,
        );
    }

}

?>
