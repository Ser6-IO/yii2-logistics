<?php

use yii\bootstrap5\Html;
use ser6io\yii2bs5widgets\ActiveForm;
use ser6io\yii2bs5widgets\SearchModalWidget;

use ser6io\yii2logistics\models\Shipment;
use ser6io\yii2admin\models\User;

/** @var yii\web\View $this */
/** @var ser6io\yii2logistics\models\Shipment $model */
/** @var yii\widgets\ActiveForm $form */

$userList = User::find()->where(['status' => User::STATUS_ACTIVE])->select(['username', 'id'])->indexBy('id')->column();

?>

<div class="shipment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php // $form->errorSummary($model) ?>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'type')->dropDownList(Shipment::TYPE) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'prepared_by')->dropDownList($userList) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'shipping_date')->input('date') ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <?= SearchModalWidget::widget([
                'form' => $form,
                'model' => $model,
                'attribute' => 'ship_from',
                'relation' => 'shipFrom',
                'label' => 'Ship from',
                'searchUrl' => '/contacts/address/search-address-by-org-name',
                'createUrl' => '/contacts/organization/create',
            ]) ?>
        </div>
        <div class="col-lg-6">
            <?= SearchModalWidget::widget([
                'form' => $form,
                'model' => $model,
                'attribute' => 'ship_to',
                'relation' => 'shipTo',
                'label' => 'Ship to',
                'searchUrl' => '/contacts/address/search-address-by-org-name',
                'createUrl' => '/contacts/organization/create',
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'carrier_id')->dropDownList(Shipment::CARRIER) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'carrier_account')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'shipped_by')->dropDownList($userList) ?>
        </div>
    </div>
 
    <div class="row g-3 mb-3">
        <div class="col-lg-3">
            <?= $form->field($model, 'tracking_number')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-9">
            <?= $form->field($model, 'tracking_url')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'customer_order_number')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'vendor_order_number')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'rma_number')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <?= $form->field($model, 'notes')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="bi bi-check-circle"></i> Save', ['class' => 'btn btn-success mt-3']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
