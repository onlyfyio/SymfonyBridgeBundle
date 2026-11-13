<?php

namespace LightSaml\SymfonyBridgeBundle\Bridge\Endpoint;

use LightSaml\Criteria\CriteriaSet;
use LightSaml\Model\Metadata\EndpointReference;
use LightSaml\Model\Metadata\IndexedEndpoint;
use LightSaml\Resolver\Endpoint\Criteria\IndexCriteria;
use LightSaml\Resolver\Endpoint\EndpointResolverInterface;

final class IndexEndpointResolver implements EndpointResolverInterface
{
    /** @param EndpointReference[] $candidates */
    public function resolve(CriteriaSet $criteriaSet, array $candidates): array
    {
        if (!$criteriaSet->has(IndexCriteria::class)) {
            return $candidates;
        }

        $result = [];
        foreach ($criteriaSet->get(IndexCriteria::class) as $criteria) {
            foreach ($candidates as $candidate) {
                $endpoint = $candidate->getEndpoint();
                if ($endpoint instanceof IndexedEndpoint && $endpoint->getIndex() == $criteria->getIndex()) {
                    $result[] = $candidate;
                }
            }
        }

        return $result;
    }
}
