<?php

namespace Miblog\UserBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;

class AdminUserController extends Controller {

    /**
     * @Secure(roles="ROLE_ADMIN")
     * @Route("user/list", name="admin_user_list")
     * @Template("UserBundle:Admin:list.html.twig")
     */
    public function listAction() {
        $em = $this->get('doctrine')->getEntityManager();

        $rs = $em->getRepository('UserBundle:User')->findAll();

        return array(
            'result' => $rs,
        );
    }
    
    
    /**
     * @Secure(roles="ROLE_ADMIN")
     * @Route("user/edit/{slug}", name="admin_user_edit")
     * @Template("UserBundle:Admin:edit.html.twig")
     */
    public function editAction() {
        
        
        
    }
    
    /**
     * @Secure(roles="ROLE_ADMIN")
     * @Route("user/new", name="admin_user_new")
     * @Template("UserBundle:Admin:new.html.twig")
     */
    public function newAction() {
        
        
        
    }
    
    /** Esto no se haria con un controlador, sino con un formulario
     * @Secure(roles="ROLE_ADMIN")
     * @Route("user/remove/{slug}", name="admin_user_remove")
     * @Template("UserBundle:Admin:list.html.twig")
     */
    public function removeAction($slug) {
        
        
        
    }

}

?>

