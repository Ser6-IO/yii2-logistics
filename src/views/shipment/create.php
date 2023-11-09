<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var ser6io\yii2logistics\models\Shipment $model */

$this->title = 'Create Shipment';
$this->params['breadcrumbs'][] = ['label' => 'Shipments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shipment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
