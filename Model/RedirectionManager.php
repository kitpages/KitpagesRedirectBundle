<?php

namespace Kitpages\RedirectBundle\Model;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Symfony\Component\HttpKernel\Log\LoggerInterface;
use Doctrine\Bundle\DoctrineBundle\Registry;

use Kitpages\RedirectBundle\Entity\Redirection;

class RedirectionManager {
    protected $logger = null;
    protected $doctrine = null;
    
    public function __construct(
        Registry $doctrine,
        LoggerInterface $logger
    )
    {
        $this->logger = $logger;
        $this->doctrine = $doctrine;
    }
    /**
     * @return Registry
     */
    public function getDoctrine()
    {
        return $this->doctrine;
    }
    /**
     * @return LoggerInterface
     */
    public function getLogger()
    {
        return $this->logger;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        if (HttpKernelInterface::MASTER_REQUEST !== $event->getRequestType()) {
            return;
        }
        $request = $event->getRequest();
        $baseUrl = rtrim($request->getBaseUrl(), '/');
        $requestUri = $request->getRequestUri();
        $relativeRequestUri = str_replace($baseUrl, '', $requestUri);
        $relativeRequestUri = ltrim($relativeRequestUri, '/');
        
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery("
            SELECT r
            FROM KitpagesRedirectBundle:Redirection r
            WHERE r.sourceUrl = :sourceUrl
        ")->setParameter("sourceUrl", $relativeRequestUri);
        $redirectionList = $query->getResult();
        if (count($redirectionList) != 1) {
            return;
        }
        $redirection = $redirectionList[0];
        $destinationUrl = $baseUrl.'/'.$redirection->getDestinationUrl();
        $this->getLogger()->info("redirection by redirectBundle relativeRequestUri=$relativeRequestUri, destinationUrl=$destinationUrl");
        if ($redirection->getHttpCode()) {
            $response = new RedirectResponse($destinationUrl, $redirection->getHttpCode());
        }
        else {
            $response = new RedirectResponse($destinationUrl, "301");
        }
        $event->setResponse($response);
    }
}

?>
