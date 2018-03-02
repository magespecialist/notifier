<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\Notifier\Model\AdapterEngine\ParamsValidator;

use MSP\Notifier\Model\AdapterEngine\ParamsValidatorInterface;

class Required implements ParamsValidatorInterface
{
    /**
     * @var array
     */
    private $requiredParams;

    /**
     * Required constructor.
     * @param array $requiredParams
     */
    public function __construct(
        array $requiredParams
    ) {
        $this->requiredParams = $requiredParams;
    }

    /**
     * @inheritdoc
     */
    public function execute(array $params): bool
    {
        foreach ($this->requiredParams as $requiredParam) {
            if (!isset($params[$requiredParam]) ||
                ($params[$requiredParam] === null) ||
                (is_array($params[$requiredParam]) && empty($params[$requiredParam])) ||
                (is_string($params[$requiredParam]) && trim((string) $params[$requiredParam]) === '')
            ) {
                throw new \InvalidArgumentException(sprintf('Parameter %s cannot be empty', $requiredParam));
            }
        }

        return true;
    }
}
