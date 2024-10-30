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

    /**
     * apenas para testar 
     */
    public function execute(): void
    {
       $response = $this->http->send("05633090/json", "GET", null);
       print "<pre>";
       print_r($response);
    }
}
