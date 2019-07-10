<?php

/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

/**
 * Create table 'magecomm_dummyadmin_categories'
 */

try {
    $table = $installer->getConnection()

        ->newTable($installer->getTable('magecomm_dummyadmin/magecomm_dummyadmin_categories'))
        ->addColumn('category_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
            'identity' => true,
            'unsigned' => true,
            'nullable' => false,
            'primary'  => true),
            'Category id')
        ->addColumn('category_url', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => false
        ), 'Category url')
        ->addColumn('category_name', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => false
        ), 'Category title')
        ->addColumn('category_image', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true
        ), 'Category default image')
    ;

    $installer->getConnection()->createTable($table);
} catch (Exception $e) {
    Mage::logException($e);
}

/**
 * Create table 'resource_center_posts'
 */

try {
    $table = $installer->getConnection()
        ->newTable($installer->getTable('magecomm_dummyadmin/magecomm_dummyadmin_posts'))
        ->addColumn('post_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
            'identity' => true,
            'unsigned' => true,
            'nullable' => false,
            'primary'  => true),
            'Post id')
        ->addColumn('post_name', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => false
        ), 'Post title')
        ->addColumn('post_url', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => false
        ), 'Post url')
        ->addColumn('post_image', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true
        ), 'Post default image')
        ->addColumn('post_content', Varien_Db_Ddl_Table::TYPE_TEXT, '2M', array(
            'nullable' => false,
        ), 'Post content')
        ->addColumn('post_short_content', Varien_Db_Ddl_Table::TYPE_TEXT, '1M', array(
            'nullable' => true,
        ), 'Intro text')
        ->addColumn('post_meta_title', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => false
        ), 'Post meta title')
        ->addColumn('post_active', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
            'nullable' => false
        ), 'Post status')
    ;


    $installer->getConnection()->createTable($table);

} catch (Exception $e) {
    Mage::logException($e);
}

$installer->endSetup();