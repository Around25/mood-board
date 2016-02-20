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
     * @ORM\ManyToOne(targetEntity="Board", inversedBy="users")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $board;

    /**
     * @ORM\OneToMany(targetEntity="Image", mappedBy="user")
     **/
    private $images;

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="user")
     **/
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity="Like", mappedBy="user")
     **/
    private $likes;

    public function __construct()
    {
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->likes = new \Doctrine\Common\Collections\ArrayCollection();
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
    public function getComments()
    {
        return $this->comments;
    }
    public function getLikes()
    {
        return $this->likes;
    }
    
    public function setName($name)
    {
        $this->likes = $name;
    }
    public function setBoard($board)
    {
        $this->board = $board;
    }
    public function setImages($images)
    {
        $this->images = $images;
    }
    public function setComments($comments)
    {
        $this->comments = $comments;
    }
    public function setLikes($likes)
    {
        $this->name = $likes;
    }
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}