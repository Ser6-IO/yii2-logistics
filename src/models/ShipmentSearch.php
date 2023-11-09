<?php

namespace ser6io\yii2logistics\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use ser6io\yii2logistics\models\Shipment;

/**
 * ShipmentSearch represents the model behind the search form of `ser6io\yii2logistics\models\Shipment`.
 */
class ShipmentSearch extends Shipment
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'type', 'ship_to', 'ship_from', 'prepared_by', 'packed_by', 'shipped_by', 'carrier_id', 'created_at', 'updated_at', 'created_by', 'updated_by', 'isDeleted'], 'integer'],
            [['carrier_account', 'tracking_url', 'tracking_number', 'customer_order_number', 'vendor_order_number', 'rma_number', 'notes'], 'safe'],
            [['shipping_date'], 'date', 'format' => 'php:Y-m-d'],
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
        $query = Shipment::find()->filterDeleted(Yii::$app->request->get('filter_deleted'));

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
            'status' => $this->status,
            'type' => $this->type,
            'ship_to' => $this->ship_to,
            'ship_from' => $this->ship_from,
            'prepared_by' => $this->prepared_by,
            'packed_by' => $this->packed_by,
            'shipped_by' => $this->shipped_by,
            
            'carrier_id' => $this->carrier_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'isDeleted' => $this->isDeleted,
        ]);

        $query->andFilterWhere(['=', 'FROM_UNIXTIME(shipping_date, "%Y-%m-%d")', $this->shipping_date]);

        $query->andFilterWhere(['like', 'carrier_account', $this->carrier_account])
            ->andFilterWhere(['like', 'tracking_url', $this->tracking_url])
            ->andFilterWhere(['like', 'tracking_number', $this->tracking_number])
            ->andFilterWhere(['like', 'customer_order_number', $this->customer_order_number])
            ->andFilterWhere(['like', 'vendor_order_number', $this->vendor_order_number])
            ->andFilterWhere(['like', 'rma_number', $this->rma_number])
            ->andFilterWhere(['like', 'notes', $this->notes]);

        return $dataProvider;
    }
}
