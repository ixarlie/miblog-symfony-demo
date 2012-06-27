<?php

namespace Miblog\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;

class AdminArticleController extends Controller {

    /**
     * @Secure(roles="ROLE_ADMIN")
     * @Route("article/list", name="admin_article_list")
     * @Template("AdminBundle:Articles:list.html.twig")
     */
    public function listAction() {
        $em = $this->get('doctrine')->getEntityManager();

        $rs = $em->getRepository('MiblogBundle:Article')->findAll();

        return array(
            'result' => $rs,
        );
    }
    
    
    /**
     * @Secure(roles="ROLE_ADMIN")
     * @Route("article/edit/{slug}", name="admin_article_edit")
     * @Template("AdminBundle:Articles:edit.html.twig")
     */
    public function editAction() {
        
        
        
    }
    
    /**
     * @Secure(roles="ROLE_ADMIN")
     * @Route("article/new", name="admin_article_new")
     * @Template("AdminBundle:Articles:new.html.twig")
     */
    public function newAction() {
        
        
        
    }
    
    /** Esto no se haria con un controlador, sino con un formulario
     * @Secure(roles="ROLE_ADMIN")
     * @Route("article/remove/{slug}", name="admin_article_remove")
     * @Template("AdminBundle:Articles:list.html.twig")
     */
    public function removeAction($slug) {
        
        
        
    }

}

?>
