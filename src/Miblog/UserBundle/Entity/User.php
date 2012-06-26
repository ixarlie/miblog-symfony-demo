<?php

namespace Miblog\MiblogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use FOS\UserBundle\Entity\User as BaseUser;
use FOS\UserBundle\Validator\Unique as UniqueConstraint;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="Miblog\UserBundle\Repository\UserRespository")
 * @UniqueConstraint(property="emailCanonical", message="user.emailCanonical.unique") 
 */
class User extends BaseUser {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    protected $createdAt;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updated_at", type="datetime")
     */
    protected $updatedAt;

    protected $username;

    protected $usernameCanonical;

    /**
     * @Assert\NotBlank(message="user.email.not_blank")
     * @Assert\MinLength(limit="4", message="user.email.min_length")
     * @Assert\MaxLength(limit="255", message="user.email.max_length")
     * @Assert\Email(message="user.email.invalid")
     */
    protected $email;

    /**
     * @Assert\NotBlank(message="user.password.not_blank")
     * @Assert\MinLength(limit="5", message="user.password.min_length")
     */
    protected $plainPassword;

    /**
     * @Assert\NotBlank(message="user.firstName.not_blank")
     * @Assert\MinLength(limit="4", message="user.firstName.min_length")
     * @Assert\MaxLength(limit="255", message="user.firstName.max_length")
     * @ORM\Column(name="first_name", type="string", length="64", nullable="true")
     */
    protected $firstName;

    /**
     * @Assert\MinLength(limit="4", message="user.lastName.min_length")
     * @Assert\MaxLength(limit="255", message="user.lastName.max_length")
     * @ORM\Column(name="last_name", type="string", length="64", nullable="true")
     */
    protected $lastName;

    /**
     * @ORM\Column(name="birth_day", type="date", nullable="true")
     */
    protected $birthDay;

    /**
     * @ORM\Column(name="lock_comment", type="text", nullable="true")
     */
    protected $lockComment;

    /**
     * @Gedmo\Timestampable(on="change", field="locked", value="true")
     * @ORM\Column(name="locked_at", type="datetime", nullable=true)
     */
    protected $lockedAt;

    /**
     * @ORM\Column(type="string", length=16)
     * @Assert\Choice({"ROLE_USER", "ROLE_ADMIN"}))
     */
    protected $role;

    /**
     * @ORM\OneToMany(targetEntity="Article", mappedBy="user")
     */
    protected $articles;

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="user")
     */
    protected $comments;

    public function __construct() {
        parent::__construct();
        $this->articles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set createdAt
     *
     * @param datetime $createdAt
     */
    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;
    }

    /**
     * Get createdAt
     *
     * @return datetime 
     */
    public function getCreatedAt() {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param datetime $updatedAt
     */
    public function setUpdatedAt($updatedAt) {
        $this->updatedAt = $updatedAt;
    }

    /**
     * Get updatedAt
     *
     * @return datetime 
     */
    public function getUpdatedAt() {
        return $this->updatedAt;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     */
    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName() {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     */
    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName() {
        return $this->lastName;
    }

    /**
     * Set birthDay
     *
     * @param date $birthDay
     */
    public function setBirthDay($birthDay) {
        $this->birthDay = $birthDay;
    }

    /**
     * Get birthDay
     *
     * @return date 
     */
    public function getBirthDay() {
        return $this->birthDay;
    }

    /**
     * Set lockComment
     *
     * @param text $lockComment
     */
    public function setLockComment($lockComment) {
        $this->lockComment = $lockComment;
    }

    /**
     * Get lockComment
     *
     * @return text 
     */
    public function getLockComment() {
        return $this->lockComment;
    }

    /**
     * Set lockedAt
     *
     * @param datetime $lockedAt
     */
    public function setLockedAt($lockedAt) {
        $this->lockedAt = $lockedAt;
    }

    /**
     * Get lockedAt
     *
     * @return datetime 
     */
    public function getLockedAt() {
        return $this->lockedAt;
    }

    /**
     * Set role
     *
     * @param string $role
     */
    public function setRole($role) {
        $this->role = $role;
    }

    /**
     * Get role
     *
     * @return string 
     */
    public function getRole() {
        return $this->role;
    }

    /**
     * Add articles
     *
     * @param Miblog\MiblogBundle\Entity\Article $articles
     */
    public function addArticle(\Miblog\MiblogBundle\Entity\Article $articles) {
        $this->articles[] = $articles;
    }

    /**
     * Get articles
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getArticles() {
        return $this->articles;
    }

    /**
     * Add comments
     *
     * @param Miblog\MiblogBundle\Entity\Comment $comments
     */
    public function addComment(\Miblog\MiblogBundle\Entity\Comment $comments) {
        $this->comments[] = $comments;
    }

    /**
     * Get comments
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getComments() {
        return $this->comments;
    }

    public function getAge() {
        $birth = $this->getBirthDay();
        list($ano, $mes, $dia) = explode("-", $birth->format('Y-m-d'));
        $ano_diferencia = date("Y") - $ano;
        $mes_diferencia = date("m") - $mes;
        $dia_diferencia = date("d") - $dia;
        if ($dia_diferencia < 0 || $mes_diferencia < 0)
            $ano_diferencia--;
        return $ano_diferencia;
    }

}