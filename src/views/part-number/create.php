<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var ser6io\yii2logistics\models\PartNumber $model */

$this->title = 'Create Part Number';
$this->params['breadcrumbs'][] = ['label' => 'Part Numbers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="part-number-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
