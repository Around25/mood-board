<?php
namespace Application\Db\Entity;

use Doctrine\ORM\Mapping as ORM;

class Like
{

    private $id;

    private $user;

    private $image;

    public function getUser()
    {
        return $this->user;
    }
    public function getImage()
    {
        return $this->image;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }
    public function setImage($image)
    {
        $this->image = $image;
    }
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}