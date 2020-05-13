<?php
/**
 * Vahan 23/04/2020
 * Create new table Aliment
 */
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Aliment repository location
 *
 * @ORM\Entity(repositoryClass="App\Repository\AlimentRepository")
 *
 * @Vich\Uploadable
 */
class Aliment
{
    /**
     * This is the id of an aliment
     *
     * @var integer
     * $id
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @var File|null
     *
     * @Vich\UploadableField(
     *  mapping="aliment_images",
     *  fileNameProperty="image",
     *  size="imageSize"
     * )
     */
    private $imageFile;

    /**
     * @ORM\Column(type="integer")
     *
     * @var int|null
     *
     * @Assert\PositiveOrZero(
     *  message="This value must to be higher or equal to 0"
     * )
     */
    private $imageSize = 0;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime|null
     */
    private $updatedAt;

    /**
     * Name of an aliment
     *
     * @var string
     * $nom
     *
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\Length(
     *      min = 3,
     *      max = 15,
     *      minMessage = "The name must be at least {{ limit }} characters long",
     *      maxMessage = "The name cannot be longer than {{ limit }} characters long"
     * )
     */
    private $nom;

    /**
     * Price of aliment
     *
     * @var float
     * $prix
     *
     * @ORM\Column(type="float")
     *
     * @Assert\NotBlank
     */
    private $prix;

    /**
     * Path of the aliment getImage
     *
     * @var string
     * $image
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Assert\Length(
     *      min = 10,
     *      max = 40,
     *      minMessage = "The URL at least contains {{limit}} characters long",
     *      maxMessage = "The URL can't exceed {{limit}} characters"
     * )
     */
    private $image;

    /**
     * This value represents colories of an aliment
     *
     * @var float
     * $calorie
     *
     * @ORM\Column(type="float")
     *
     * @Assert\Range(
     *      min = 0.1,
     *      max = 50,
     *      minMessage = "This value must to be higher than {{limit}}",
     *      maxMessage = "This value must be less than {{Limit}}"
     * )
     */
    private $calorie;

    /**
     * This value represents proteins of an aliment
     *
     * @var float
     * $proteine
     *
     * @ORM\Column(type="float")
     *
     * @Assert\Range(
     *      min = 0.1,
     *      max = 50,
     *      minMessage = "This value must to be higher than {{limit}}",
     *      maxMessage = "This value must be less than {{Limit}}"
     * )
     */
    private $proteine;

    /**
     * This value represents glucids of an aliment
     *
     * @var float
     * $glucide
     *
     * @ORM\Column(type="float")
     *
     * @Assert\Range(
     *      min = 0.1,
     *      max = 50,
     *      minMessage = "This value must to be higher than {{limit}}",
     *      maxMessage = "This value must be less than {{Limit}}"
     * )
     */
    private $glucide;

    /**
     * This value represents lipids of an aliment
     *
     * @var float
     * $lipide
     *
     * @ORM\Column(type="float")
     *
     * @Assert\Range(
     *      min = 0.1,
     *      max = 50,
     *      minMessage = "This value must to be higher than {{limit}}",
     *      maxMessage = "This value must be less than {{Limit}}"
     * )
     */
    private $lipide;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $contract;

    /**
     * @Vich\UploadableField(mapping="user_contracts", fileNameProperty="contract")
     *
     * @var File
     */
    private $contractFile;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Type", inversedBy="aliments")
     */
    private $type;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File $imageFile
     *
     * @return self
     */
    public function setImageFile(?File $imageFile = null): self
    {
        $this->imageFile = $imageFile;
        if (null !== $imageFile && $this->imageFile instanceof UploadedFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime('now');
        }
        return $this;
    }

    public function getImageSize(): ?int
    {
        return $this->imageSize;
    }

    public function setImageSize(?int $imageSize): void
    {
        $this->imageSize = $imageSize;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getCalorie(): ?float
    {
        return $this->calorie;
    }

    public function setCalorie(float $calorie): self
    {
        $this->calorie = $calorie;

        return $this;
    }

    public function getProteine(): ?float
    {
        return $this->proteine;
    }

    public function setProteine(float $proteine): self
    {
        $this->proteine = $proteine;

        return $this;
    }

    public function getGlucide(): ?float
    {
        return $this->glucide;
    }

    public function setGlucide(float $glucide): self
    {
        $this->glucide = $glucide;

        return $this;
    }

    public function getLipide(): ?float
    {
        return $this->lipide;
    }

    public function setLipide(float $lipide): self
    {
        $this->lipide = $lipide;

        return $this;
    }

    /**
     * Get the value of updatedAt
     *
     * @return \DateTimeInterface|null
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set the value of updatedAt
     *
     * @param  \DateTimeInterface|null  $updatedAt
     */
    public function setUpdatedAt()
    {
        $this->updatedAt = new \Datetime('now');
    }

    /**
     * Get the value of contract
     *
     * @return string
     */
    public function getContract()
    {
        return $this->contract;
    }

    /**
     * Set the value of contract
     *
     * @param string  $contract
     *
     * @return self
     */
    public function setContract(string $contract)
    {
        $this->contract = $contract;

        return $this;
    }

    /**
     * Get the value of contractFile
     *
     * @return File
     */
    public function getContractFile()
    {
        return $this->contractFile;
    }

    /**
     * Set the value of contractFile
     *
     * @param File  $contractFile
     *
     * @return self
     */
    public function setContractFile(File $contractFile)
    {
        $this->contractFile = $contractFile;

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): self
    {
        $this->type = $type;

        return $this;
    }
}
