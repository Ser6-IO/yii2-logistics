<?php

use yii\bootstrap5\Html;
use ser6io\yii2bs5widgets\DetailView;

/** @var yii\web\View $this */
/** @var ser6io\yii2logistics\models\Product $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

    <?= \ser6io\yii2bs5widgets\ToolBarWidget::widget([
        'title' => $this->title, 
        'groups' => [
            ['buttons' => ['update', 'delete'], 'visible' => 'logisticsAdmin'],
        ],
        'id' => $model->id,
    ]) ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'part_number',
            'mfg_part_number',
            'vendor_id',
            'type',
            'subtype',
            'category',
            'subcategory',
            'class',
            'minor_HW_version',
            'major_HW_version',
            [
                'attribute' => 'metadata',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->metadata) {
                        $metadata = array_filter($model->metadata);
                        $metadata = array_map(function ($value, $key) {
                            return Html::tag('div', Html::tag('strong', $key) . ': ' . $value);
                        }, $metadata, array_keys($metadata));
                        return implode('', $metadata);
                    } else {
                        return null;
                    }
                }
            ],
            'notes:ntext',
        ],
    ]) ?>

    <?= \ser6io\yii2bs5widgets\CreatedByWidget::widget(['model' => $model]) ?>

</div>
