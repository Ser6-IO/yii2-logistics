<?php

use ser6io\yii2logistics\models\Shipment;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use ser6io\yii2bs5widgets\ActionColumn;
use ser6io\yii2bs5widgets\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var ser6io\yii2logistics\models\ShipmentSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Shipments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shipment-index">

    <?= \ser6io\yii2bs5widgets\ToolBarWidget::widget([
        'title' => $this->title, 
        'groups' => [
            ['buttons' => ['create'], 'visible' => Yii::$app->user->can('logistics')],
            ['buttons' => ['show-deleted'], 'visible' => Yii::$app->user->can('admin')],  
        ],
    ]) ?>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions'=>function($model){ return $model->isDeleted ? ['class' => 'bg-danger-subtle'] : null;},
        'columns' => [
            [
                'attribute' => 'shipping_date',
                'format' => 'date', //['date', 'php:Y-m-d'],
                'filterInputOptions' => [
                    'type' => 'date', 
                    'class' => 'form-control',
                ]
            ],
            [
                'attribute' => 'status',
                'format' => 'raw',
                'filter' => Shipment::STATUS,
                'value' => function($model) {
                    $status = Shipment::STATUS[$model->status];
                    $statusColor = Shipment::STATUS_COLOR[$model->status];
                    return Html::tag('span', $status, ['class' => "badge bg-$statusColor"]);
                }
            ],
            'shipFrom.organization.nickname:text:From',
            'shipTo.organization.nickname:text:To',
            [
                'label' => 'Item Qty',
                'value' => function($model) {
                    return $model->getShipmentItems()->count();
                }
            ],
            //'type',
            //'ship_from',
            //'prepared_by',
            
            //'carrier_id',
            //'carrier_account',
            //'tracking_url:url',
            //'tracking_number',
            //'customer_order_number',
            //'vendor_order_number',
            //'rma_number',
            
            ['class' => ActionColumn::className()],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
