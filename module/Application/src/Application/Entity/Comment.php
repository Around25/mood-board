<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *  @ORM\Entity @ORM\Table(name="comment")
 **/
class Comment
{

    /**
     * @var integer $id
     * @ORM\Id @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /** @ORM\Column(type="string") */
    private $text;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="comments")
     * @ORM\JoinColumn(name="comment_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity="Comment")
     * @ORM\JoinColumn(name="comment_id", referencedColumnName="id")
     */
    private $image;

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }
    public function getUser()
    {
        return $this->user;
    }
    public function getImage()
    {
        return $this->image;
    }

    public function setText($text)
    {
        $this->text = $text;
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