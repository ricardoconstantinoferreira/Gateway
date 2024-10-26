<?php

declare(strict_types=1);

namespace RCFerreira\Gateway\Api\Data;

interface GatewayInterface
{

    public const TABLE = 'rcferreira_gateway';

    public const ENTITY_ID = 'entity_id';

    public const ENVIRONMENT = 'environment';

    public const METHOD = 'method';

    public const PATH = 'path';

    public const TOKEN = 'token';

    /**
     * @param $entity_id
     * @return mixed
     */
    public function setId($entity_id);

    /**
     * @return mixed
     */
    public function getId();

    /**
     * @param string $environment
     * @return GatewayInterface
     */
    public function setEnvironment(string $environment): GatewayInterface;

    /**
     * @return string
     */
    public function getEnvironment(): string;

    /**
     * @param string $method
     * @return GatewayInterface
     */
    public function setMethod(string $method): GatewayInterface;

    /**
     * @return string
     */
    public function getMethod(): string;

    /**
     * @param string $path
     * @return GatewayInterface
     */
    public function setPath(string $path): GatewayInterface;

    /**
     * @return string
     */
    public function getPath(): string;

    /**
     * @param string $token
     * @return GatewayInterface
     */
    public function setToken(string $token): GatewayInterface;

    /**
     * @return string
     */
    public function getToken(): string;
}
