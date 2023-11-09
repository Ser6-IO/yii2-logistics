<?php

namespace ser6io\yii2logistics\models;

use Yii;
use ser6io\yii2admin\models\User;
use ser6io\yii2contacts\models\Address;

/**
 * This is the model class for table "shipment".
 *
 * @property int $id
 * @property int $status
 * @property int|null $type
 * @property int $ship_to
 * @property int $ship_from
 * @property int $prepared_by
 * @property int $packed_by
 * @property int $shipped_by
 * @property int|null $shipping_date
 * @property int|null $carrier_id
 * @property string|null $carrier_account
 * @property string|null $tracking_url
 * @property string|null $tracking_number
 * @property string $customer_order_number
 * @property string $vendor_order_number
 * @property string $rma_number
 * @property string|null $notes
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 * @property int $isDeleted
 *
 * @property ShipmentItem[] $shipmentItems
 */
class Shipment extends \yii\db\ActiveRecord
{
    const STATUS = [
        0 => 'Draft',
        1 => 'Pending',
        2 => 'Shipped',
        3 => 'Received',
        4 => 'Cancelled',
    ];

    const STATUS_COLOR = [
        0 => 'secondary',
        1 => 'warning',
        2 => 'info',
        3 => 'success',
        4 => 'danger',
    ];

    const TYPE = [
        0 => 'ExWorks',
        1 => 'FOB',
        2 => 'CIF',
        3 => 'DDP',
        10 => 'Other'
    ];

    const CARRIER = [
        0 => 'UPS',
        1 => 'FedEx',
        2 => 'USPS',
        3 => 'DHL',
        4 => 'Other'
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shipment';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            \yii\behaviors\TimestampBehavior::class,
            'blameableBehavior' => [
                'class' => \yii\behaviors\BlameableBehavior::className(),
                'defaultValue' => '1',
            ],
            'softDeleteBehavior' => [
                'class' => \yii2tech\ar\softdelete\SoftDeleteBehavior::class,
                'softDeleteAttributeValues' => [
                    'isDeleted' => true
                ],
                //'replaceRegularDelete' => true
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'type', 'ship_to', 'ship_from', 'prepared_by', 'packed_by', 'shipped_by', 'carrier_id'], 'integer'],
            [['ship_to', 'ship_from', 'type', 'prepared_by'], 'required'],
            [['notes'], 'string'],
            [['carrier_account', 'tracking_url', 'customer_order_number', 'vendor_order_number', 'rma_number'], 'string', 'max' => 255],
            [['shipping_date'], 'default', 'value' => null],
            [['shipping_date'], 'date', 'format' => 'yyyy-MM-dd', 'timestampAttribute' => 'shipping_date'],
            ['tracking_number', 'url', 'defaultScheme' => 'https'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
            'type' => 'Type',
            'ship_to' => 'Ship To',
            'ship_from' => 'Ship From',
            'prepared_by' => 'Prepared By',
            'packed_by' => 'Packed By',
            'shipped_by' => 'Shipped By',
            'shipping_date' => 'Shipping Date',
            'carrier_id' => 'Carrier',
            'carrier_account' => 'Carrier Account',
            'tracking_url' => 'Tracking Url',
            'tracking_number' => 'Tracking Number',
            'customer_order_number' => 'Customer Order Number',
            'vendor_order_number' => 'Vendor Order Number',
            'rma_number' => 'RMA Number',
            'notes' => 'Notes',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'isDeleted' => 'Is Deleted',
        ];
    }

    /**
     * Gets query for [[ShipmentItems]].
     *
     * @return \yii\db\ActiveQuery|ShipmentItemQuery
     */
    public function getShipmentItems()
    {
        return $this->hasMany(ShipmentItem::class, ['shipment_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ShipmentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ShipmentQuery(get_called_class());
    }

    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    public function getUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }

    public function getShipTo()
    {
        return $this->hasOne(Address::class, ['id' => 'ship_to']);
    }

    public function getShipFrom()
    {
        return $this->hasOne(Address::class, ['id' => 'ship_from']);
    }

    public function getPreparedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }

    public function getPackedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }

    public function getShippedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }
           
}
