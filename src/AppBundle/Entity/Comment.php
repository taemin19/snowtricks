<?php

namespace AppBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="st_comment")
 */
class Comment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="message", type="text")
     */
    private $message;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="createAt", type="datetime")
     */
    private $createAt;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Trick", inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $trick;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set message.
     *
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * Get message.
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set createAt.
     *
     * @param \DateTime $createAt
     */
    public function setCreateAt($createAt)
    {
        $this->createAt = $createAt;
    }

    /**
     * Get createAt.
     *
     * @return \DateTime
     */
    public function getCreateAt()
    {
        return $this->createAt;
    }

    /**
     * Set trick.
     *
     * @param Trick $trick
     */
    public function setTrick(Trick $trick)
    {
        $this->trick = $trick;
    }

    /**
     * Get trick.
     *
     * @return Trick
     */
    public function getTrick()
    {
        return $this->trick;
    }

    /**
     * Set author.
     *
     * @param User $author
     */
    public function setAuthor(User $author)
    {
        $this->author = $author;
    }

    /**
     * Get author.
     *
     * @return User
     */
    public function getAuthor()
    {
        return $this->author;
    }
}
