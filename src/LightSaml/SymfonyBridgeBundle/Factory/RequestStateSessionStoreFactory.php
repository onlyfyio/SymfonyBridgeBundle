<?php

namespace LightSaml\SymfonyBridgeBundle\Factory;

use LightSaml\Store\Request\RequestStateSessionStore;
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

    public function create(): RequestStateSessionStore
    {
        return new RequestStateSessionStore(
            $this->requestStack->getCurrentRequest()->getSession(),
            $this->sessionPrefix,
            $this->sessionSuffix,
        );
    }
}