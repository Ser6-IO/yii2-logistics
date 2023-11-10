<?php

namespace ser6io\yii2logistics\models;

use yii\base\Model;

class ShipmentItemsBulk extends Model
{
    public $shipment_id;
    public $items;
    
    private $_itemsArray;
    private $_models;

    public $validated = false;

    public function rules()
    {
        return [
            [['shipment_id', 'items'], 'required'],
            [['shipment_id'], 'integer'],
            [['items'], 'safe'],
        ];
    }


    public function attributeLabels()
    {
        return [
            'shipment_id' => 'Shipment ID',
            'items' => 'Items',
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
     * Parse items string line by line and save to database
     */
    public function processItems()
    {
        $this->_itemsArray = preg_split("/[\s,]+/", $this->items);

        $this->_models = [];

        foreach ($this->_itemsArray as $key => $item) {
            $item = trim($item);
            $this->_models[] = new ShipmentItem([
                'shipment_id' => $this->shipment_id,
                'serial_number' => $item,
                'product_id' => $this->getProductId($item),
                'metadata' => '',
            ]);
        }
           
        //loadMultiple
        if (ShipmentItem::validateMultiple($this->_models)) {
            foreach ($this->_models as $key => $model) {
                $model->save(false);
            }
            $this->validated = true;
        }
    }

    /**
     * Gets product_id from serial_number
     */
    public function getProductId($serial_number)
    {
        //TODO: try to parse in a diffrent way, to match any product length, not 6 characters!!!!!!!
        //Find a Product by comparing the first 6 characters of the serial_number with the part_number
        $product = Product::find()
            ->where(['like', 'part_number', substr($serial_number, 0, 6)])
            ->one();

        if ($product) {
            return $product->id;
        } else {
            return 0;
        }
    }

    

    /**
     * Returns all errors from models as string
     */
    public function getMultipleErrors()
    {
        $errors = [];
        foreach ($this->_models as $key => $model) {
            $line = $key + 1;
            $errors[] = "Line $line: " . json_encode($model->getErrors());
        }
        return implode("<br>", $errors);
    }

    /**
     * Returns the total number of models
     */
    public function getCount()
    {
        return count($this->_models);
    }

    /**
     * Get items array
     */
    public function getStatus()
    {
        return implode("<br>", $this->_itemsArray) . "<br>--<br>" . json_encode($this->_models[0]->getErrors());
    }

}