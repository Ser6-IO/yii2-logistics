<?php

use ser6io\yii2logistics\models\ShipmentItem;
use ser6io\yii2logistics\models\Product;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use ser6io\yii2bs5widgets\ActionColumn;
use ser6io\yii2bs5widgets\GridView;

/** @var yii\web\View $this */
/** @var ser6io\yii2logistics\models\ShipmentItemSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
?>
<div class="shipment-item-index">

    <?= \ser6io\yii2bs5widgets\ToolBarWidget::widget([
        'title' => 'Items', 
        'groups' => [
            [
                'visible' => 'logisticsAdmin',
                'buttons' => [
                    ['label' => '<i class="bi bi-file-earmark-arrow-up"></i>', 'url' => ['/logistics/shipment-item/create-bulk', 's_id' => $shipment->id], 'options' => ['class' => 'btn btn-outline-info', 'data-bs-toggle' => 'tooltip', 'title' => 'Upload items']]
                ], 
            ],
        ],
    ]) ?>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'product_id',
                'filter' => Html::activeDropDownList($searchModel, 'product_id', ArrayHelper::map(Product::find()->asArray()->all(), 'id', 'name'), ['class' => 'form-control', 'prompt' => 'Search...']),
                'format' => 'raw',
                'label' => 'Product',
                'value' => function($model) {
                    if ($model->product) {
                        return $model->product->name;
                    } else {
                        return Html::tag('span', 'Not found', ['class' => 'badge bg-danger']);
                    }
                    
                }
            ],
            'serial_number',
            //'metadata',
            [
                'class' => ActionColumn::className(),
                'visible' => ($shipment->status == 0) and Yii::$app->user->can('logisticsAdmin') ? true : false,
                'template' => '{delete}',
                'urlCreator' => function ($action, ShipmentItem $model, $key, $index, $column) {
                    return Url::toRoute(["shipment-item/$action", 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
