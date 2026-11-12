<?php

namespace LightSaml\SymfonyBridgeBundle\Store;

use LightSaml\State\Request\RequestState;
use LightSaml\Store\Request\AbstractRequestStateArrayStore;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

final class SymfonySessionRequestStateStore extends AbstractRequestStateArrayStore
{
    public function __construct(
        private readonly SessionInterface $session,
        private readonly string $providerId,
        private readonly string $prefix = 'saml_request_state_',
    ) {
    }

    /** @return array<string, RequestState> */
    protected function getArray(): array
    {
        return $this->session->get($this->getKey(), []);
    }

    /** @param array<string, RequestState> $arr */
    protected function setArray(array $arr): void
    {
        $this->session->set($this->getKey(), $arr);
    }

    private function getKey(): string
    {
        return sprintf('%s_%s', $this->providerId, $this->prefix);
    }
}
