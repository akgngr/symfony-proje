<?php

namespace App\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CalismaAlanlariRepository")
 */
class CalismaAlanlari
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text", length=600)
     */
    private $summary;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $body;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Assert\File(mimeTypes={"image/jpeg", "image/pjpeg", "image/png", "image/gif"})
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $icon;

    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(type="string", length=100, unique=true)
     */
    private $slug;

    /**
     * @var integer
     * @ORM\Column(type="smallint")
     */
    private $show_frontpage;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(?string $summary): self
    {
        $this->summary = $summary;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image): ? self
    {
        $this->image = $image;

        return $this;
        
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(?string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function getShowFrontpage(): ?int
    {
        return $this->show_frontpage;
    }

    public function setShowFrontpage(int $show_frontpage): self
    {
        $this->show_frontpage = $show_frontpage;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getId() ? (string)$this->getShowFrontpage() : '-';
    }
}
