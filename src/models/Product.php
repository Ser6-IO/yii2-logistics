<?php

namespace ser6io\yii2logistics\models;

use Yii;
use ser6io\yii2admin\models\User;
use ser6io\yii2contacts\models\Organization;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $name
 * @property string $part_number
 * @property string $mfg_part_number
 * @property int|null $vendor_id
 * @property int $status
 * @property int|null $type
 * @property int|null $subtype
 * @property int|null $category
 * @property int|null $subcategory
 * @property string|null $comms_type
 * @property int|null $class
 * @property string|null $variation 
 * @property string|null $minor_HW_version
 * @property string|null $major_HW_version
 * @property string|null $metadata
 * @property string|null $notes
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 * @property int $isDeleted
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
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
            [['name', 'part_number', 'mfg_part_number'], 'required'],
            [['vendor_id', 'status', 'type', 'subtype', 'category', 'subcategory', 'class'], 'integer'],
            [['metadata'], 'safe'],
            [['notes'], 'string'],
            [['name', 'part_number', 'mfg_part_number', 'minor_HW_version', 'major_HW_version'], 'string', 'max' => 255],
            [['comms_type', 'variation'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'part_number' => 'Part Number',
            'mfg_part_number' => 'Mfg Part Number',
            'vendor_id' => 'Vendor ID',
            'status' => 'Status',
            'type' => 'Type',
            'subtype' => 'Subtype',
            'category' => 'Category',
            'subcategory' => 'Subcategory',
            'comms_type' => 'Communications Type',
            'class' => 'Class',
            'variation' => 'Variation',
            'minor_HW_version' => 'Minor Hw Version',
            'major_HW_version' => 'Major Hw Version',
            'metadata' => 'Metadata',
            'notes' => 'Notes',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'isDeleted' => 'Is Deleted',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductQuery(get_called_class());
    }

    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    public function getUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }

    public function getVendor()
    {
        return $this->hasOne(Organization::class, ['id' => 'vendor_id']);
    }
}
