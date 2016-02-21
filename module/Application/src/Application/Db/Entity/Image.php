<?php
namespace Application\Db\Entity;

use Doctrine\ORM\Mapping as ORM;

class Image
{

    private $id;

    private $name;

    private $user;
    
    private $likes;

    public function __construct()
    {
        $this->likes = new ArrayCollection();
    }
    
    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    public function getUser()
    {
        return $this->user;
    }
    public function getLikes()
    {
        return $this->likes;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
    public function setUser($user)
    {
        $this->user = $user;
    }
    public function setLikes($likes)
    {
        $this->likes = $likes;
    }
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}