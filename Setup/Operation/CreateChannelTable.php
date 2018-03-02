<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\Notifier\Setup\Operation;

use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\SchemaSetupInterface;

class CreateChannelTable
{
    const TABLE_NAME_CHANNEL = 'msp_notifier_channel';

    /**
     * @param SchemaSetupInterface $setup
     * @return void
     * @throws \Zend_Db_Exception
     */
    public function execute(SchemaSetupInterface $setup)
    {
        $channelTable = $setup->getConnection()->newTable(
            $setup->getTable(self::TABLE_NAME_CHANNEL)
        )->setComment(
            'MSP Notifier Channels Configuration Table'
        );

        $channelTable = $this->addFields($channelTable);
        $channelTable = $this->addIndexes($setup, $channelTable);

        $setup->getConnection()->createTable($channelTable);
    }

    /**
     * Add fields
     * @param Table $channelTable
     * @return Table
     * @throws \Zend_Db_Exception
     */
    private function addFields(Table $channelTable): Table
    {
        $channelTable
            ->addColumn(
                'channel_id',
                Table::TYPE_INTEGER,
                null,
                [
                    'identity' => true,
                    'unsigned' => true,
                    'nullable' => false,
                    'primary' => true,
                ],
                'Channel ID'
            )->addColumn(
                'name',
                Table::TYPE_TEXT,
                null,
                [
                    'nullable' => false,
                ],
                'Adapter name'
            )
            ->addColumn(
                'adapter_code',
                Table::TYPE_TEXT,
                null,
                [
                    'nullable' => false,
                ],
                'Adapter code'
            )
            ->addColumn(
                'code',
                Table::TYPE_TEXT,
                null,
                [
                    'nullable' => false,
                ],
                'Channel code'
            )
            ->addColumn(
                'configuration_json',
                Table::TYPE_TEXT,
                null,
                [
                    'nullable' => false,
                ],
                'Configuration JSON'
            )
            ->addColumn(
                'enabled',
                Table::TYPE_BOOLEAN,
                null,
                [
                    'nullable' => false,
                ],
                'Enabled'
            );

        return $channelTable;
    }

    /**
     * @param SchemaSetupInterface $setup
     * @param Table $table
     * @return Table
     * @throws \Zend_Db_Exception
     */
    private function addIndexes(SchemaSetupInterface $setup, Table $table): Table
    {
        $table->addIndex(
            $setup->getIdxName(
                self::TABLE_NAME_CHANNEL,
                ['code'],
                AdapterInterface::INDEX_TYPE_UNIQUE
            ),
            [['name' => 'code', 'size' => 128]],
            ['type' => AdapterInterface::INDEX_TYPE_UNIQUE]
        );

        return $table;
    }
}
