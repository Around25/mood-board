<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *  @ORM\Entity @ORM\Table(name="image")
 **/
class Image
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
     * @ORM\ManyToOne(targetEntity="User", inversedBy="images")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity="Comment")
     * @ORM\JoinColumn(name="comment_id", referencedColumnName="id")
     */
    private $comment;

    /**
     * @ORM\OneToOne(targetEntity="Like")
     * @ORM\JoinColumn(name="like_id", referencedColumnName="id")
     */
    private $like;

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
    public function getComment()
    {
        return $this->comment;
    }

    public function getLike()
    {
        return $this->like;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
    public function setUser($user)
    {
        $this->user = $user;
    }
    public function setComment($comment)
    {
        $this->comment = $comment;
    }
    public function setLike($like)
    {
        $this->like = $like;
    }
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}