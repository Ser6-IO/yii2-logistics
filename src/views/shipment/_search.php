<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var ser6io\yii2logistics\models\ShipmentSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="shipment-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'ship_to') ?>

    <?= $form->field($model, 'ship_from') ?>

    <?php // echo $form->field($model, 'prepared_by') ?>

    <?php // echo $form->field($model, 'packed_by') ?>

    <?php // echo $form->field($model, 'shipped_by') ?>

    <?php // echo $form->field($model, 'shipping_date') ?>

    <?php // echo $form->field($model, 'carrier_id') ?>

    <?php // echo $form->field($model, 'carrier_account') ?>

    <?php // echo $form->field($model, 'tracking_url') ?>

    <?php // echo $form->field($model, 'tracking_number') ?>

    <?php // echo $form->field($model, 'customer_order_number') ?>

    <?php // echo $form->field($model, 'vendor_order_number') ?>

    <?php // echo $form->field($model, 'rma_number') ?>

    <?php // echo $form->field($model, 'notes') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'isDeleted') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
