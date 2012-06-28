<?php

namespace Miblog\AdminBundle\Form\Handler;

use Symfony\Component\Form\Form;  
use Symfony\Component\HttpFoundation\Request;  
use Doctrine\ORM\EntityManager;
use FOS\UserBundle\Model\UserInterface;

use Miblog\AdminBundle\Form\Model\ArticleForm;
use Miblog\MiblogBundle\Entity\Article;

class ArticleFormHandler {

    protected $request;
    protected $em;
    protected $form;
    protected $user;
    
    public function __construct(Form $form, Request $request, EntityManager $em, UserInterface $user)
    {
        $this->form = $form;
        $this->request = $request;
        $this->em = $em;
        $this->user = $user;
    }

    public function process(ArticleForm $articleform = null)
    {
        $this->form->setData($articleform);

        if ('POST' == $this->request->getMethod()) {
            $this->form->bindRequest($this->request);

            if ($this->form->isValid()) {
                $this->onSuccess($this->form->getData());
                return false;
            }
        }

        return false;
    }
    
    /**
     * @return void 
     */
    protected function onSuccess(ArticleForm $articleform)
    {     
        $article = $articleform->getArticle();
        
        // Article
        $article->setUser($this->user);
        
        $rs = $this->em->getRepository('MiblogBundle:Tag')->getAllTagnames();
        $rs_values = array_values($rs);
        echo print_r($rs_values, true);
        $tags = explode(',',$articleform->getCommaTags());
        foreach($tags as $tag)
        {
            $tag = trim($tag);
            if(!in_array($tag,$rs)) {
                echo 'no esta la etiqueta '.$tag;
            }
            
        }
        
        
        

        $this->em->persist($article);
        $this->em->flush();
    } 

}

?>
