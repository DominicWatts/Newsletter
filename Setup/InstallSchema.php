<?php


namespace PixieMedia\Newsletter\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * InstallSchema class
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $installer = $setup;
        $installer->startSetup();
        $connection = $installer->getConnection();
        if ($connection->tableColumnExists('newsletter_subscriber', 'name') === false) {
            $connection
                ->addColumn(
                    $setup->getTable('newsletter_subscriber'),
                    'name',
                    [
                        'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        'length' => 100,
                        'comment' => 'Name'
                    ]
                );
        }
        $installer->endSetup();
    }
}
