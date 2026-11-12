<?php

namespace LightSaml\SymfonyBridgeBundle\Store;

use LightSaml\State\Sso\SsoState;
use LightSaml\Store\Sso\SsoStateStoreInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

final class SymfonySessionSsoStateStore implements SsoStateStoreInterface
{
    public function __construct(
        private readonly SessionInterface $session,
        private readonly string $key,
    ) {
    }

    public function get(): SsoState
    {
        $state = $this->session->get($this->key);
        if (!$state instanceof SsoState) {
            $state = new SsoState();
            $this->set($state);
        }

        return $state;
    }

    public function set(SsoState $ssoState): void
    {
        $ssoState->setLocalSessionId($this->session->getId());
        $this->session->set($this->key, $ssoState);
    }
}
