<?php

namespace ser6io\yii2logistics\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m231107_195404_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),

            'name' => $this->string(255)->notNull(),
            'part_number' => $this->string(255)->notNull(),
            'mfg_part_number' => $this->string(255)->notNull(),
            'vendor_id' => $this->integer(),
            'status' => $this->integer()->notNull()->defaultValue(0),

            'type' => $this->integer(), //DTM, PDTM
            'subtype' => $this->integer(), //GP, Flex...
            
            'category' => $this->integer(), //CELLULAR
            'subcategory' => $this->integer(), //ATT, VZW, etc

            'comms_type' => $this->string(20), //CELLULAR, WIFI, BT, etc
            
            'class' => $this->integer(), //ATI, GFS

            'variation' => $this->string(20), //Color, Size, etc

            'minor_HW_version' => $this->string(255),
            'major_HW_version' => $this->string(255),

            'metadata' => $this->json(),
            'notes' => $this->text(),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
            'isDeleted' => $this->boolean()->notNull()->defaultValue(false),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product}}');
    }
}
