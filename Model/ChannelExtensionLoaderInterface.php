<?php
/**
 * Automatically created by MageSpecialist CodeMonkey
 * https://github.com/magespecialist/m2-MSP_CodeMonkey
 */

declare(strict_types=1);

namespace MSP\Notifier\Model;

use MSP\NotifierApi\Api\Data\ChannelInterface;

/**
 * Extension attribute loader for Channel
 *
 * @api
 */
interface ChannelExtensionLoaderInterface
{
    /**
     * Load extension attributes
     * @param ChannelInterface $channel
     */
    public function execute(ChannelInterface $channel);
}
