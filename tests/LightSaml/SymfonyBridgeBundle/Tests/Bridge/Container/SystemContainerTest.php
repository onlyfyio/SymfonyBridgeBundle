<?php

namespace LightSaml\SymfonyBridgeBundle\Tests\Bridge\Container;

use LightSaml\Provider\TimeProvider\TimeProviderInterface;
use LightSaml\SymfonyBridgeBundle\Bridge\Container\SystemContainer;
use PHPUnit\Framework\TestCase;
use Psr\EventDispatcher\EventDispatcherInterface as PsrEventDispatcherInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;
use Symfony\Component\HttpFoundation\RequestStack;

class SystemContainerTest extends TestCase
{
    public function test_constructs_with_all_arguments()
    {
        new SystemContainer(
            $this->getMockBuilder(RequestStack::class)->getMock(),
            $this->getMockBuilder(PsrHttpFactory::class)->disableOriginalConstructor()->getMock(),
            $this->getMockBuilder(ResponseFactoryInterface::class)->getMock(),
            $this->getMockBuilder(StreamFactoryInterface::class)->getMock(),
            $this->getMockBuilder(TimeProviderInterface::class)->getMock(),
            $this->getMockBuilder(PsrEventDispatcherInterface::class)->getMock(),
            $this->getMockBuilder(LoggerInterface::class)->getMock()
        );
    }
}
