<?php

use yii\bootstrap5\Html;
use ser6io\yii2bs5widgets\FieldView;
use ser6io\yii2bs5widgets\AddressCardWidget;
use ser6io\yii2bs5widgets\StatusButtonWidget;

/** @var yii\web\View $this */
/** @var ser6io\yii2logistics\models\Shipment $model */

$this->title = "Shipment $model->id";
$this->params['breadcrumbs'][] = ['label' => 'Shipments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$statusButton = StatusButtonWidget::widget([
    'model' => $model,
    'caption' => $model::STATUS[$model->status],
    'header' => 'Change to:',
    'color' => $model::STATUS_COLOR[$model->status],
    'disabled' => $model->isDeleted,
    'items' => $model::STATUS,
]);

?>
<div class="shipment-view">

    <?= \ser6io\yii2bs5widgets\ToolBarWidget::widget([
        'title' => $this->title, 
        'id' => $model->id,
        'isDeleted' => $model->isDeleted,
        'groups' => [
            ['buttons' => [['html' => $statusButton]], 'visible' => Yii::$app->user->can('logistics')],
            ['buttons' => ['update', 'soft-delete'], 'visible' => Yii::$app->user->can('logistics')],
            ['buttons' => ['restore'], 'visible' => Yii::$app->user->can('admin')],
        ],
    ]) ?>

    <?= \ser6io\yii2bs5widgets\CreatedByWidget::widget(['model' => $model]) ?>

    <div class="row g-3 mb-3">
        <div class="col-md-4">
            <?= FieldView::widget(['model' => $model, 'attribute' => 'type', 'list' => $model::TYPE]) ?>
        </div>
        <div class="col-md-4">
            <?= FieldView::widget(['model' => $model->preparedBy, 'attribute' => 'email', 'label' => 'Prepared by']) ?>
        </div>
        <div class="col-md-4">
            <?= FieldView::widget(['model' => $model, 'attribute' => 'shipping_date', 'format' => 'date']) ?>
        </div>
    </div>

    <div class="row g-3 mb-3">
        <div class="col-lg-6">
            <?= AddressCardWidget::widget(['model' => $model->shipFrom, 'attribute' => 'ship_from', 'label' => 'From']) ?>
        </div>
        <div class="col-lg-6">
            <?= AddressCardWidget::widget(['model' => $model->shipTo, 'attribute' => 'ship_to', 'label' => 'To']) ?>
        </div>
    </div>

    <div class="row g-3 mb-3">
        <div class="col-md-4">
            <?= FieldView::widget(['model' => $model, 'attribute' => 'carrier_id', 'list' => $model::CARRIER]) ?>
        </div>
        <div class="col-md-4">
            <?= FieldView::widget(['model' => $model, 'attribute' => 'carrier_account']) ?>
        </div>
        <div class="col-md-4">
            <?= FieldView::widget(['model' => $model->shippedBy, 'attribute' => 'email', 'label' => 'Shipped by']) ?>
        </div>
    </div>

    <div class="row g-3 mb-3">
        <div class="col-lg-3">
            <?= FieldView::widget(['model' => $model, 'attribute' => 'tracking_number']) ?>
        </div>
        <div class="col-lg-9">
            <?= FieldView::widget(['model' => $model, 'attribute' => 'tracking_url', 'format' => 'url']) ?>
        </div>
    </div>
    
    <div class="row g-3 mb-3">
        <div class="col-md-4">
            <?= FieldView::widget(['model' => $model, 'attribute' => 'vendor_order_number']) ?>
        </div>
        <div class="col-md-4">
            <?= FieldView::widget(['model' => $model, 'attribute' => 'customer_order_number']) ?>
        </div>
        <div class="col-md-4">
            <?= FieldView::widget(['model' => $model, 'attribute' => 'rma_number']) ?>
        </div>
    </div>

</div>

<?= $this->render('../shipment-item/index', [
    'searchModel' => $itemSearchModel,
    'dataProvider' => $itemDataProvider,
    'shipment' => $model,
]) ?>

<br>
<?= FieldView::widget(['model' => $model, 'attribute' => 'notes', 'format' => 'ntext']) ?>