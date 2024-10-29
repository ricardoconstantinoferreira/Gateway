<?php

declare(strict_types=1);

namespace RCFerreira\Gateway\Model\Config\Gateway;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Serialize\Serializer\Json;
use GuzzleHttp\Client as GuzzleClient;
use RCFerreira\Gateway\Model\Config\Gateway\Service\DataGateway;

class Http
{
    /**
     * @param Json $json
     * @param GuzzleClient $client
     * @param DataGateway $dataGateway
     */
    public function __construct(
        private Json $json,
        private GuzzleClient $client,
        private DataGateway $dataGateway
    ) {}

    /**
     * @param string $uri
     * @param string $method
     * @param array|null $body
     * @return array|bool|float|int|mixed|string|null
     * @throws NoSuchEntityException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function send(
        string $uri,
        string $method,
        array $body = null
    ) {

        try {

            $result = $this->dataGateway->getDataEnvironment();
            $result = current($result);

            $parameters['headers']['Content-Type'] = "application/json";

            if (!empty($result['token'])) {
                $parameters['headers']['Authorization'] = "Bearer {$result['token']}";
            }

            if (!empty($body)) {
                $body = $this->json->serialize($body);
                $parameters['body'] = $body;
            }

            $uri = $result['path'] . $uri;

            $response = $this->client->request(
                $method,
                $uri,
                [$parameters]
            );

            return $this->json->unserialize($response->getBody()->__toString());

        } catch (\Exception $e) {
            throw new NoSuchEntityException(__($e->getMessage()));
        }
    }
}
