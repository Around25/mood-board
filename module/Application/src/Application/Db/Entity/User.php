<?php
namespace Application\Db\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

class User
{

    private $id;

    private $name;

    private $board;
    
    private $images;
    
    private $likes;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->likes = new ArrayCollection();
    }

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
    public function getImages()
    {
        return $this->images;
    }
    public function getLikes()
    {
        return $this->likes;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
    public function setBoard($board)
    {
        $this->board = $board;
    }
    public function setImages($images)
    {
        $this->images = $images;
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