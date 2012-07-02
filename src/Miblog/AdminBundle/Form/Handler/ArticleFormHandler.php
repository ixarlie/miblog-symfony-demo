<?php

namespace Miblog\AdminBundle\Form\Handler;

use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use FOS\UserBundle\Model\UserInterface;
use Miblog\AdminBundle\Form\Model\ArticleForm;
use Miblog\MiblogBundle\Entity\Article;
use Miblog\MiblogBundle\Entity\Tag;

class ArticleFormHandler {

    protected $request;
    protected $em;
    protected $form;
    protected $user;

    public function __construct(Form $form, Request $request, EntityManager $em, UserInterface $user) {
        $this->form = $form;
        $this->request = $request;
        $this->em = $em;
        $this->user = $user;
    }

    public function process(ArticleForm $articleform = null) {
        $this->form->setData($articleform);

        if ('POST' == $this->request->getMethod()) {
            $this->form->bindRequest($this->request);

            if ($this->form->isValid()) {
                $this->onSuccess($this->form->getData());
                return true;
            }
        }

        return false;
    }

    /**
     * @return void 
     */
    protected function onSuccess(ArticleForm $articleform) {
        $article = $articleform->getArticle();

        // Article
        $article->setUser($this->user);

        //Tratando etiquetas
        $repo = $this->em->getRepository('MiblogBundle:Tag');
        $formTags = explode(',', $articleform->getCommaTags());
        //Eliminando etiquetas
        $it = $article->getTags()->getIterator();
        while($it->valid()) {
            $currentTag = $it->current();
            if(!in_array($currentTag->getLabel(), $formTags)) {
                //borramos la etiquetas
                $article->getTags()->removeElement($currentTag);         
            }
            $it->next();
        }
        foreach ($formTags as $tag) {
            $tag = trim($tag);
            $objTag = $repo->existsTag($tag);
            if ($objTag == null && $articleform->isConfirmTags() ) {
                //La etiqueta no es conocida y se permite crear
                    $objTag = new Tag();
                    $objTag->setLabel($tag);
                    $this->em->persist($objTag);
                    $article->addTag($objTag);
            } else if(!$article->getTags()->contains($objTag)) {
                //La etiqueta existe y ademas no lo tiene el objeto
                $article->addTag($objTag);
            }
        }
        $this->em->persist($article);
        $this->em->flush();
    }

}

?>
