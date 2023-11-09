<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var ser6io\yii2logistics\models\ShipmentItem $model */

$this->title = 'Update Shipment Item: ' . $model->id;


$this->params['breadcrumbs'][] = ['label' => 'Shipments', 'url' => ['shipment/index']];
$this->params['breadcrumbs'][] = ['label' => "Shipment #$model->shipment_id", 'url' => ['shipment/view', 'id' => $model->shipment_id]];
$this->params['breadcrumbs'][] = 'Update Item';
?>
<div class="shipment-item-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
