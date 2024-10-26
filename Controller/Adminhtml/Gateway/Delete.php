<?php

declare(strict_types=1);

namespace RCFerreira\Gateway\Controller\Adminhtml\Gateway;

use RCFerreira\Gateway\Api\GatewayRepositoryInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;

class Delete extends \Magento\Backend\App\Action implements HttpPostActionInterface
{

    const ADMIN_RESOURCE = 'RCFerreira_Gateway::delete';

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param GatewayRepositoryInterface $gatewayRepository
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        private GatewayRepositoryInterface $gatewayRepository
    ) {
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = (int) $this->getRequest()->getParam('entity_id');
        if ($id) {
            try {

                $this->gatewayRepository->deleteById($id);
                $this->messageManager->addSuccessMessage(__('You deleted the gateway data api.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['entity_id' => $id]);
            }
        }
        $this->messageManager->addErrorMessage(__('We can\'t find a gateway data api to delete.'));
        return $resultRedirect->setPath('*/*/');
    }
}

