<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields={"email"}, message="Un compte existe déjà avec cet email.")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\Email(
     *      message = "Cet email '{{ value }}' est invalide.",
     *      checkMX = true
     *)
     */
    private $email;
    /**
     * @ORM\Column(type="array")
     */
    private $roles = [];
    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    private $plainPassword;
    /**
     * @ORM\Column(type="string", length=30)
     * @Assert\Regex(
     *      pattern="/\d/",
     *      match=false,
     *      message="Votre prénom ne doit pas contenir de chiffre."
     *)
     */
    private $firstname;
    /**
     * @ORM\Column(type="string", length=30)
     * @Assert\Regex(
     *      pattern="/\d/",
     *      match=false,
     *      message="Votre nom ne doit pas contenir de chiffre."
     *)
     */
    private $lastname;
    /**
     * @ORM\Column(type="string", length=30)
     * @Assert\Regex(
     *      pattern="/\d/",
     *      match=false,
     *      message="Votre ville ne doit pas contenir de chiffre."
     *)
     */
    private $city;
    /**
     * @ORM\Column(type="date")
     */
    private $birthday;
    /**
     * @ORM\Column(type="string", length=10)
     * @Assert\Regex(
     *      pattern="/\d/",
     *      match=false,
     *      message="Votre genre ne doit pas contenir de chiffre."
     *)
     */
    private $gender;
    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Regex(
     *      pattern="/^0[1-68]([-. ]?[0-9]{2}){4}$/",
     *      match=true,
     *      message="Numéro de téléphone invalide." 
     *)
     */
    private $phone;
    /**
     * @ORM\Column(type="string", length=255)
     * 
     */
    private $picture;

    /**
     * @ORM\Column(type="text")
     * @Assert\Regex(
     *      pattern="/\w/",
     *      match=true,
     *      message="Erreur, veuillez contacter un administrateur."
     *)
     */
    private $description;
    /**
     * @ORM\Column(type="text")
     * @Assert\Length(
     *      min = 2,
     *      minMessage = "Veuillez saisir un pays valide."
     *)
     */
    private $countries;
    /**
    * @ORM\ManyToMany(targetEntity="App\Entity\Answer", mappedBy="user")
    */
    private $answers;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Chat", mappedBy="user")
     */
    private $chats;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Url(
     *    message = "Ce lien : '{{ value }}' est invalide"
     *)
     */
    private $facebook;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(
     *    max = 20,
     *    maxMessage = "Compte instagram invalide."
     *)
     */
    private $instagram;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ResetPassword", mappedBy="user")
     */
    private $resetPasswords;

    /**
    * @Gedmo\Slug(fields={"firstname"})
    * @ORM\Column(length=128, unique=true)
    */
    private $slug;

    public function __construct()
    {
        $this->chats = new ArrayCollection();
        $this->resetPasswords = new ArrayCollection();
    }
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getEmail(): ?string
    {
        return $this->email;
    }
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }
    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }
    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;
        return $this;
    }
    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }
    public function getPlainPassword() :string
    {
        return (string) $this->plainPassword;
    }
    public function setPlainPassword(string $plainPassword) :self
    {
        $this->plainPassword = $plainPassword;
        return $this;
    }
    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }
    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }
    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        $this->plainPassword = null;
    }
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }
    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;
        return $this;
    }
    public function getLastname(): ?string
    {
        return $this->lastname;
    }
    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;
        return $this;
    }
    public function getCity(): ?string
    {
        return $this->city;
    }
    public function setCity(string $city): self
    {
        $this->city = $city;
        return $this;
    }
    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }
    public function setBirthday(\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;
        return $this;
    }
    public function getGender(): ?string
    {
        return $this->gender;
    }
    public function setGender(string $gender): self
    {
        $this->gender = $gender;
        return $this;
    }
    public function getPhone(): ?string
    {
        return $this->phone;
    }
    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;
        return $this;
    }
    public function getPicture()
    {
        return $this->picture;
    }
    public function setPicture($picture)
    {
        $this->picture = $picture;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }
    public function getCountries(): ?string
    {
        return $this->countries;
    }
    public function setCountries(string $countries): self
    {
        $this->countries = $countries;
        return $this;
    }
    /**
    * @return Collection|Answer[]
    */
    public function getAnswers(): Collection
   {
       return $this->answers;
   }
   public function addAnswer(Answer $answer): self
   {
       if (!$this->answers->contains($answer)) {
           $this->answers[] = $answer;
           $answer->addUser($this);
       }
       return $this;
   }
   public function removeAnswer(Answer $answer): self
   {
       if ($this->answers->contains($answer)) {
           $this->answers->removeElement($answer);
           $answer->removeUser($this);
       }
       return $this;
   }
   /**
    * @return Collection|Chat[]
    */
   public function getChats(): Collection
   {
       return $this->chats;
   }
   public function addChat(Chat $chat): self
   {
       if (!$this->chats->contains($chat)) {
           $this->chats[] = $chat;
           $chat->setUser($this);
       }
       return $this;
   }
   public function removeChat(Chat $chat): self
   {
       if ($this->chats->contains($chat)) {
           $this->chats->removeElement($chat);
           // set the owning side to null (unless already changed)
           if ($chat->getUser() === $this) {
               $chat->setUser(null);
           }
       }
       return $this;
   }
   public function getFacebook(): ?string
   {
       return $this->facebook;
   }
   public function setFacebook(?string $facebook): self
   {
       $this->facebook = $facebook;
       return $this;
   }
   public function getInstagram(): ?string
   {
       return $this->instagram;
   }
   public function setInstagram(?string $instagram): self
   {
       $this->instagram = $instagram;
       return $this;
   }

   /**
    * @return Collection|ResetPassword[]
    */
   public function getResetPasswords(): Collection
   {
       return $this->resetPasswords;
   }

   public function addResetPassword(ResetPassword $resetPassword): self
   {
       if (!$this->resetPasswords->contains($resetPassword)) {
           $this->resetPasswords[] = $resetPassword;
           $resetPassword->setUser($this);
       }

       return $this;
   }

   public function removeResetPassword(ResetPassword $resetPassword): self
   {
       if ($this->resetPasswords->contains($resetPassword)) {
           $this->resetPasswords->removeElement($resetPassword);
           // set the owning side to null (unless already changed)
           if ($resetPassword->getUser() === $this) {
               $resetPassword->setUser(null);
           }
       }

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


