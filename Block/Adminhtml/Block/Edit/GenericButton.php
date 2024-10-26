<?php

declare(strict_types=1);

namespace RCFerreira\Gateway\Block\Adminhtml\Block\Edit;

use Magento\Backend\Block\Widget\Context;
use RCFerreira\Gateway\Api\GatewayRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class GenericButton
 */
class GenericButton
{
    /**
     * @param Context $context
     * @param GatewayRepositoryInterface $gatewayRepository
     */
    public function __construct(
        private Context $context,
        private GatewayRepositoryInterface $gatewayRepository
    ) {}

    /**
     * @return mixed|null
     */
    public function getEntityId()
    {
        try {
            return $this->gatewayRepository->getById(
                (int) $this->context->getRequest()->getParam('entity_id')
            )->getId();
        } catch (NoSuchEntityException $e) {
        }
        return null;
    }

    /**
     * @param $route
     * @param $params
     * @return string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
