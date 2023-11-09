<?php

namespace ser6io\yii2logistics\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use ser6io\yii2logistics\models\Product;

/**
 * ProductSearch represents the model behind the search form of `ser6io\yii2logistics\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'vendor_id', 'type', 'subtype', 'category', 'subcategory', 'class', 'created_at', 'updated_at', 'created_by', 'updated_by', 'isDeleted'], 'integer'],
            [['name', 'part_number', 'mfg_part_number', 'minor_HW_version', 'major_HW_version', 'metadata', 'notes'], 'safe'],
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
        $query = Product::find()->filterDeleted(Yii::$app->request->get('filter_deleted'));

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
            'vendor_id' => $this->vendor_id,
            'type' => $this->type,
            'subtype' => $this->subtype,
            'category' => $this->category,
            'subcategory' => $this->subcategory,
            'class' => $this->class,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'isDeleted' => $this->isDeleted,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'part_number', $this->part_number])
            ->andFilterWhere(['like', 'mfg_part_number', $this->mfg_part_number])
            ->andFilterWhere(['like', 'minor_HW_version', $this->minor_HW_version])
            ->andFilterWhere(['like', 'major_HW_version', $this->major_HW_version])
            ->andFilterWhere(['like', 'metadata', $this->metadata])
            ->andFilterWhere(['like', 'notes', $this->notes]);

        return $dataProvider;
    }
}
