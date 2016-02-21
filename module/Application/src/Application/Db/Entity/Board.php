<?php
namespace Application\Db\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

class Board
{
    
    private $id;
    
    private $name;

    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }
    
    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    public function getUsers()
    {
        return $this->users;
    }
    
    public function setName($name)
    {
        $this->name = $name;
    }
    public function setUsers($users)
    {
        $this->users = $users;
    }
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}