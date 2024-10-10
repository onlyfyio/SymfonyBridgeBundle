<?php

namespace LightSaml\SymfonyBridgeBundle\Factory;

use LightSaml\Store\Sso\SsoStateSessionStore;
use Symfony\Component\HttpFoundation\RequestStack;

class SsoStateSessionStoreFactory
{
    public function __construct(
        private readonly RequestStack $requestStack,
        private readonly string $ssoStateSessionKey,
    ) {
    }

    public function create(): SsoStateSessionStore
    {
        return new SsoStateSessionStore(
            $this->requestStack->getCurrentRequest()->getSession(),
            $this->ssoStateSessionKey,
        );
    }
}
