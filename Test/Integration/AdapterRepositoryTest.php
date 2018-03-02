<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\Notifier\Test\Integration;

use Magento\TestFramework\Helper\Bootstrap;
use MSP\NotifierApi\Api\AdapterInterface;
use MSP\NotifierApi\Api\AdapterRepositoryInterface;

class AdapterRepositoryTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var AdapterRepositoryInterface
     */
    private $adapterRepository;

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        // @codingStandardsIgnoreStart
        $this->adapterRepository = Bootstrap::getObjectManager()->get(AdapterRepositoryInterface::class);
        // @codingStandardsIgnoreEnd
    }

    /**
     * Test if each adapter satisfies AdapterInterface
     */
    public function testAdaptersInstance()
    {
        $adaptersList = $this->adapterRepository->getAdapters();
        foreach ($adaptersList as $adapter) {
            $this->assertInstanceOf(AdapterInterface::class, $adapter, 'Adapter does not implement AdapterInterface');
        }
    }

    /**
     * Check "getAdapterByCode" method and check if DI key is the same of internal adapter's code
     */
    public function testAdapterByCode()
    {
        $adaptersList = $this->adapterRepository->getAdapters();
        foreach ($adaptersList as $adapterCode => $adapter) {
            $this->assertInstanceOf(
                get_class($adapter),
                $this->adapterRepository->getAdapterByCode($adapterCode),
                'Adapter interface mismatch'
            );
            $this->assertEquals($adapter->getCode(), $adapterCode, 'Adapter code mismatch');
        }
    }

    /**
     * Check if we have at least one adapter
     */
    public function testAdaptersCount()
    {
        $this->assertGreaterThan(0, $this->adapterRepository->getAdapters(), 'No adapters were found');
    }
}
