<?php

namespace ser6io\yii2logistics\controllers;

use yii\web\Controller;
use ser6io\yii2logistics\models\PartNumber;
use ser6io\yii2logistics\models\Shipment;
use ser6io\yii2logistics\models\Warehouse;

/**
 * Main controller for the `Contacts` module
 */
class MainController extends Controller
{
    /**
     * Renders the index view for the Admin controller
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index', [
            'partNumbers' => PartNumber::find()->notDeleted()->count(),
            'shipments' => Shipment::find()->notDeleted()->count(),
            'warehouses' => Warehouse::find()->notDeleted()->count(),
        ]);
    }
}
