<?php
/**
 * Automatically created by MageSpecialist CodeMonkey
 * https://github.com/magespecialist/m2-MSP_CodeMonkey
 */

declare(strict_types=1);

namespace MSP\Notifier\Model\Channel\Command;

use Magento\Framework\Exception\NoSuchEntityException;

/**
 * @inheritdoc
 */
class Get implements GetInterface
{
    /**
     * @var \MSP\Notifier\Model\ResourceModel\Channel
     */
    private $resource;

    /**
     * @var \MSP\NotifierApi\Api\Data\ChannelInterfaceFactory
     */
    private $factory;

    /**
     * @param \MSP\Notifier\Model\ResourceModel\Channel $resource
     * @param \MSP\NotifierApi\Api\Data\ChannelInterfaceFactory $factory
     */
    public function __construct(
        \MSP\Notifier\Model\ResourceModel\Channel $resource,
        \MSP\NotifierApi\Api\Data\ChannelInterfaceFactory $factory
    ) {
        $this->resource = $resource;
        $this->factory = $factory;
    }

    /**
     * @inheritdoc
     */
    public function execute(int $channelId): \MSP\NotifierApi\Api\Data\ChannelInterface
    {
        /** @var \MSP\NotifierApi\Api\Data\ChannelInterface $channel */
        $channel = $this->factory->create();
        $this->resource->load(
            $channel,
            $channelId,
            \MSP\NotifierApi\Api\Data\ChannelInterface::ID
        );

        if (null === $channel->getId()) {
            throw new NoSuchEntityException(__('Channel with id "%value" does not exist.', [
                'value' => $channelId
            ]));
        }

        return $channel;
    }
}
