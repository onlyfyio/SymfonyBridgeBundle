<?php

namespace LightSaml\SymfonyBridgeBundle\Factory;

use LightSaml\Store\Sso\SsoStateStoreInterface;
use LightSaml\SymfonyBridgeBundle\Store\SymfonySessionSsoStateStore;
use Symfony\Component\HttpFoundation\RequestStack;

class SsoStateSessionStoreFactory
{
    public function __construct(
        private readonly RequestStack $requestStack,
        private readonly string $ssoStateSessionKey,
    ) {
    }

    public function create(): SsoStateStoreInterface
    {
        return new SymfonySessionSsoStateStore(
            $this->requestStack->getCurrentRequest()->getSession(),
            $this->ssoStateSessionKey,
        );
    }
}
