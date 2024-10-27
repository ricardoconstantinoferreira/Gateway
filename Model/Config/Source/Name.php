<?php

declare(strict_types=1);

namespace RCFerreira\Gateway\Model\Config\Source;

use RCFerreira\Gateway\Model\ResourceModel\Gateway as GatewayResourceModel;

class Name implements \Magento\Framework\Option\ArrayInterface
{

    public function __construct(
        private GatewayResourceModel $gateway
    ){}

    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function toOptionArray()
    {
        $options = [];
        $results = $this->gateway->fetchAllDataName();

        if (!empty($results)) {
            foreach ($results as $key => $result) {
                $options[$key]['value'] = $result['name'];
                $options[$key]['label'] = $result['name'];
            }
        }

        return $options;
    }
}

