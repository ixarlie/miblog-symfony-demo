<?php

namespace Miblog\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;

class AdminTagController extends Controller {

    /**
     * @Secure(roles="ROLE_ADMIN")
     * @Route("tag/list", name="admin_tag_list")
     * @Template("AdminBundle:Tags:list.html.twig")
     */
    public function listAction() {
        $em = $this->get('doctrine')->getEntityManager();

        $rs = $em->getRepository('MiblogBundle:Tag')->findAll();

        return array(
            'result' => $rs,
        );
    }
    
    
    /**
     * @Secure(roles="ROLE_ADMIN")
     * @Route("tag/edit/{slug}", name="admin_tag_edit")
     * @Template("AdminBundle:Tags:edit.html.twig")
     */
    public function editAction() {
        
        
        
    }
    
    /**
     * @Secure(roles="ROLE_ADMIN")
     * @Route("tag/new", name="admin_tag_new")
     * @Template("AdminBundle:Tags:new.html.twig")
     */
    public function newAction() {
        
        
        
    }
    
    /** Esto no se haria con un controlador, sino con un formulario
     * @Secure(roles="ROLE_ADMIN")
     * @Route("tag/remove/{slug}", name="admin_tag_remove")
     * @Template("AdminBundle:Tags:list.html.twig")
     */
    public function removeAction($slug) {
        
        
        
    }

}

?>
