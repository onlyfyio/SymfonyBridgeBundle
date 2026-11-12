<?php

namespace LightSaml\SymfonyBridgeBundle\Factory;

use LightSaml\Store\Request\RequestStateStoreInterface;
use LightSaml\SymfonyBridgeBundle\Store\SymfonySessionRequestStateStore;
use Symfony\Component\HttpFoundation\RequestStack;

class RequestStateSessionStoreFactory
{
    public function __construct(
        private readonly RequestStack $requestStack,
        private readonly string $sessionPrefix,
        private readonly string $sessionSuffix,
    )
    {
    }

    public function create(): RequestStateStoreInterface
    {
        return new SymfonySessionRequestStateStore(
            $this->requestStack->getCurrentRequest()->getSession(),
            $this->sessionPrefix,
            $this->sessionSuffix,
        );
    }
}
