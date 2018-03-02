<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\Notifier\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use MSP\Notifier\Setup\Operation\CreateChannelTable;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * @var CreateChannelTable
     */
    private $createChannelTable;

    public function __construct(
        CreateChannelTable $createChannelTable
    ) {
        $this->createChannelTable = $createChannelTable;
    }

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $this->createChannelTable->execute($setup);
        $setup->endSetup();
    }
}
