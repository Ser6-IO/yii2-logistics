<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var ser6io\yii2logistics\models\ShipmentItem $model */

$this->title = 'Create Shipment Item';
$this->params['breadcrumbs'][] = ['label' => 'Shipment Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shipment-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
