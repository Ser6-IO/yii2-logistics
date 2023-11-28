<?php

use ser6io\yii2logistics\models\Warehouse;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use ser6io\yii2bs5widgets\ActionColumn;
use ser6io\yii2bs5widgets\GridView;

/** @var yii\web\View $this */
/** @var ser6io\yii2logistics\models\WarehouseSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Warehouses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="warehouse-index">

    <?= \ser6io\yii2bs5widgets\ToolBarWidget::widget([
        'title' => $this->title, 
        'groups' => [
            ['buttons' => ['create'], 'visible' => Yii::$app->user->can('logistics')],
            ['buttons' => ['show-deleted'], 'visible' => Yii::$app->user->can('admin')],  
        ],
    ]) ?>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions'=>function($model){ return $model->isDeleted ? ['class' => 'bg-danger-subtle'] : null;},
        'columns' => [
            'name',
            [
                'attribute' => 'address_id',
                'label' => 'Organization',
                'value' => function ($model) {
                    return $model->address->organization->nickname;
                }
            ],
            ['class' => ActionColumn::className()],
        ],
    ]); ?>


</div>
