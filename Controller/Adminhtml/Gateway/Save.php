<?php

declare(strict_types=1);

namespace RCFerreira\Gateway\Controller\Adminhtml\Gateway;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;
use RCFerreira\Gateway\Api\GatewayRepositoryInterface;
use RCFerreira\Gateway\Api\Data\GatewayInterface;

class Save extends Action implements HttpPostActionInterface
{
    public const ADMIN_RESOURCE = 'RCFerreira_Gateway::save';

    /**
     * @param Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param GatewayRepositoryInterface $gatewayRepository
     */
    public function __construct(
        Context $context,
        private DataPersistorInterface $dataPersistor,
        private GatewayRepositoryInterface $gatewayRepository,
        private GatewayInterface $gateway
    ) {
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface|mixed
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();

        if ($data) {
            if (empty($data['entity_id'])) {
                $data['entity_id_id'] = null;
            }

            $id = (int) $this->getRequest()->getParam('entity_id');
            if ($id) {
                try {
                    $model = $this->gatewayRepository->getById($id);

                    if (!empty($model->getId())) {
                        $this->gateway->setId($model->getId());
                    }

                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This gateway data api no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            }

            $this->gateway->setEnvironment($data['environment']);
            $this->gateway->setMethod($data['method']);
            $this->gateway->setPath($data['path']);
            $this->gateway->setParameters($data['parameters']);

            try {
                $data['entity_id'] = $this->gatewayRepository->save($this->gateway);
                $this->messageManager->addSuccessMessage(__('You saved the gateway data api.'));
                return $this->processBlockReturn($data, $resultRedirect);
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the block.'));
            }

            return $resultRedirect->setPath('*/*/edit', ['entity_id' => $id]);
        }
        return $resultRedirect->setPath('*/*/');
    }

    /**
     * @param $model
     * @param $data
     * @param $resultRedirect
     * @return mixed
     */
    private function processBlockReturn($data, $resultRedirect)
    {
        $redirect = $data['back'] ?? 'close';

        if ($redirect ==='continue') {
            $resultRedirect->setPath('*/*/edit', ['entity_id' => $data['entity_id']]);
        } elseif ($redirect === 'close') {
            $resultRedirect->setPath('*/*/');
        } elseif ($redirect === 'duplicate') {
            $this->gateway->setEnvironment($data['environment']);
            $this->gateway->setMethod($data['method']);
            $this->gateway->setPath($data['path']);
            $this->gateway->setParameters($data['parameters']);
            $this->gateway->setId(null);
            $id = $this->gatewayRepository->save($this->gateway);

            $this->messageManager->addSuccessMessage(__('You duplicated the gateway data api.'));

            $resultRedirect->setPath('*/*/edit', ['entity_id' => $id]);
        }
        return $resultRedirect;
    }
}

