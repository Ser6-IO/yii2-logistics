<?php

use yii\bootstrap5\Html;
use ser6io\yii2bs5widgets\ActiveForm;

$this->title = 'Upload Shipment Items';
$this->params['breadcrumbs'][] = ['label' => 'Shipments', 'url' => ['shipment/index']];
$this->params['breadcrumbs'][] = ['label' => "Shipment #$model->shipment_id", 'url' => ['shipment/view', 'id' => $model->shipment_id]];
$this->params['breadcrumbs'][] = $this->title;

?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="shipment-items-bulk-form">

    <?php $form = ActiveForm::begin(['layout' => \yii\bootstrap5\ActiveForm::LAYOUT_DEFAULT]); ?>

    <?= \yii\helpers\Html::activeHiddenInput($model, 'shipment_id') ?>

    <?= $form->field($model, 'items')->textarea(['rows' => 10])->hint('Type or Copy&Paste Serial Numbers, one per line.') ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="bi bi-file-earmark-arrow-up"></i> Upload', ['class' => 'btn btn-success mt-3']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>



