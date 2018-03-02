<?php
/**
 * Automatically created by MageSpecialist CodeMonkey
 * https://github.com/magespecialist/m2-MSP_CodeMonkey
 */

declare(strict_types=1);

namespace MSP\Notifier\Model\Channel\Command;

use Magento\Framework\Exception\CouldNotSaveException;

/**
 * Save Channel data command (Service Provider Interface - SPI)
 *
 * Separate command interface to which Repository proxies initial Save call, could be considered as SPI - Interfaces
 * that you should extend and implement to customize current behaviour, but NOT expected to be used (called) in the code
 * of business logic directly
 *
 * @see \MSP\NotifierApi\Api\ChannelRepositoryInterface
 * @api
 */
interface SaveInterface
{
    /**
     * Save Channel data
     *
     * @param \MSP\NotifierApi\Api\Data\ChannelInterface $source
     * @return int
     * @throws CouldNotSaveException
     */
    public function execute(\MSP\NotifierApi\Api\Data\ChannelInterface $source): int;
}
