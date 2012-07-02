<?php

namespace Miblog\AdminBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Miblog\AdminBundle\Form\Model\ArticleForm;
use Miblog\AdminBundle\Form\Type\ArticleFormType;
use Miblog\AdminBundle\Form\Handler\ArticleFormHandler;
use Miblog\MiblogBundle\Entity\Article;

class AdminArticleController extends ContainerAware {

    /**
     * @Secure(roles="ROLE_ADMIN")
     * @Route("article/list", name="admin_article_list")
     * @Template("AdminBundle:Articles:list.html.twig")
     */
    public function listAction() {
        $em = $this->container->get('doctrine')->getEntityManager();

        $rs = $em->getRepository('MiblogBundle:Article')->findBy(
                array(), array('createdAt' => 'ASC')
        );

        return array(
            'result' => $rs,
        );
    }

    /**
     * @Secure(roles="ROLE_ADMIN")
     * @Route("article/edit/{slug}", name="admin_article_edit")
     * @Template("AdminBundle:Articles:edit.html.twig")
     */
    public function editAction($slug) {
        $em = $this->container->get('doctrine')->getEntityManager();
        $rs = $em->getRepository('MiblogBundle:Article')->findOneBy(
                array(
                    'slug' => $slug,
                ));

        $form = $this->container->get('form.factory')->create(new ArticleFormType(), array());

        $form_handler = new ArticleFormHandler(
                        $form,
                        $this->container->get('request'),
                        $this->container->get('doctrine.orm.entity_manager'),
                        $rs->getUser());

        $articleform = new ArticleForm();
        $articleform->setArticle($rs);
        $articleform->setConfirmTags(true);

        $process = $form_handler->process($articleform);

        if ($process) {
            $this->setFlash('aviso1', 'El artículo se modificó correctamente');
            return new RedirectResponse($this->container->get('router')->generate('admin_article_list'));
        }

        return array(
            'form' => $form->createView(),
            'slug' => $slug,
            'user' => $rs->getUser()->getUsername(),
        );
    }

    /**
     * @Secure(roles="ROLE_ADMIN")
     * @Route("article/new", name="admin_article_new")
     * @Template("AdminBundle:Articles:new.html.twig")
     */
    public function newAction() {
        $form = $this->container->get('form.factory')->create(new ArticleFormType(), array());

        $form_handler = new ArticleFormHandler(
                        $form,
                        $this->container->get('request'),
                        $this->container->get('doctrine.orm.entity_manager'),
                        $this->container->get('security.context')->getToken()->getUser());

        $articleform = new ArticleForm();
        $articleform->setArticle(new Article());
        $articleform->setConfirmTags(true);

        $process = $form_handler->process($articleform);

        if ($process) {
            $this->setFlash('aviso1', 'El artículo se creó correctamente');
            return new RedirectResponse($this->container->get('router')->generate('admin_article_list'));
        }

        return array(
            'form' => $form->createView(),
        );
    }

    /** Esto no se haria con un controlador, sino con un formulario
     * @Secure(roles="ROLE_ADMIN")
     * @Route("article/remove", name="admin_article_remove")
     * @Template("AdminBundle:Articles:list.html.twig")
     */
    public function removeAction() {
        $request = $this->container->get('request');
        if ($request->getMethod() == 'POST') {
            $val = $request->get('deleteid');
            
            
            $this->setFlash('aviso1', 'El artículo '.$val.' se borró o algo correctamente');
            return new RedirectResponse($this->container->get('router')->generate('admin_article_list'));
        }
        return array();
    }

    protected function setFlash($action, $value) {
        $this->container->get('session')->setFlash($action, $value);
    }

}

?>
