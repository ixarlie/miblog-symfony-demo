<?php

namespace Miblog\AdminBundle\Form\Model;

class ArticleForm {

    protected $commatags;
    protected $article;
    protected $confirmtags;
    
    

    public function getCommaTags() {
        if(empty($this->commatags)) {
            $tags = $this->article->getTags();
            foreach ($tags as $tag) {
                $this->commatags = $this->commatags . 
                ((empty($this->commatags)) ? $tag->getLabel() : ',' . $tag->getLabel());
            } 
        }
        return $this->commatags;
    }

    public function setCommaTags($commatags) {
        $this->commatags = $commatags;
    }
    
    public function setArticle($article) {
        $this->article = $article;
    }
    
    public function getArticle() {
        return $this->article;
    }
    
    public function isConfirmTags() {
        return $this->confirmtags;
    }
    
    public function setConfirmTags($b) {
        $this->confirmtags = $b;
    }
    
    

}

?>
