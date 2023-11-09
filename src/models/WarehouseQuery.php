<?php

namespace ser6io\yii2logistics\models;

/**
 * This is the ActiveQuery class for [[Warehouse]].
 *
 * @see Warehouse
 */
class WarehouseQuery extends \yii\db\ActiveQuery
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
     * @return Warehouse[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Warehouse|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
