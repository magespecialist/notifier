<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\Notifier\Model\AdapterEngine;

interface ValidatorChainInterface
{
    /**
     * Validate a message
     * @param string $message
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function validateMessage(string $message): bool;

    /**
     * Validate parameters
     * @param array $params
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function validateParams(array $params): bool;
}
