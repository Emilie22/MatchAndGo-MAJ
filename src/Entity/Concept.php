<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ConceptRepository")
 */
class Concept
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
     *      message="Votre titre ne doit pas contenir de chiffre et fair plus de 255 charactères"
     * )

     */
    private $titleConcept;

    /**
     * @ORM\Column(type="text")
     */
    private $contentConcept;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pictureConcept;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitleConcept(): ?string
    {
        return $this->titleConcept;
    }

    public function setTitleConcept(string $titleConcept): self
    {
        $this->titleConcept = $titleConcept;

        return $this;
    }

    public function getContentConcept(): ?string
    {
        return $this->contentConcept;
    }

    public function setContentConcept(string $contentConcept): self
    {
        $this->contentConcept = $contentConcept;

        return $this;
    }

    public function getPictureConcept()
    {
        return $this->pictureConcept;
    }

    public function setPictureConcept($pictureConcept)
    {
        $this->pictureConcept = $pictureConcept;

        return $this;
    }
}
