<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tier
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TierRepository")
 *
 * @SuppressWarnings(PHPMD)
 */
class Tier
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
     * @ORM\Column(name="tierName", type="string", length=255, unique=true)
     */
    private $tierName;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2)
     */
    private $price;

    /**
     * @var int
     *
     * @ORM\Column(name="successfulFlashCount", type="integer")
     */
    private $successfulFlashCount;

    /**
     * @var string
     *
     * @ORM\Column(name="tierImage", type="string", length=255)
     */
    private $tierImage;


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
     * Set tierName
     *
     * @param string $tierName
     *
     * @return Tier
     */
    public function setTierName($tierName)
    {
        $this->tierName = $tierName;

        return $this;
    }

    /**
     * Get tierName
     *
     * @return string
     */
    public function getTierName()
    {
        return $this->tierName;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Tier
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return Tier
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set successfulFlashCount
     *
     * @param integer $successfulFlashCount
     *
     * @return Tier
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

    /**
     * Set tierImage
     *
     * @param string $tierImage
     *
     * @return Tier
     */
    public function setTierImage($tierImage)
    {
        $this->tierImage = $tierImage;

        return $this;
    }

    /**
     * Get tierImage
     *
     * @return string
     */
    public function getTierImage()
    {
        return $this->tierImage;
    }
}
