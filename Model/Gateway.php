<?php

declare(strict_types=1);

namespace RCFerreira\Gateway\Model;

use Magento\Framework\Model\AbstractModel;
use RCFerreira\Gateway\Api\Data\GatewayInterface;
use RCFerreira\Gateway\Model\ResourceModel\Gateway as ResourceModelGateway;

class Gateway extends AbstractModel implements GatewayInterface
{

    public function _construct()
    {
        $this->_init(ResourceModelGateway::class);
    }

    /**
     * @param $entity_id
     * @return mixed|AbandonedCart
     */
    public function setId($entity_id)
    {
        return $this->setData(self::ENTITY_ID, $entity_id);
    }

    /**
     * @return array|mixed|null
     */
    public function getId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    /**
     * @param string $name
     * @return GatewayInterface
     */
    public function setName(string $name): GatewayInterface
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->getData(self::NAME);
    }

    /**
     * @param string $environment
     * @return GatewayInterface
     */
    public function setEnvironment(string $environment): GatewayInterface
    {
        return $this->setData(self::ENVIRONMENT, $environment);
    }

    /**
     * @return string
     */
    public function getEnvironment(): string
    {
        return $this->getData(self::ENVIRONMENT);
    }

    /**
     * @param string $path
     * @return GatewayInterface
     */
    public function setPath(string $path): GatewayInterface
    {
        return $this->setData(self::PATH, $path);
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->getData(self::PATH);
    }

    /**
     * @param string $token
     * @return GatewayInterface
     */
    public function setToken(string $token): GatewayInterface
    {
        return $this->setData(self::TOKEN, $token);
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->getData(self::TOKEN);
    }
}
