<?php
namespace Application\Db\Entity;

use Doctrine\ORM\Mapping as ORM;

class User
{

    private $id;

    private $name;

    private $board;
    
    private $images;

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

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}