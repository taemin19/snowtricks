<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="st_trick")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TrickRepository")
 */
class Trick
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 2,
     *      minMessage = "The title must be at least {{ limit }} characters long"
     * )
     * @ORM\Column(name="title", type="string")
     */
    private $title;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 2,
     *      max = 255,
     *      minMessage = "The description must be at least {{ limit }} characters long",
     *      maxMessage = "The description cannot be longer than {{ limit }} characters"
     * )
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 2,
     *      minMessage = "The content must be at least {{ limit }} characters long"
     * )
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @ORM\Column(name="published", type="boolean")
     */
    private $published = true;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="createAt", type="datetime")
     */
    private $createAt;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updateAt", type="datetime")
     */
    private $updateAt;

    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */
    private $slug;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;

    /**
     * @var Category[]|ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Category", cascade={"persist"})
     * @ORM\JoinTable(name="st_trick_category")
     */
    private $categories;

    /**
     * @var Image[]|ArrayCollection
     *
     * @Assert\Valid()
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Image", mappedBy="trick", cascade={"persist", "remove"})
     */
    private $images;

    /**
     * @var Video[]|ArrayCollection
     *
     * @Assert\Valid()
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Video", mappedBy="trick", cascade={"persist", "remove"})
     */
    private $videos;

    /**
     * @var Comment[]|ArrayCollection
     *
     * @Assert\Valid()
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Comment", mappedBy="trick", cascade={"persist", "remove"})
     */
    private $comments;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->images = new ArrayCollection();
        $this->videos = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

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
     * Set title.
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description.
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set content.
     *
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * Get content.
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set published.
     *
     * @param bool $published
     */
    public function setPublished($published)
    {
        $this->published = $published;
    }

    /**
     * Get published.
     *
     * @return bool
     */
    public function getPublished()
    {
        return $this->published;
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
     * Set updateAt.
     *
     * @param \DateTime $updateAt
     */
    public function setUpdateAt($updateAt)
    {
        $this->updateAt = $updateAt;
    }

    /**
     * Get updateAt.
     *
     * @return \DateTime
     */
    public function getUpdateAt()
    {
        return $this->updateAt;
    }

    /**
     * Set slug.
     *
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * Get slug.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
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

    /**
     * Add category.
     *
     * @param $category
     */
    public function setCategories($category)
    {
        // with a non multiple select field
        $this->categories->add($category);

        /* with a multiple select field
         * foreach ($categories as $category) {
         *  if (!$this->categories->contains($category)) {
         *      $this->categories->add($category);
         *  }
         * }
         */
    }

    /**
     * Remove category.
     *
     * @param Category $category
     */
    public function removeCategory(Category $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Get categories.
     *
     * @return ArrayCollection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Add image.
     *
     * @param \AppBundle\Entity\Image $image
     */
    public function addImage(Image $image)
    {
        $this->images[] = $image;

        $image->setTrick($this);
    }

    /**
     * Remove image.
     *
     * @param Image $image
     */
    public function removeImage(Image $image)
    {
        $this->images->removeElement($image);
    }

    /**
     * Get images.
     *
     * @return ArrayCollection
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Add video.
     *
     * @param Video $video
     */
    public function addVideo(Video $video)
    {
        $this->videos[] = $video;

        $video->setTrick($this);
    }

    /**
     * Remove video.
     *
     * @param Video $video
     */
    public function removeVideo(Video $video)
    {
        $this->videos->removeElement($video);
    }

    /**
     * Get videos.
     *
     * @return ArrayCollection
     */
    public function getVideos()
    {
        return $this->videos;
    }

    /**
     * Add comment.
     *
     * @param Comment $comment
     */
    public function addComment(Comment $comment)
    {
        $this->comments[] = $comment;

        $comment->setTrick($this);
    }

    /**
     * Remove comment.
     *
     * @param Comment $comment
     */
    public function removeComment(Comment $comment)
    {
        $this->comments->removeElement($comment);
    }

    /**
     * Get comments.
     *
     * @return ArrayCollection
     */
    public function getComments()
    {
        return $this->comments;
    }
}
