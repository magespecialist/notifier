<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\Notifier\Model;

use MSP\Notifier\Model\AdapterEngine\AdapterEngineInterface;
use MSP\Notifier\Model\AdapterEngine\ValidatorChainInterface;
use MSP\NotifierApi\Api\AdapterInterface;

class Adapter implements AdapterInterface
{
    /**
     * @var AdapterEngineInterface
     */
    private $engine;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var ValidatorChainInterface
     */
    private $validatorChain;

    /**
     * Adapter constructor.
     * @param AdapterEngineInterface $engine
     * @param ValidatorChainInterface $validatorChain
     * @param string $code
     * @param string $name
     * @param string $description
     */
    public function __construct(
        AdapterEngineInterface $engine,
        ValidatorChainInterface $validatorChain,
        string $code,
        string $name,
        string $description
    ) {
        $this->engine = $engine;
        $this->validatorChain = $validatorChain;
        $this->code = $code;
        $this->name = $name;
        $this->description = $description;
    }

    /**
     * @inheritdoc
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @inheritdoc
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @inheritdoc
     */
    public function sendMessage(string $message, array $params = []): bool
    {
        $message = trim($message);
        $this->validateMessage($message);
        $this->validateParams($params);

        return $this->engine->execute($message, $params);
    }

    /**
     * @inheritdoc
     */
    public function validateMessage(string $message): bool
    {
        $message = trim($message);
        return $this->validatorChain->validateMessage($message);
    }

    /**
     * @inheritdoc
     */
    public function validateParams(array $params = []): bool
    {
        return $this->validatorChain->validateParams($params);
    }
}
