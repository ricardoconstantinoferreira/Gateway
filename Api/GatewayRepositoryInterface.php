<?php

declare(strict_types=1);

namespace RCFerreira\Gateway\Api;

use RCFerreira\Gateway\Api\Data\GatewayInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

interface GatewayRepositoryInterface
{
    /**
     * @param GatewayInterface $gateway
     * @return int
     */
    public function save(GatewayInterface $gateway): int;

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return array
     */
    public function getList(SearchCriteriaInterface $searchCriteria): array;

    /**
     * @param int $id
     * @return GatewayInterface
     */
    public function getById(int $id): GatewayInterface;

    /**
     * @param int $id
     * @return bool
     */
    public function deleteById(int $id): bool;

    /**
     * @param GatewayInterface $gateway
     * @return bool
     */
    public function delete(GatewayInterface $gateway): bool;
}
