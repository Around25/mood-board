<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *  @ORM\Entity @ORM\Table(name="like")
 **/
class Like
{

    /**
     * @var integer $id
     * @ORM\Id @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="likes")
     * @ORM\JoinColumn(name="like_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity="Like")
     * @ORM\JoinColumn(name="like_id", referencedColumnName="id")
     */
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