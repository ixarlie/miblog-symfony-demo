<?php

//Primero colocamos el namespace. Esto debe ir siempre en todas las clases.
namespace Miblog\MiblogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Miblog\MiblogBundle\Entity
 * @ORM\Table(name="articles")
 * @ORM\Entity 
 */
class Article
{
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Assert\MaxLength(255)
     */
    protected $title;
    
    /**
     * @ORM\Column(type="string")
     */
    protected $slug;
    
    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    protected $content;

    /**
     * @ORM\Column(type="datetime", name="created_at")
     * @Assert\Date()
     */
    protected $createdAt;
    
    /**
     * @ORM\Column(type="datetime", name="updated_at")
     * @Assert\Date()
     */
    protected $updatedAt;
    
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="articles")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;
    
    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="article")
     */
    protected $comments;
    
    /**
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="articles")
     * @ORM\JoinTable(name="article_tag",
     *      joinColumns={@ORM\JoinColumn(name="article_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="tag_id", referencedColumnName="id")} )
     */
    protected $tags;
    
    
    
    public function __construct()
    {
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
    $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
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
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set slug
     *
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set content
     *
     * @param text $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * Get content
     *
     * @return text 
     */
    public function getContent()
    {
        return $this->content;
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
     * Set updatedAt
     *
     * @param datetime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * Get updatedAt
     *
     * @return datetime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
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
     * Add comments
     *
     * @param Miblog\MiblogBundle\Entity\Comment $comments
     */
    public function addComment(\Miblog\MiblogBundle\Entity\Comment $comments)
    {
        $this->comments[] = $comments;
    }

    /**
     * Get comments
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Add tags
     *
     * @param Miblog\MiblogBundle\Entity\Tag $tags
     */
    public function addTag(\Miblog\MiblogBundle\Entity\Tag $tags)
    {
        $this->tags[] = $tags;
    }

    /**
     * Get tags
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getTags()
    {
        return $this->tags;
    }
}