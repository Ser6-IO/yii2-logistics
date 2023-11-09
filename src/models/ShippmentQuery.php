<?php

namespace ser6io\yii2logistics\models;

/**
 * This is the ActiveQuery class for [[Shippment]].
 *
 * @see Shippment
 */
class ShippmentQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Shippment[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Shippment|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
