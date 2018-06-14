<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 * @Vich\Uploadable
 */
class Post
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     */
    private $subTitle;

    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $text;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", options={"default" = false}))
     */
    private $active = false;

    /**
     * @ORM\Column(type="date")
     *
     * @Assert\NotBlank()
     */
    private $date;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $distance;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ascent;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $descent;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $duration;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="post_gpx", fileNameProperty="gpxFileName")
     *
     * @Assert\File(mimeTypes = {"text/xml"})
     *
     * @var File
     */
    private $gpxFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $gpxFileName;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="post_media", fileNameProperty="headerImageFileName")
     *
     * @Assert\File(mimeTypes = {"image/jpeg", "image/png"})
     *
     * @var File
     */
    private $headerImageFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $headerImageFileName;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $headerImageStyle;


    /**
     * @var Tour
     *
     * @ORM\ManyToOne(targetEntity="Tour", inversedBy="posts")
     */
    private $tour;

    /**
     * @var Image[]
     *
     * @ORM\OneToMany(targetEntity="Image", mappedBy="post", cascade={"all"})
     */
    private $images;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * Post constructor.
     */
    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getTitle();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Post
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSubTitle()
    {
        return $this->subTitle;
    }

    /**
     * @param mixed $subTitle
     */
    public function setSubTitle($subTitle)
    {
        $this->subTitle = $subTitle;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return null|string
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * @param null|string $text
     * @return Post
     */
    public function setText(?string $text): self
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active)
    {
        $this->active = $active;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|UploadedFile $gpxFile
     */
    public function setGpxFile(?File $gpxFile = null)
    {
        $this->gpxFile = $gpxFile;

        if (null !== $gpxFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    /**
     * @return null|File
     */
    public function getGpxFile(): ?File
    {
        return $this->gpxFile;
    }

    /**
     * @return string
     */
    public function getGpxFileName(): ?string
    {
        return $this->gpxFileName;
    }

    /**
     * @param string $gpxFileName
     */
    public function setGpxFileName(?string $gpxFileName)
    {
        $this->gpxFileName = $gpxFileName;
    }

    /**
     * @return File
     */
    public function getHeaderImageFile(): ?File
    {

        return $this->headerImageFile;
    }

    /**
     * @param File $headerImageFile
     */
    public function setHeaderImageFile(?File $headerImageFile)
    {
        $this->headerImageFile = $headerImageFile;

        if (null !== $headerImageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    /**
     * @return string
     */
    public function getHeaderImageFileName(): ?string
    {
        return $this->headerImageFileName;
    }

    /**
     * @param string $headerImageFileName
     */
    public function setHeaderImageFileName(?string $headerImageFileName)
    {
        $this->headerImageFileName = $headerImageFileName;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return mixed
     */
    public function getHeaderImageStyle()
    {
        return $this->headerImageStyle;
    }

    /**
     * @param mixed $headerImageStyle
     */
    public function setHeaderImageStyle($headerImageStyle)
    {
        $this->headerImageStyle = $headerImageStyle;
    }

    /**
     * @return mixed
     */
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * @param mixed $distance
     */
    public function setDistance($distance)
    {
        $this->distance = $distance;
    }

    /**
     * @return mixed
     */
    public function getAscent()
    {
        return $this->ascent;
    }

    /**
     * @param mixed $ascent
     */
    public function setAscent($ascent)
    {
        $this->ascent = $ascent;
    }

    /**
     * @return mixed
     */
    public function getDescent()
    {
        return $this->descent;
    }

    /**
     * @param mixed $descent
     */
    public function setDescent($descent)
    {
        $this->descent = $descent;
    }

    /**
     * @return mixed
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param mixed $duration
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    /**
     * @return Tour
     */
    public function getTour(): ?Tour
    {
        return $this->tour;
    }

    /**
     * @param Tour $tour
     */
    public function setTour(Tour $tour)
    {
        $this->tour = $tour;
    }

    /**
     * @return mixed
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param mixed $images
     */
    public function setImages($images)
    {
        $this->images = $images;
    }
}
