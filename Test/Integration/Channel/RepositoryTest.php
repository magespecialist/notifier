<?php
/**
 * Automatically created by MageSpecialist CodeMonkey
 * https://github.com/magespecialist/m2-MSP_CodeMonkey
 */

declare(strict_types=1);

namespace MSP\Notifier\Test\Integration\Channel;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\TestFramework\Helper\Bootstrap;
use MSP\NotifierApi\Api\AdapterInterface;
use MSP\NotifierApi\Api\Data\ChannelInterface;

/**
 * @magentoDbIsolation enabled
 */
class RepositoryTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var \MSP\NotifierApi\Api\ChannelRepositoryInterface
     */
    private $repository;

    /**
     * @var \MSP\NotifierApi\Api\Data\ChannelInterfaceFactory
     */
    private $factory;

    /** @var AdapterInterface|AdapterInterface&\PHPUnit\Framework\MockObject\MockObject|\PHPUnit\Framework\MockObject\MockObject  */
    private $adapterMock;

    /**
     * @inheritdoc
     */
    protected function setUp(): void
    {
        // @codingStandardsIgnoreStart
        $this->repository = Bootstrap::getObjectManager()->get(
            \MSP\NotifierApi\Api\ChannelRepositoryInterface::class
        );
        $this->factory = Bootstrap::getObjectManager()->get(
            \MSP\NotifierApi\Api\Data\ChannelInterfaceFactory::class
        );
        // @codingStandardsIgnoreEnd
    }

    /**
     * Generate random values for this entity
     * @return array
     */
    private function generateRandomValues()
    {
        return [
            \MSP\NotifierApi\Api\Data\ChannelInterface::NAME => 'A random string ' . uniqid(),
            \MSP\NotifierApi\Api\Data\ChannelInterface::ADAPTER_CODE => 'email',
            \MSP\NotifierApi\Api\Data\ChannelInterface::CODE => 'A_random_string_' . uniqid(),
            \MSP\NotifierApi\Api\Data\ChannelInterface::ENABLED => (bool) rand(0, 1),
            \MSP\NotifierApi\Api\Data\ChannelInterface::CONFIGURATION_JSON => '{"to": "mail@example.com", "from": "mail@example.com", "from_name": "From Name"}',
        ];
    }

    /**
     * Generate random entities
     * @param int $itemsCount
     * @return array
     */
    private function generateEntities(int $itemsCount): array
    {
        $res = [];
        for ($i=0; $i<$itemsCount; $i++) {
            $channel = $this->factory->create()->setData($this->generateRandomValues());
            $this->repository->save($channel);
            $res[] = $channel;
        }

        return $res;
    }

    /**
     * Compare two entities content
     * @param ChannelInterface $entityA
     * @param ChannelInterface $entityB
     */
    private function compareEntities(ChannelInterface $entityA, ChannelInterface $entityB)
    {
        foreach ($entityA->getData() as $k => $v) {
            if ($k === 'id') {
                $this->assertEquals(
                    true,
                    $entityB->getId() == $v,
                    'Field ' . $k . ' not corresponding'
                );

                continue;
            }

            if ($k === 'extension_attributes') {
                continue;
            }

            // Perform non strict comparison due to SQL layer converting values to strings
            $this->assertEquals(
                true,
                $entityB->getData($k) == $v,
                'Field ' . $k . ' not corresponding'
            );
        }
    }

    /**
     * Creates a bunch of items, then retrieve them from DB and compare to original information
     */
    public function testCreateAndRead()
    {
        // Create entities
        $entities = $this->generateEntities(15);

        // Check entity creation entities
        foreach ($entities as $entity) {
            $this->assertGreaterThan(0, $entity->getId(), 'Item was not created');
        }

        // Retrieve entities and confirm
        foreach ($entities as $entity) {
            $entityGet = $this->repository->get((int) $entity->getId());
            $this->compareEntities($entityGet, $entity);
        }
    }

    /**
     * Creates a bunch of items, then retrieve them from DB, delete and check results
     */
    public function testCreateAndDelete()
    {
        // Create entities
        $entities = $this->generateEntities(3);

        // Delete entities
        foreach ($entities as $entity) {
            $this->repository->deleteById((int) $entity->getId());

            $this->expectException(NoSuchEntityException::class);
            $this->repository->get((int) $entity->getId());
        }
    }

    /**
     * Creates a bunch of items, then retrieve them from DB using a list and compare results
     */
    public function testCreateAndList()
    {
        // Create entities
        $entities = $this->generateEntities(15);

        // Retrieve list
        $entitiesList = $this->repository->getList()->getItems();
        foreach ($entities as $entity) {
            $this->assertArrayHasKey($entity->getId(), $entitiesList, 'Item not found in list');
            $this->compareEntities($entity, $entitiesList[$entity->getId()]);
        }
    }
}
