<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Trick")
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
     *
     * @return Image
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
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
     *
     * @return Image
     */
    public function setFilePath($filePath)
    {
        $this->filePath = $filePath;

        return $this;
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
     * Set trick.
     *
     * @param \AppBundle\Entity\Trick $trick
     *
     * @return Image
     */
    public function setTrick(\AppBundle\Entity\Trick $trick)
    {
        $this->trick = $trick;

        return $this;
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
