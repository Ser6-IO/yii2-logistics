<?php

use yii\bootstrap5\Html;
use ser6io\yii2bs5widgets\ActiveForm;
use ser6io\yii2bs5widgets\SearchModalWidget;

/** @var yii\web\View $this */
/** @var ser6io\yii2logistics\models\Warehouse $model */
/** @var yii\widgets\ActiveForm $form */

?>

<div class="warehouse-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    
    <?= SearchModalWidget::widget([
        'form' => $form,
        'model' => $model,
        'attribute' => 'address_id',
        //'label' => 'Organization',
        'searchUrl' => '/contacts/address/search-address-by-org-name',
        'createUrl' => '/contacts/contact/create',
    ]) ?>
        
    <div class="form-group">
        <?= Html::submitButton('<i class="bi bi-check-circle"></i> Save', ['class' => 'btn btn-success mt-3']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
