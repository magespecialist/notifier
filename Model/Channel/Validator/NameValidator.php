<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\Notifier\Model\Channel\Validator;

use MSP\NotifierApi\Api\Data\ChannelInterface;

class NameValidator implements ChannelValidatorInterface
{
    /**
     * Execute validation. Return true on success or trigger an exception on failure
     * @param ChannelInterface $channel
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function execute(ChannelInterface $channel): bool
    {
        if (!trim($channel->getName())) {
            throw new \InvalidArgumentException('' . __('Channel name is required'));
        }

        return true;
    }
}
