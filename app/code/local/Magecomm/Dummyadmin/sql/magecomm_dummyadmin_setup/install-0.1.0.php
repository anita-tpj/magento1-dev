<?php

/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

try {
    $table = $installer->getConnection()
        ->newTable($installer->getTable('magecomm_dummyadmin/magecomm_dummyadmin_categories'))
        ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, 5, array(
                'auto_increment' => true,
                'unsigned' => true,
                'nullable' => false,
                'primary' => true,)
        )
        ->addColumn('name', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255)
        ->addColumn('image', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255)
    ;

    $installer->getConnection()->createTable($table);
} catch (Exception $e) {
    var_dump($e);
}

$installer->endSetup();