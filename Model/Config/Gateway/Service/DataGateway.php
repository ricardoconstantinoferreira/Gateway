<?php

declare(strict_types=1);

namespace RCFerreira\Gateway\Model\Config\Gateway\Service;

use Magento\Framework\Api\SearchCriteriaBuilder;
use RCFerreira\Gateway\Api\GatewayRepositoryInterface;
use RCFerreira\Gateway\Helper\Data as HelperData;

class DataGateway
{
    /**
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param GatewayRepositoryInterface $gatewayRepository
     * @param HelperData $helperData
     */
    public function __construct(
        private SearchCriteriaBuilder $searchCriteriaBuilder,
        private GatewayRepositoryInterface $gatewayRepository,
        private HelperData $helperData
    ) {}

    /**
     * @return array
     */
    public function getDataEnvironment(): array
    {
        $name = $this->helperData->getGatewayName();
        $environment = $this->helperData->getGatewayEnvironment();

        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter("name", $name)
            ->addFilter("environment", $environment)
            ->create();

        return $this->gatewayRepository->getList($searchCriteria);
    }
}
