<?php

namespace Miblog\MiblogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * @ORM\Table(name="comments")
 * @ORM\Entity(repositoryClass="Miblog\MiblogBundle\Entity\CommentRepository)
 */
class Comment
{
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    protected $message;
    
    /**
     * @ORM\Column(type="datetime", name="created_at")
     * @Assert\Date()
     * @Gedmo\Timestampable(on="create")
     */
    protected $createdAt;
    
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="comments")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;
    
    /**
     * @ORM\ManyToOne(targetEntity="Article", inversedBy="comments")
     * @ORM\JoinColumn(name="article_id", referencedColumnName="id")
     */
    protected $article;
    
    

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set message
     *
     * @param text $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * Get message
     *
     * @return text 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set createdAt
     *
     * @param datetime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Get createdAt
     *
     * @return datetime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set user
     *
     * @param Miblog\MiblogBundle\Entity\User $user
     */
    public function setUser(\Miblog\MiblogBundle\Entity\User $user)
    {
        $this->user = $user;
    }

    /**
     * Get user
     *
     * @return Miblog\MiblogBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set article
     *
     * @param Miblog\MiblogBundle\Entity\Article $article
     */
    public function setArticle(\Miblog\MiblogBundle\Entity\Article $article)
    {
        $this->article = $article;
    }

    /**
     * Get article
     *
     * @return Miblog\MiblogBundle\Entity\Article 
     */
    public function getArticle()
    {
        return $this->article;
    }
}