<?php

namespace LightSaml\SymfonyBridgeBundle\Bridge\Endpoint;

use LightSaml\Criteria\CriteriaSet;
use LightSaml\Model\Metadata\EndpointReference;
use LightSaml\Resolver\Endpoint\EndpointResolverInterface;

final class CompositeEndpointResolver implements EndpointResolverInterface
{
    /** @var EndpointResolverInterface[] */
    private array $resolvers = [];

    public function add(EndpointResolverInterface $resolver): self
    {
        $this->resolvers[] = $resolver;

        return $this;
    }

    /** @param EndpointReference[] $candidates */
    public function resolve(CriteriaSet $criteriaSet, array $candidates): array
    {
        foreach ($this->resolvers as $resolver) {
            $candidates = $resolver->resolve($criteriaSet, $candidates);
        }

        return $candidates;
    }
}
