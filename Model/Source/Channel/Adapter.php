<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\Notifier\Model\Source\Channel;

use Magento\Framework\Option\ArrayInterface;
use MSP\NotifierApi\Api\AdapterRepositoryInterface;

class Adapter implements ArrayInterface
{
    /**
     * @var AdapterRepositoryInterface
     */
    private $adapterRepository;

    /**
     * Adapter constructor.
     * @param AdapterRepositoryInterface $adapterRepository
     */
    public function __construct(
        AdapterRepositoryInterface $adapterRepository
    ) {
        $this->adapterRepository = $adapterRepository;
    }

    /**
     * @inheritdoc
     */
    public function toOptionArray()
    {
        $adapters = $this->adapterRepository->getAdapters();

        $res = [];
        foreach ($adapters as $adapter) {
            $res[] = [
                'value' => $adapter->getCode(),
                'label' => $adapter->getDescription(),
            ];
        }

        return $res;
    }
}
