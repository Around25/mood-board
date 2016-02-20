<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *  @ORM\Entity @ORM\Table(name="user")
 **/
class User
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
     * @ORM\ManyToOne(targetEntity="Board", inversedBy="user")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=true)
     */
    private $board;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    public function getBoard()
    {
        return $this->board;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
    public function setBoard($board)
    {
        $this->board = $board;
    }
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}