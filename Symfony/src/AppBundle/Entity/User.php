<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * User
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @UniqueEntity(fields="email", message="Email is already in use")
 * @UniqueEntity(fields="username", message="Username is already in use")
 * @SuppressWarnings(PHPMD.ShortVariable)
 */
class User implements UserInterface, \Serializable
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255, unique=true)
     *
     * @Assert\Length(
     *      min = 6,
     *      minMessage = "Your username must be at least {{ limit }} characters long"
     * )
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     *
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email."
     * )
     */
    private $email;

    /**
     * @var string
     *
     * @Assert\Length(
     *      min = 6,
     *      minMessage = "Your password must be at least {{ limit }} characters long"
     * )
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var int
     *
     * @ORM\Column(name="tier", type="integer")
     * @ORM\ManyToOne(targetEntity="Tier", inversedBy="users")
     * @ORM\JoinColumn(name="tier_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $tier;

    /**
     * @var int
     *
     * @ORM\Column(name="totalFlashCount", type="integer", options={"default" = 0})
     */
    private $totalFlashCount;

    /**
     * @var int
     *
     * @ORM\Column(name="successfulFlashCount", type="integer", options={"default" = 0})
     */
    private $successfulFlashCount;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return hashed password string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set tier
     *
     * @param integer $tier
     *
     * @return User
     */
    public function setTier($tier)
    {
        $this->tier = $tier;

        return $this;
    }

    /**
     * Get tier
     *
     * @return int
     */
    public function getTier()
    {
        return $this->tier;
    }

    /**
     * Set totalFlashCount
     *
     * @param integer $totalFlashCount
     *
     * @return User
     */
    public function setTotalFlashCount($totalFlashCount)
    {
        $this->totalFlashCount = $totalFlashCount;

        return $this;
    }

    /**
     * Get totalFlashCount
     *
     * @return int
     */
    public function getTotalFlashCount()
    {
        return $this->totalFlashCount;
    }

    /**
     * Set successfulFlashCount
     *
     * @param integer $successfulFlashCount
     *
     * @return User
     */
    public function setSuccessfulFlashCount($successfulFlashCount)
    {
        $this->successfulFlashCount = $successfulFlashCount;

        return $this;
    }

    /**
     * Get successfulFlashCount
     *
     * @return int
     */
    public function getSuccessfulFlashCount()
    {
        return $this->successfulFlashCount;
    }

    public function getSalt()
    {
        return null;
    }

    public function getRoles()
    {
        return array('ROLE_USER');
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            $this->email,
            $this->tier,
            $this->totalFlashCount,
            $this->successfulFlashCount,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            $this->email,
            $this->tier,
            $this->totalFlashCount,
            $this->successfulFlashCount,
            ) = unserialize($serialized);
    }

    /**
     * @ORM\OneToMany(targetEntity="Log", mappedBy="user")
     */
    protected $logs;

    /**
     * @ORM\OneToMany(targetEntity="FirmwareConfig", mappedBy="user")
     */
    protected $firmwareConfigs;

    public function __construct()
    {
        $this->logs = new ArrayCollection();
        $this->firmwareConfigs = new ArrayCollection();
    }
}
