<?php

namespace ser6io\yii2logistics\models;

use Yii;

/**
 * This is the model class for table "shipment_item".
 *
 * @property int $id
 * @property int $shipment_id
 * @property int $part_number_id
 * @property string|null $serial_number
 * @property string|null $metadata
 *
 * @property Shipment $shipment
 */
class ShipmentItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shipment_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['shipment_id', 'part_number_id'], 'required'],
            [['shipment_id', 'part_number_id'], 'integer'],
            [['metadata'], 'safe'],
            [['serial_number'], 'string', 'max' => 255],
            [['shipment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Shipment::class, 'targetAttribute' => ['shipment_id' => 'id']],
            [['serial_number'], 'unique', 'targetAttribute' => ['shipment_id', 'serial_number'], 'message' => 'Serial Number can not be repeated in the same Shipment.'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'shipment_id' => 'Shipment ID',
            'part_number_id' => 'Part Number ID',
            'serial_number' => 'Serial Number',
            'metadata' => 'Metadata',
        ];
    }

    /**
     * Gets query for [[Shipment]].
     *
     * @return \yii\db\ActiveQuery|ShipmentQuery
     */
    public function getShipment()
    {
        return $this->hasOne(Shipment::class, ['id' => 'shipment_id']);
    }

    /**
     * Gets query for [[PartNumber]].
     */
    public function getPartNumber()
    {
        return $this->hasOne(PartNumber::class, ['id' => 'part_number_id']);
    }

    /**
     * {@inheritdoc}
     * @return ShipmentItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ShipmentItemQuery(get_called_class());
    }
}
