<?php

namespace Miblog\MiblogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="tags")
 * @ORM\Entity(repositoryClass="Miblog\MiblogBundle\Repository\TagRepository")
 */
class Tag
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", unique=true, length=16)
     * @Assert\NotBlank()
     * @Assert\MinLength(3)
     * @Assert\MaxLength(16)
     */
    protected $label;
    
    /**
     * @ORM\ManyToMany(targetEntity="Article", mappedBy="tags")
     */
    protected $articles;
    public function __construct()
    {
        $this->articles = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set label
     *
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * Get label
     *
     * @return string 
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Add articles
     *
     * @param Miblog\MiblogBundle\Entity\Article $articles
     */
    public function addArticle(\Miblog\MiblogBundle\Entity\Article $articles)
    {
        $this->articles[] = $articles;
    }

    /**
     * Get articles
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getArticles()
    {
        return $this->articles;
    }
}