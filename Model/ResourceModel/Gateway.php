<?php

declare(strict_types=1);

namespace RCFerreira\Gateway\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use RCFerreira\Gateway\Api\Data\GatewayInterface;

class Gateway extends AbstractDb
{

    public function _construct()
    {
        $this->_init(GatewayInterface::TABLE, GatewayInterface::ENTITY_ID);
    }

}
