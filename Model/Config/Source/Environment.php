<?php

declare(strict_types=1);

namespace RCFerreira\Gateway\Model\Config\Source;

use RCFerreira\Gateway\Model\ResourceModel\Gateway as GatewayResourceModel;

class Environment implements \Magento\Framework\Option\ArrayInterface
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
        $results = $this->gateway->fetchAllData();

        if (!empty($results)) {
            foreach ($results as $key => $result) {
                $options[$key]['value'] = $result['environment'];
                $options[$key]['label'] = $result['environment'];
            }
        }

        return $options;
    }
}
