<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="st_image")
 */
class Image
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="alt", type="string", length=255)
     */
    private $alt;

    /**
     * @ORM\Column(name="path", type="string", length=255)
     */
    private $filePath;

    /**
     * @Assert\Image()
     */
    private $file;

    private $tempPath;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Trick", inversedBy="images")
     * @ORM\JoinColumn(nullable=false)
     */
    private $trick;

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
     * Set alt.
     *
     * @param string $alt
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;
    }

    /**
     * Get alt.
     *
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * Set filePath.
     *
     * @param string $filePath
     */
    public function setFilePath($filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * Get filePath.
     *
     * @return string
     */
    public function getFilePath()
    {
        return $this->filePath;
    }

    /**
     * Set file.
     *
     * @param UploadedFile|null $file
     */
    public function setFile(UploadedFile $file)
    {
        $this->file = $file;

        if (null !== $this->filePath) {
            $this->tempPath = $this->filePath;

            $this->filePath = null;
            $this->alt = null;
        }
    }

    /**
     * Get file.
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Get tempPath.
     */
    public function getTempPath()
    {
        return $this->tempPath;
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
     * @return \AppBundle\Entity\Trick
     */
    public function getTrick()
    {
        return $this->trick;
    }
}
