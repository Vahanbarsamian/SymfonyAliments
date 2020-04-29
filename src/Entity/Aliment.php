<?php
/**
 * Vahan 23/04/2020
 * Create new table Aliment
 */
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Aliment repository location
 * 
 * @ORM\Entity(repositoryClass="App\Repository\AlimentRepository")
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
     * Name of an aliment
     *
     * @var string
     * $nom
     * 
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * Price of aliment
     *
     * @var float
     * $prix
     *
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * Path of the aliment getImage
     * 
     * @var string
     * $image
     * 
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * This value represents colories of an aliment
     * 
     * @var float 
     * $calorie
     * 
     * @ORM\Column(type="float")
     */
    private $calorie;

    /**
     * This value represents proteins of an aliment
     * 
     * @var float
     * $proteine
     * 
     * @ORM\Column(type="float")
     */
    private $proteine;

    /**
     * This value represents glucids of an aliment
     * 
     * @var float
     * $glucide
     * 
     * @ORM\Column(type="float")
     */
    private $glucide;

    /**
     * This value represents lipids of an aliment
     * 
     * @var float 
     * $lipide
     * 
     * @ORM\Column(type="float")
     */
    private $lipide;

    public function getId(): ?int
    {
        return $this->id;
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
}
