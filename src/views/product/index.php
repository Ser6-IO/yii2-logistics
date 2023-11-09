<?php

use ser6io\yii2logistics\models\Product;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use ser6io\yii2bs5widgets\ActionColumn;
use ser6io\yii2bs5widgets\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var ser6io\yii2logistics\models\ProductSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <?= \ser6io\yii2bs5widgets\ToolBarWidget::widget([
        'title' => $this->title, 
        'groups' => [
            ['buttons' => ['create'], 'visible' => 'logisticsAdmin'],
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
            //'metadata',
            //'notes:ntext',
            //'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',
            //'isDeleted',
            [
                'class' => ActionColumn::className(),
                'template' => '{view}',
                'urlCreator' => function ($action, Product $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>

<?= \ser6io\yii2bs5widgets\ShowDeletedWidget::widget() ?>