<?php

namespace Miblog\MiblogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;

class ArticleController extends Controller {

    /**
     * @Route("/article/{slug}", name="web_article")
     * @Template("MiblogBundle:Articles:index.html.twig")
     */
    public function indexAction($slug) {
        $em = $this->get('doctrine')->getEntityManager();

        $articles = $em->getRepository('MiblogBundle:Article')->findBy(
                array(
                   "slug" => $slug, 
                ));

        return array(
            'articles' => $articles,
        );
    }

}

?>
