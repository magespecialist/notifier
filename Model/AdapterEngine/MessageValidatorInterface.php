<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\Notifier\Model\AdapterEngine;

interface MessageValidatorInterface
{
    /**
     * Must:
     *  - Throw an InvalidArgumentException in case of failure
     *  - Return true on success
     *
     * @param string $message
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function execute(string $message): bool;
}
