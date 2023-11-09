<?php

use yii\bootstrap5\Html;
use ser6io\yii2bs5widgets\FieldView;
use ser6io\yii2bs5widgets\AddressCardWidget;

/** @var yii\web\View $this */
/** @var ser6io\yii2logistics\models\Shipment $model */

$this->title = "Shipment $model->id";
$this->params['breadcrumbs'][] = ['label' => 'Shipments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


//TODO: Move to Widget

$buttonCaption = $model::STATUS[$model->status];
$buttonColor = $model::STATUS_COLOR[$model->status];
$button = Html::button($buttonCaption, ['class' => "btn btn-$buttonColor dropdown-toggle", 'data-bs-toggle' => 'dropdown', 'aria-expanded' => 'false']);
$items = ['<li><h6 class="dropdown-header">Change to:</h6></li>'];
foreach ($model::STATUS as $key => $value) {
    $items[] = ['label' => $value, 'url' => ['set-status', 'id' => $model->id, 'status' => $key], 'linkOptions' => ['data-method' => 'post']];
}
array_splice($items, -1, 0, ['<li><hr class="dropdown-divider"></li>']);//Add divider before the last item
$dropDownMenu = \yii\bootstrap5\Dropdown::widget(['items' => $items]);

$buttonHtml = " <div class='btn-group'>{$button}{$dropDownMenu}</div>";


?>
<div class="shipment-view">

    <?= \ser6io\yii2bs5widgets\ToolBarWidget::widget([
        'title' => $this->title, 
        'groups' => [
            ['buttons' => [['html' => $buttonHtml]], 'visible' => 'logisticsAdmin'],
            ['buttons' => ['update', 'delete'], 'visible' => 'logisticsAdmin'],
        ],
        'id' => $model->id,
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