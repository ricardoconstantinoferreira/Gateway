<?php

declare(strict_types=1);

namespace RCFerreira\Gateway\Controller\Adminhtml\Gateway;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Backend\App\Action;
use RCFerreira\Gateway\Api\GatewayRepositoryInterface;

class Edit extends \Magento\Backend\App\Action implements HttpGetActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'RCFerreira_Gateway::save';


    /**
     * @param Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Framework\Registry $registry
     * @param GatewayRepositoryInterface $gatewayRepository
     */
    public function __construct(
        Action\Context $context,
        private \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        private \Magento\Framework\Registry $registry,
        private GatewayRepositoryInterface $gatewayRepository
    ) {
        parent::__construct($context);
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Page
     */
    protected function _initAction()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('RCFerreira_Gateway::menu')
            ->addBreadcrumb(__('Gateway Data API'), __('Gateway Data API'))
            ->addBreadcrumb(__('Manage Gateway Data API'), __('Manage IGateway Data API'));

        return $resultPage;
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Page|\Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $id = (int) $this->getRequest()->getParam('entity_id');

        if ($id) {
            $gateway = $this->gatewayRepository->getById($id);
            if (!$gateway->getId()) {
                $this->messageManager->addErrorMessage(__('This Gateway Data API no longer exists.'));
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }

        $resultPage = $this->_initAction();
        $resultPage->addBreadcrumb(
            $id ? __('Edit Gateway Data API') : __('New Gateway Data API'),
            $id ? __('Edit Gateway Data API') : __('New Gateway Data API')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Pages'));

        $resultPage->getConfig()->getTitle()
            ->prepend((!empty($gateway)) ? $gateway->getEnvironment() : __('New Gateway Data API'));

        return $resultPage;
    }
}
