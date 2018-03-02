<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\Notifier\Model\Channel\Validator;

use MSP\NotifierApi\Api\Data\ChannelInterface;

class CodeValidator implements ChannelValidatorInterface
{
    /**
     * Execute validation. Return true on success or trigger an exception on failure
     * @param ChannelInterface $channel
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function execute(ChannelInterface $channel): bool
    {
        if (!preg_match('/^[\w_]+$/', $channel->getCode())) {
            throw new \InvalidArgumentException('' . __('Invalid channel identifier: No special chars are allowed'));
        }

        if (!trim($channel->getCode())) {
            throw new \InvalidArgumentException('' . __('Channel identifier is required'));
        }

        return true;
    }
}
