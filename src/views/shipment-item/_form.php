<?php

use yii\bootstrap5\Html;
use ser6io\yii2bs5widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var ser6io\yii2logistics\models\ShipmentItem $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="shipment-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'shipment_id')->textInput() ?>

    <?= $form->field($model, 'product_id')->textInput() ?>

    <?= $form->field($model, 'serial_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'metadata')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="bi bi-check-circle"></i> Save', ['class' => 'btn btn-success mt-3']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
