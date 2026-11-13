<?php

namespace LightSaml\SymfonyBridgeBundle\Bridge\Endpoint;

use LightSaml\Criteria\CriteriaSet;
use LightSaml\Model\Metadata\EndpointReference;
use LightSaml\Resolver\Endpoint\Criteria\DescriptorTypeCriteria;
use LightSaml\Resolver\Endpoint\EndpointResolverInterface;

final class DescriptorTypeEndpointResolver implements EndpointResolverInterface
{
    /** @param EndpointReference[] $candidates */
    public function resolve(CriteriaSet $criteriaSet, array $candidates): array
    {
        if (!$criteriaSet->has(DescriptorTypeCriteria::class)) {
            return $candidates;
        }

        $result = [];
        foreach ($criteriaSet->get(DescriptorTypeCriteria::class) as $criteria) {
            foreach ($candidates as $candidate) {
                $type = $criteria->getDescriptorType();
                if ($candidate->getDescriptor() instanceof $type) {
                    $result[] = $candidate;
                }
            }
        }

        return $result;
    }
}
