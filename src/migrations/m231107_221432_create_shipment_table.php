<?php

namespace ser6io\yii2logistics\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `{{%shipment}}`.
 */
class m231107_221432_create_shipment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%shipment}}', [
            'id' => $this->primaryKey(),
            'status' => $this->integer()->notNull()->defaultValue(0),

            'type' => $this->integer()->notNull(), //ExWorks, FOB, etc

            'ship_to' => $this->integer()->notNull(),
            'ship_from' => $this->integer()->notNull(),
            //save address as string after shipping?????????

            'prepared_by' => $this->integer()->notNull(),
            'packed_by' => $this->integer(),
            'shipped_by' => $this->integer(),
            'shipping_date' => $this->integer(),
            'carrier_id' => $this->integer(),
            'carrier_account' => $this->string(255),
            'tracking_url' => $this->string(255),
            'tracking_number' => $this->string(255),
            
            'customer_order_number' => $this->string(255),
            'vendor_order_number' => $this->string(255),
            'rma_number' => $this->string(255),

            'notes' => $this->text(),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
            'isDeleted' => $this->boolean()->notNull()->defaultValue(false),
        ]);

        $this->createTable('{{%shipment_item}}', [
            'id' => $this->primaryKey(),
            'shipment_id' => $this->integer()->notNull(),
            'part_number_id' => $this->integer()->notNull(),
            'serial_number' => $this->string(255),
            'metadata' => $this->json(),
        ]);

        //Define a secondary index on the shipment table by shipping_date
        $this->createIndex(
            'idx-shipment-shipping_date',
            '{{%shipment}}',
            'shipping_date'
        );
        
        //Define UNIQUE(id, shipment_id) for shipment_item table
        $this->createIndex(
            'idx-shipment_id-serial_number',
            '{{%shipment_item}}',
            ['shipment_id', 'serial_number'],
            true
        );

        //Define a secondary index on the shipment_item table by serial_number
        $this->createIndex(
            'idx-shipment_item-serial_number',
            '{{%shipment_item}}',
            'serial_number'
        );

        //Define a Foreign Key Constraint, so that if a shipment is deleted, all the shipment_items are deleted as well
        $this->addForeignKey(
            'fk-shipment_item-shipment_id',
            '{{%shipment_item}}',
            'shipment_id',
            '{{%shipment}}',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-shipment_item-shipment_id',
            '{{%shipment_item}}'
        );
        $this->dropIndex(
            'idx-shipment_item-serial_number',
            '{{%shipment_item}}'
        );
        $this->dropIndex(
            'idx-shipment_id-serial_number',
            '{{%shipment_item}}'
        );
        $this->dropIndex(
            'idx-shipment-shipping_date',
            '{{%shipment}}'
        );
        $this->dropTable('{{%shipment_item}}');
        $this->dropTable('{{%shipment}}');
    }
}
