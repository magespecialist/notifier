<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\Notifier\Model\Channel\Validator;

use MSP\NotifierApi\Api\Data\ChannelInterface;

class ChannelValidatorChain implements ChannelValidatorInterface
{
    /**
     * @var ChannelValidatorInterface[]
     */
    private $validators;

    /**
     * ChannelValidatorChain constructor.
     * @param array $validators
     * @throws \InvalidArgumentException
     */
    public function __construct(
        array $validators = []
    ) {
        $this->validators = $validators;

        foreach ($this->validators as $k => $validator) {
            if (!($validator instanceof ChannelValidatorInterface)) {
                throw new \InvalidArgumentException('Validator %1 must implement ChannelValidatorInterface', $k);
            }
        }
    }

    /**
     * Execute validation. Return true on success or trigger an exception on failure
     * @param ChannelInterface $channel
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function execute(ChannelInterface $channel): bool
    {
        foreach ($this->validators as $validator) {
            $validator->execute($channel);
        }

        return true;
    }
}
