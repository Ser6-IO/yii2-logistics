<?php

namespace ser6io\yii2logistics\models;

/**
 * This is the ActiveQuery class for [[Shipment]].
 *
 * @see Shipment
 */
class ShipmentQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/
    public function behaviors()
    {
        return [
            'softDelete' => [
                'class' => \yii2tech\ar\softdelete\SoftDeleteQueryBehavior::class,
            ],
        ];
    }

    /**
     * {@inheritdoc}
     * @return Shipment[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Shipment|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
