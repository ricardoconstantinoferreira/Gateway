<?php

declare(strict_types=1);

namespace RCFerreira\Gateway\Controller\Adminhtml\Gateway;

use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface as HttpPostActionInterface;
use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;
use RCFerreira\Gateway\Model\ResourceModel\Gateway\CollectionFactory;
use Magento\Ui\Component\MassAction\Filter;
use RCFerreira\Gateway\Api\GatewayRepositoryInterface;

class MassDelete extends Action implements HttpPostActionInterface
{

    public const ADMIN_RESOURCE = 'RCFerreira_Gateway::delete';

    /**
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     * @param GatewayRepositoryInterface $gatewayRepository
     */
    public function __construct(
        Context $context,
        private Filter $filter,
        private CollectionFactory $collectionFactory,
        private GatewayRepositoryInterface $gatewayRepository
    ) {
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|(\Magento\Framework\Controller\Result\Redirect&\Magento\Framework\Controller\ResultInterface)|\Magento\Framework\Controller\ResultInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $collectionSize = $collection->getSize();

        foreach ($collection as $gateway) {
            $this->gatewayRepository->deleteById((int) $gateway->getId());
        }

        $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been deleted.', $collectionSize));
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        return $resultRedirect->setPath('*/*/');
    }
}
