<?php

namespace LightSaml\SymfonyBridgeBundle\Bridge\Endpoint;

use LightSaml\Criteria\CriteriaSet;
use LightSaml\Model\Metadata\EndpointReference;
use LightSaml\Resolver\Endpoint\Criteria\ServiceTypeCriteria;
use LightSaml\Resolver\Endpoint\EndpointResolverInterface;

final class ServiceTypeEndpointResolver implements EndpointResolverInterface
{
    /** @param EndpointReference[] $candidates */
    public function resolve(CriteriaSet $criteriaSet, array $candidates): array
    {
        if (!$criteriaSet->has(ServiceTypeCriteria::class)) {
            return $candidates;
        }

        $result = [];
        foreach ($criteriaSet->get(ServiceTypeCriteria::class) as $criteria) {
            foreach ($candidates as $candidate) {
                $type = $criteria->getServiceType();
                if ($candidate->getEndpoint() instanceof $type) {
                    $result[] = $candidate;
                }
            }
        }

        return $result;
    }
}
