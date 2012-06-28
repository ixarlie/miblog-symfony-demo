<?php

namespace Miblog\AdminBundle\Form\Model;

class ArticleForm {

    protected $commatags;
    protected $article;
    protected $confirmtags;
    
    

    public function getCommaTags() {
        $ret = '';
        $tags = $this->article->getTags();
        foreach ($tags as $tag) {
            $ret = $ret . ((empty($ret)) ? $tag->getLabel() : ',' . $tag->getLabel());
        }
        return $ret;
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
