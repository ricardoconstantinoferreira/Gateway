<?php

declare(strict_types=1);

namespace RCFerreira\Gateway\Model;

use RCFerreira\Gateway\Api\GatewayTestInterface;
use RCFerreira\Gateway\Model\Config\Gateway\Http;

class GatewayTest implements GatewayTestInterface
{

    public function __construct(
        private Http $http
    ) {}

    public function execute(): void
    {
       $response = $this->http->send("stores", "GET", null);
       $teste = $response;
    }
}
