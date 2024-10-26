<?php

declare(strict_types=1);

namespace RCFerreira\Gateway\Model;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use RCFerreira\Gateway\Api\Data\GatewayInterface;
use RCFerreira\Gateway\Api\GatewayRepositoryInterface;
use RCFerreira\Gateway\Model\ResourceModel\Gateway as GatewayResourceModel;
use RCFerreira\Gateway\Model\ResourceModel\Gateway\CollectionFactory;
use RCFerreira\Gateway\Api\Data\GatewaySearchResultsInterfaceFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;

class GatewayRepository implements GatewayRepositoryInterface
{
    /**
     * @param GatewayResourceModel $gatewayResourceModel
     * @param CollectionFactory $collectionFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param GatewaySearchResultsInterfaceFactory $gatewaySearchResults
     * @param GatewayFactory $gatewayFactory
     */
    public function __construct(
        private GatewayResourceModel $gatewayResourceModel,
        private CollectionFactory $collectionFactory,
        private CollectionProcessorInterface $collectionProcessor,
        private GatewaySearchResultsInterfaceFactory $gatewaySearchResults,
        private GatewayFactory $gatewayFactory
    ) {}

    /**
     * @param GatewayInterface $gateway
     * @return int
     * @throws CouldNotSaveException
     */
    public function save(GatewayInterface $gateway): int
    {
        try {
            $this->gatewayResourceModel->save($gateway);
            return (int) $gateway->getId();
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__('Error to save data apis'));
        }
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return array
     */
    public function getList(SearchCriteriaInterface $searchCriteria): array
    {
        $items = [];
        $collection = $this->collectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResults = $this->gatewaySearchResults->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        if (!empty($searchResults->getItems())) {
            foreach ($searchResults->getItems() as $item) {
                $items[] = $item->getData();
            }
        }

        return $items;
    }

    /**
     * @param int $id
     * @return GatewayInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $id): GatewayInterface
    {
        $gateway = $this->gatewayFactory->create();
        $this->gatewayResourceModel->load($gateway, $id);

        if (!$gateway->getId()) {
            throw new NoSuchEntityException(__('The gateway data api "%1" ID doesn\'t exist.', $id));
        }

        return $gateway;
    }

    /**
     * @param int $id
     * @return bool
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById(int $id): bool
    {
        return $this->delete($this->getById($id));
    }

    /**
     * @param GatewayInterface $gateway
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(GatewayInterface $gateway): bool
    {
        try {
            $this->gatewayResourceModel->delete($gateway);
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(__($e->getMessage()));
        }
        return true;
    }
}
