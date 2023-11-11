<?php

use yii\bootstrap5\Html;
use ser6io\yii2bs5widgets\DetailView;

/** @var yii\web\View $this */
/** @var ser6io\yii2logistics\models\ShipmentItem $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Shipment Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="shipment-item-view">

    <?= \ser6io\yii2bs5widgets\ToolBarWidget::widget([
        'title' => $this->title, 
        'groups' => [
            ['buttons' => ['update', 'delete'], /*'visible' => 'admin'*/],
        ],
        'id' => $model->id,
    ]) ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'shipment_id',
            'part_number_id',
            'serial_number',
            'metadata',
        ],
    ]) ?>

</div>
