<?php

declare(strict_types=1);

namespace RCFerreira\Gateway\Api;

interface GatewayTestInterface
{
    /**
     * @api
     *
     * @return void
     */
    public function execute(): void;

}
