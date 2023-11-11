<?php

use yii\bootstrap5\Html;
use ser6io\yii2bs5widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var ser6io\yii2logistics\models\PartNumber $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="part-number-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'part_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mfg_part_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vendor_id')->textInput() ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'subtype')->textInput() ?>

    <?= $form->field($model, 'category')->textInput() ?>

    <?= $form->field($model, 'subcategory')->textInput() ?>

    <?= $form->field($model, 'class')->textInput() ?>

    <?= $form->field($model, 'minor_HW_version')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'major_HW_version')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'notes')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="bi bi-check-circle"></i> Save', ['class' => 'btn btn-success mt-3']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
