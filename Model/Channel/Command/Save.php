<?php
/**
 * Automatically created by MageSpecialist CodeMonkey
 * https://github.com/magespecialist/m2-MSP_CodeMonkey
 */

declare(strict_types=1);

namespace MSP\Notifier\Model\Channel\Command;

use Magento\Framework\Exception\CouldNotSaveException;
use MSP\Notifier\Model\Channel\Validator\ChannelValidatorInterface;
use MSP\Notifier\Model\ResourceModel\Channel;
use MSP\NotifierApi\Api\Data\ChannelInterface;
use Psr\Log\LoggerInterface;

/**
 * @inheritdoc
 */
class Save implements SaveInterface
{
    /**
     * @var Channel
     */
    private $resource;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var ChannelValidatorInterface
     */
    private $channelValidator;

    /**
     * Save constructor.
     * @param Channel $resource
     * @param ChannelValidatorInterface $channelValidator
     * @param LoggerInterface $logger
     */
    public function __construct(
        Channel $resource,
        ChannelValidatorInterface $channelValidator,
        LoggerInterface $logger
    ) {
        $this->resource = $resource;
        $this->logger = $logger;
        $this->channelValidator = $channelValidator;
    }

    /**
     * @inheritdoc
     */
    public function execute(ChannelInterface $channel): int
    {
        $this->channelValidator->execute($channel);

        try {
            $this->resource->save($channel);
            return (int) $channel->getId();
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            throw new CouldNotSaveException(__('Could not save Channel'), $e);
        }
    }
}
