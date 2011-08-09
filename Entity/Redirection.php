<?php

namespace Kitpages\RedirectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Kitpages\RedirectBundle\Entity\Redirection
 */
class Redirection
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $sourceUrl
     */
    private $sourceUrl;

    /**
     * @var string $destinationUrl
     */
    private $destinationUrl;

    /**
     * @var string $httpCode
     */
    private $httpCode;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set sourceUrl
     *
     * @param string $sourceUrl
     */
    public function setSourceUrl($sourceUrl)
    {
        $this->sourceUrl = $sourceUrl;
    }

    /**
     * Get sourceUrl
     *
     * @return string 
     */
    public function getSourceUrl()
    {
        return $this->sourceUrl;
    }

    /**
     * Set destinationUrl
     *
     * @param string $destinationUrl
     */
    public function setDestinationUrl($destinationUrl)
    {
        $this->destinationUrl = $destinationUrl;
    }

    /**
     * Get destinationUrl
     *
     * @return string 
     */
    public function getDestinationUrl()
    {
        return $this->destinationUrl;
    }

    /**
     * Set httpCode
     *
     * @param string $httpCode
     */
    public function setHttpCode($httpCode)
    {
        $this->httpCode = $httpCode;
    }

    /**
     * Get httpCode
     *
     * @return string 
     */
    public function getHttpCode()
    {
        return $this->httpCode;
    }
}