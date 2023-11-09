<?php

use yii\bootstrap5\Html;
use ser6io\yii2bs5widgets\DetailView;

/** @var yii\web\View $this */
/** @var ser6io\yii2logistics\models\Warehouse $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Warehouses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="warehouse-view">

    <?= \ser6io\yii2bs5widgets\ToolBarWidget::widget([
        'title' => $this->title, 
        'isDeleted' => $model->isDeleted,
        'groups' => [
            ['buttons' => ['update', 'delete'], 'visible' => 'logisticsAdmin'],
        ],
        'id' => $model->id,
    ]) ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            [
                'attribute' => 'address_id',
                'label' => 'Organization',
                'value' => function ($model) {
                    return $model->address->organization->nickname;
                }
            ],
        ],
    ]) ?>

    <?= \ser6io\yii2bs5widgets\CreatedByWidget::widget(['model' => $model]) ?>

</div>
