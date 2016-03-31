<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FirmwareConfig
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FirmwareConfigRepository")
 */
class FirmwareConfig
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
     * @var int
     *
     * @ORM\Column(name="Owner", type="integer")
     */
    private $owner;

    /**
     * @var string
     *
     * @ORM\Column(name="HexFileUrl", type="string", length=255)
     */
    private $hexFileUrl;

    /**
     * @var array
     *
     * @ORM\Column(name="BoardUploadConfig", type="json_array")
     */
    private $boardUploadConfig;

    /**
     * @var array
     *
     * @ORM\Column(name="IPProgrammer", type="json_array", nullable=true)
     */
    private $iPProgrammer;

    /**
     * @var bool
     *
     * @ORM\Column(name="SerialPortAutoDetection", type="boolean")
     */
    private $serialPortAutoDetection;

    /**
     * @var string
     *
     * @ORM\Column(name="ButtonName", type="string", length=255)
     */
    private $buttonName;

    /**
     * @var int
     *
     * @ORM\Column(name="IFrameWidth", type="integer")
     */
    private $iFrameWidth;

    /**
     * @var int
     *
     * @ORM\Column(name="IFrameHeight", type="integer")
     */
    private $iFrameHeight;

    /**
     * @var string
     *
     * @ORM\Column(name="IFrameBackground", type="string", length=255)
     */
    private $iFrameBackground;

    /**
     * @var string
     *
     * @ORM\Column(name="UniqueUrl", type="string", length=255)
     */
    private $uniqueUrl;


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
     * Set owner
     *
     * @param integer $owner
     *
     * @return FirmwareConfig
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner
     *
     * @return int
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set hexFileUrl
     *
     * @param string $hexFileUrl
     *
     * @return FirmwareConfig
     */
    public function setHexFileUrl($hexFileUrl)
    {
        $this->hexFileUrl = $hexFileUrl;

        return $this;
    }

    /**
     * Get hexFileUrl
     *
     * @return string
     */
    public function getHexFileUrl()
    {
        return $this->hexFileUrl;
    }

    /**
     * Set boardUploadConfig
     *
     * @param array $boardUploadConfig
     *
     * @return FirmwareConfig
     */
    public function setBoardUploadConfig($boardUploadConfig)
    {
        $this->boardUploadConfig = $boardUploadConfig;

        return $this;
    }

    /**
     * Get boardUploadConfig
     *
     * @return array
     */
    public function getBoardUploadConfig()
    {
        return $this->boardUploadConfig;
    }

    /**
     * Set iPProgrammer
     *
     * @param array $iPProgrammer
     *
     * @return FirmwareConfig
     */
    public function setIPProgrammer($iPProgrammer)
    {
        $this->iPProgrammer = $iPProgrammer;

        return $this;
    }

    /**
     * Get iPProgrammer
     *
     * @return array
     */
    public function getIPProgrammer()
    {
        return $this->iPProgrammer;
    }

    /**
     * Set serialPortAutoDetection
     *
     * @param boolean $serialPortAutoDetection
     *
     * @return FirmwareConfig
     */
    public function setSerialPortAutoDetection($serialPortAutoDetection)
    {
        $this->serialPortAutoDetection = $serialPortAutoDetection;

        return $this;
    }

    /**
     * Get serialPortAutoDetection
     *
     * @return bool
     */
    public function getSerialPortAutoDetection()
    {
        return $this->serialPortAutoDetection;
    }

    /**
     * Set buttonName
     *
     * @param string $buttonName
     *
     * @return FirmwareConfig
     */
    public function setButtonName($buttonName)
    {
        $this->buttonName = $buttonName;

        return $this;
    }

    /**
     * Get buttonName
     *
     * @return string
     */
    public function getButtonName()
    {
        return $this->buttonName;
    }

    /**
     * Set iFrameWidth
     *
     * @param integer $iFrameWidth
     *
     * @return FirmwareConfig
     */
    public function setIFrameWidth($iFrameWidth)
    {
        $this->iFrameWidth = $iFrameWidth;

        return $this;
    }

    /**
     * Get iFrameWidth
     *
     * @return int
     */
    public function getIFrameWidth()
    {
        return $this->iFrameWidth;
    }

    /**
     * Set iFrameHeight
     *
     * @param integer $iFrameHeight
     *
     * @return FirmwareConfig
     */
    public function setIFrameHeight($iFrameHeight)
    {
        $this->iFrameHeight = $iFrameHeight;

        return $this;
    }

    /**
     * Get iFrameHeight
     *
     * @return int
     */
    public function getIFrameHeight()
    {
        return $this->iFrameHeight;
    }

    /**
     * Set iFrameBackground
     *
     * @param string $iFrameBackground
     *
     * @return FirmwareConfig
     */
    public function setIFrameBackground($iFrameBackground)
    {
        $this->iFrameBackground = $iFrameBackground;

        return $this;
    }

    /**
     * Get iFrameBackground
     *
     * @return string
     */
    public function getIFrameBackground()
    {
        return $this->iFrameBackground;
    }

    /**
     * Set uniqueUrl
     *
     * @param string $uniqueUrl
     *
     * @return FirmwareConfig
     */
    public function setUniqueUrl($uniqueUrl)
    {
        $this->uniqueUrl = $uniqueUrl;

        return $this;
    }

    /**
     * Get uniqueUrl
     *
     * @return string
     */
    public function getUniqueUrl()
    {
        return $this->uniqueUrl;
    }
}

