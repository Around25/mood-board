<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *  @ORM\Entity @ORM\Table(name="board")
 **/
class Board
{

    /**
     * @var integer $id
     * @ORM\Id @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /** @ORM\Column(type="string") */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="board")
     **/
    private $users;

    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
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
        return $this->access_token;
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