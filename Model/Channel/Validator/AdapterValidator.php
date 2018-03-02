<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\Notifier\Model\Channel\Validator;

use Magento\Framework\Exception\NoSuchEntityException;
use MSP\NotifierApi\Api\AdapterRepositoryInterface;
use MSP\NotifierApi\Api\Data\ChannelInterface;
use MSP\Notifier\Model\SerializerInterface;

class AdapterValidator implements ChannelValidatorInterface
{
    /**
     * @var AdapterRepositoryInterface
     */
    private $adapterRepository;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * BasicValidator constructor.
     * @param AdapterRepositoryInterface $adapterRepository
     * @param SerializerInterface $serializer
     */
    public function __construct(
        AdapterRepositoryInterface $adapterRepository,
        SerializerInterface $serializer
    ) {
        $this->adapterRepository = $adapterRepository;
        $this->serializer = $serializer;
    }

    /**
     * Execute validation. Return true on success or trigger an exception on failure
     * @param ChannelInterface $channel
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function execute(ChannelInterface $channel): bool
    {
        try {
            $adapter = $this->adapterRepository->getAdapterByCode($channel->getAdapterCode());
        } catch (NoSuchEntityException $e) {
            throw new \InvalidArgumentException('' . __('Invalid adapter code'));
        }

        // Validate adapter's specific configuration
        $params = $this->serializer->unserialize($channel->getConfigurationJson());
        $adapter->validateParams($params);

        return true;
    }
}
