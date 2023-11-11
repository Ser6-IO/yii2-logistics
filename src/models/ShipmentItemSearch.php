<?php

namespace ser6io\yii2logistics\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use ser6io\yii2logistics\models\ShipmentItem;

/**
 * ShipmentItemSearch represents the model behind the search form of `ser6io\yii2logistics\models\ShipmentItem`.
 */
class ShipmentItemSearch extends ShipmentItem
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'shipment_id', 'part_number_id'], 'integer'],
            [['serial_number', 'metadata'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ShipmentItem::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'shipment_id' => $this->shipment_id,
            'part_number_id' => $this->part_number_id,
        ]);

        $query->andFilterWhere(['like', 'serial_number', $this->serial_number])
            ->andFilterWhere(['like', 'metadata', $this->metadata]);

        return $dataProvider;
    }
}
