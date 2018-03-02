<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\Notifier\Model\AdapterEngine\MessageValidator;

use MSP\Notifier\Model\AdapterEngine\MessageValidatorInterface;

class Required implements MessageValidatorInterface
{
    /**
     * @inheritdoc
     */
    public function execute(string $message): bool
    {
        if (trim($message) === '') {
            throw new \InvalidArgumentException('Message cannot be empty');
        }

        return true;
    }
}
