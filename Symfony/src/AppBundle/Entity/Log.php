<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Logs
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LogRepository")
 *
 * @SuppressWarnings(PHPMD.ShortVariable)
 */
class Log
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
     * @ORM\Column(name="owner", type="integer")
     * @ORM\ManyToOne(targetEntity="User", inversedBy="logs")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $owner;

    /**
     * @var int
     *
     * @ORM\Column(name="logType", type="integer")
     */
    private $logType;

    /**
     * @var string
     *
     * @ORM\Column(name="readableLogType", type="string", length=255)
     */
    private $readableLogType;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timestamp", type="integer")
     */
    private $timestamp;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=255)
     */
    private $ip;

    /**
     * @var string
     *
     * @ORM\Column(name="session", type="string", length=255)
     */
    private $session;

    /**
     * @var bool
     *
     * @ORM\Column(name="hasPreviousSession", type="boolean")
     */
    private $hasPreviousSession;

    /**
     * @var string
     *
     * @ORM\Column(name="browser", type="string", length=255, nullable=true)
     */
    private $browser;

    /**
     * @var array
     *
     * @ORM\Column(name="metadata", type="json_array")
     */
    private $metadata;


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
     * @return Log
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
     * Set logType
     *
     * @param integer $logType
     *
     * @return Log
     */
    public function setLogType($logType)
    {
        $this->logType = $logType;

        return $this;
    }

    /**
     * Get logType
     *
     * @return int
     */
    public function getLogType()
    {
        return $this->logType;
    }

    /**
     * Set readableLogType
     *
     * @param string $readableLogType
     *
     * @return Log
     */
    public function setReadableLogType($readableLogType)
    {
        $this->readableLogType = $readableLogType;

        return $this;
    }

    /**
     * Get readableLogType
     *
     * @return string
     */
    public function getReadableLogType()
    {
        return $this->readableLogType;
    }

    /**
     * Set timestamp
     *
     * @param int $timestamp
     *
     * @return Log
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Get timestamp
     *
     * @return int
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Set ip
     *
     * @param string $ip
     *
     * @return Log
     */
    public function setIp($ip)
    {
        $this->ip = inet_pton($ip);

        return $this;
    }

    /**
     * Get ip
     *
     * @return string
     */
    public function getIp()
    {
        return inet_ntop($this->ip);
    }

    /**
     * Set session
     *
     * @param string $session
     *
     * @return Log
     */
    public function setSession($session)
    {
        $this->session = $session;

        return $this;
    }

    /**
     * Get session
     *
     * @return string
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * Set hasPreviousSession
     *
     * @param boolean $hasPreviousSession
     *
     * @return Log
     */
    public function setHasPreviousSession($hasPreviousSession)
    {
        $this->hasPreviousSession = $hasPreviousSession;

        return $this;
    }

    /**
     * Get hasPreviousSession
     *
     * @return bool
     */
    public function hasPreviousSession()
    {
        return $this->hasPreviousSession;
    }

    /**
     * Set browser
     *
     * @param string $browser
     *
     * @return Log
     */
    public function setBrowser($browser)
    {
        $this->browser = $browser;

        return $this;
    }

    /**
     * Get browser
     *
     * @return string
     */
    public function getBrowser()
    {
        return $this->browser;
    }

    /**
     * Set metadata
     *
     * @param array $metadata
     *
     * @return Log
     */
    public function setMetadata($metadata)
    {
        $this->metadata = $metadata;

        return $this;
    }

    /**
     * Get metadata
     *
     * @return array
     */
    public function getMetadata()
    {
        return $this->metadata;
    }
}

