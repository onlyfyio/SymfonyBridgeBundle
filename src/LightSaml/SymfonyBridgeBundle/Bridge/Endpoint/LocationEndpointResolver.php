<?php

namespace LightSaml\SymfonyBridgeBundle\Bridge\Endpoint;

use LightSaml\Criteria\CriteriaSet;
use LightSaml\Model\Metadata\EndpointReference;
use LightSaml\Resolver\Endpoint\Criteria\LocationCriteria;
use LightSaml\Resolver\Endpoint\EndpointResolverInterface;

final class LocationEndpointResolver implements EndpointResolverInterface
{
    /** @param EndpointReference[] $candidates */
    public function resolve(CriteriaSet $criteriaSet, array $candidates): array
    {
        if (!$criteriaSet->has(LocationCriteria::class)) {
            return $candidates;
        }

        $result = [];
        foreach ($criteriaSet->get(LocationCriteria::class) as $criteria) {
            foreach ($candidates as $candidate) {
                if ($candidate->getEndpoint()->getLocation() == $criteria->getLocation()) {
                    $result[] = $candidate;
                }
            }
        }

        return $result;
    }
}
