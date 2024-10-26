<?php

declare(strict_types=1);

namespace RCFerreira\Gateway\Model\ResourceModel\Gateway;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use RCFerreira\Gateway\Model\Gateway;
use RCFerreira\Gateway\Model\ResourceModel\Gateway as GatewayResourceModel;

class Collection extends AbstractCollection
{
    public function _construct()
    {
        $this->_init(Gateway::class, GatewayResourceModel::class);
    }
}
