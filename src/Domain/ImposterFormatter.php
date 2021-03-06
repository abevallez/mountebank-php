<?php

namespace MountebankPHP\Domain;

/**
 * Class ImposterFormatter
 */
class ImposterFormatter
{
    /**
     * @param Imposter $imposter
     *
     * @return string
     */
    public function getJsonImposter(Imposter $imposter)
    {
        return json_encode([
            'protocol' => $imposter->getProtocol(),
            'port'=> $imposter->getPort(),
            'stubs' => $this->getJsonStubs($imposter)
        ]);
    }

    /**
     * Get Json Stubs.
     *
     * @param Imposter $imposter
     *
     * @return array
     */
    protected function getJsonStubs(Imposter $imposter)
    {
        $jsonStubs = [];

        foreach ($imposter->getStubs() as $stub) {
            $jsonStubs[] = $this->getJsonStub($stub);
        }

        return $jsonStubs;
    }

    /**
     * Get Json Stub.
     *
     * @param Stub $stub
     *
     * @return array
     */
    protected function getJsonStub(Stub $stub)
    {
        $jsonResponses = [];
        $jsonPredicates = [];

        /** @var Response $response */
        foreach ($stub->getResponses() as $response) {
            $jsonResponses[] = $response->getJsonDefinition();
        }

        /** @var Predicate $response */
        foreach ($stub->getPredicates() as $predicate) {
            $jsonPredicates[] = $predicate->getJsonDefinition();
        }

        return [
            'responses' => $jsonResponses,
            'predicates' => $jsonPredicates
        ];
    }
}