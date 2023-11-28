<?php

use ser6io\yii2logistics\models\PartNumber;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use ser6io\yii2bs5widgets\ActionColumn;
use ser6io\yii2bs5widgets\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var ser6io\yii2logistics\models\PartNumberSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Part Numbers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="part-number-index">

    <?= \ser6io\yii2bs5widgets\ToolBarWidget::widget([
        'title' => $this->title, 
        'groups' => [
            ['buttons' => ['create'], 'visible' => Yii::$app->user->can('logistics')],
            ['buttons' => ['show-deleted'], 'visible' => Yii::$app->user->can('admin')],  
        ],
    ]) ?>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions'=>function($model){ return $model->isDeleted ? ['class' => 'bg-danger-subtle'] : null;},
        'columns' => [
            'name',
            'part_number',
            'mfg_part_number',
            //'vendor.nickname',
            'type',
            'subtype',
            //'category',
            //'subcategory',
            //'class',
            //'minor_HW_version',
            //'major_HW_version',
            ['class' => ActionColumn::className()],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
