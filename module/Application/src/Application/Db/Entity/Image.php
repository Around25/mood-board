<?php
namespace Application\Db\Entity;

use Doctrine\ORM\Mapping as ORM;

class Image
{

    private $id;

    private $name;

    private $user;
    
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

    public function setName($name)
    {
        $this->name = $name;
    }
    public function setUser($user)
    {
        $this->user = $user;
    }
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}