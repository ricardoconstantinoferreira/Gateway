<?php

declare(strict_types=1);

namespace RCFerreira\Gateway\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{

    public const GATEWAY_NAME = "ferreira_gateway/general/name";

    public const GATEWAY_ENVIRONMENT = "ferreira_gateway/general/environment";

    /**
     * @return string
     */
    public function getGatewayName(): string
    {
        return $this->scopeConfig->getValue(self::GATEWAY_NAME, ScopeInterface::SCOPE_STORE);
    }

    /**
     * @return string
     */
    public function getGatewayEnvironment(): string
    {
        return $this->scopeConfig->getValue(self::GATEWAY_ENVIRONMENT, ScopeInterface::SCOPE_STORE);
    }

}
