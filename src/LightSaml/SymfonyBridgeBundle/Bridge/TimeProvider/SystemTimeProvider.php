<?php

namespace LightSaml\SymfonyBridgeBundle\Bridge\TimeProvider;

use DateTime;
use LightSaml\Provider\TimeProvider\TimeProviderInterface;

final class SystemTimeProvider implements TimeProviderInterface
{
    public function getTimestamp(): int
    {
        return time();
    }

    public function getDateTime(): DateTime
    {
        return new DateTime();
    }
}
