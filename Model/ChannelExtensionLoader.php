<?php
/**
 * Automatically created by MageSpecialist CodeMonkey
 * https://github.com/magespecialist/m2-MSP_CodeMonkey
 */

declare(strict_types=1);

namespace MSP\Notifier\Model;

use MSP\NotifierApi\Api\Data\ChannelExtensionFactory;
use MSP\NotifierApi\Api\Data\ChannelInterface;

class ChannelExtensionLoader implements ChannelExtensionLoaderInterface
{
    /**
     * @var ChannelExtensionFactory
     */
    private $extensionFactory;

    /**
     * ChannelExtLoader constructor.
     * @param ChannelExtensionFactory $extensionFactory
     * @SuppressWarnings(PHPMD.LongVariables)
     */
    public function __construct(
        ChannelExtensionFactory $extensionFactory
    ) {
        $this->extensionFactory = $extensionFactory;
    }

    /**
     * @inheritdoc
     */
    public function execute(ChannelInterface $channel)
    {
        if ($channel->getExtensionAttributes() === null) {
            $extension = $this->extensionFactory->create();
            $channel->setExtensionAttributes($extension);
        }
    }
}
