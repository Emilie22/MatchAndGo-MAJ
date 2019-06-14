<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BlogRepository")
 */
class Blog
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Regex(
     *      pattern="/[a-zA-Z]{1-255}/",
     *      match=false,
     *      message="Votre titre ne doit pas contenir de chiffre ni faire plus de 255 caractères."
     * )
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Assert\Regex(
     *      pattern="/[a-zA-Z]{1-255}/",
     *      match=false,
     *      message="Votre titre ne doit pas contenir de chiffre ni faire plus de 255 caractères."
     * )
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\DateTime
     * @var string A "Y-m-d H:i:s" formatted value
     */
    private $datePost;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pictureBlog;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Le nom de l'auteur ne doit pas contenir de chiffres."
     * )
     */
    private $author;

    /**
    * @Gedmo\Slug(fields={"title"})
    * @ORM\Column(length=128, unique=true)
    */
    private $slug;

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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getDatePost(): ?\DateTimeInterface
    {
        return $this->datePost;
    }

    public function setDatePost(\DateTimeInterface $datePost): self
    {
        $this->datePost = $datePost;

        return $this;
    }

    public function getPictureBlog()
    {
        return $this->pictureBlog;
    }

    public function setPictureBlog($pictureBlog): self
    {
        $this->pictureBlog = $pictureBlog;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
}
