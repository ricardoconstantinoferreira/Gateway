<?php

declare(strict_types=1);

namespace RCFerreira\Gateway\Controller\Adminhtml\Gateway;

use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\App\Action\Context;

class Index extends \Magento\Backend\App\Action
{

    public const ADMIN_RESOURCE = 'RCFerreira_Gateway::index';

    /**
     * @param PageFactory $resultPageFactory
     * @param Context $context
     */
    public function __construct(
        private PageFactory $resultPageFactory,
        Context $context
    ) {
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend((__('Listing Gateway Connections')));
        return $resultPage;
    }
}

