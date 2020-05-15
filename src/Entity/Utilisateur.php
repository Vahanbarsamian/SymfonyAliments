<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UtilisateurRepository")
 *
 * @UniqueEntity(
 *  fields = {"username"},
 *   message = "Ce login a déjà été choisi merci d'en choisir un autre "
 * )
 */
class Utilisateur implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\Length(
     *  min=5,
     *  max=10,
     *  minMessage="Le mot passe doit au moins contenir {{ limit }} caractères",
     *  maxMessage="Le mot de passe ne peut contenir plus de {{ limit }} caractères"
     * )
     *
     *
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @Assert\Length(
     *  min=5,
     *  max=8,
     *  minMessage="Le mot passe doit au moins contenir {{ limit }} caractères",
     *  maxMessage="Le mot de passe ne peut contenir plus de {{ limit }} caractères"
     * )
     *
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * Undocumented variable
     *
     * @Assert\EqualTo(propertyPath="password", message="Le mot de passe de vérification n'est pas identique au mot de passe, veuillez corriger merci !")
     *
     * @var string
     */
    private $verificationPassword;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $roles;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Return the verif_password
     *
     * @return string
     */
    public function getVerificationPassword()
    {
        return $this->verificationPassword;
    }

    /**
     * Set the verif_password
     *
     * @param string $verificationPassword
     *
     * @return self
     */
    public function setVerificationPassword(string $verificationPassword)
    {
        $this->verificationPassword = $verificationPassword;

        return $this;
    }

    /**
     * @return string[] The user roles
     */
    public function getRoles()
    {
        return [$this->roles];
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {

    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {

    }

    public function setRoles(?string $roles): self
    {
        if ($roles == null) {
            $this->roles = "ROLE_USER";
            return $this;
        }
        $this->roles = $roles;
    }
}
