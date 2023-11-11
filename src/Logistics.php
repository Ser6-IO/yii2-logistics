<?php

namespace ser6io\yii2logistics;

use Yii;

/**
 * Logistics module definition class
 */
class Logistics extends \yii\base\Module
{
    public $initAction;
    
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'ser6io\yii2logistics\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        $this->defaultRoute = 'main';

        $this->layoutPath = '@app/views/layouts';

        $this->layout = 'secondary';

        //Secondary Menu items - must use two columns layout
        if (Yii::$app instanceof \yii\web\Application) {
            Yii::$app->params['secondaryMenu'] = [                
                ['label' => '<i class="bi bi-box-seam"></i> Main', 'url' => ['/logistics/main/index'], 'visible' => Yii::$app->user->can('logisticsView')],
                ['label' => '<i class="bi bi-boxes"></i> Part Numbers', 'url' => ['/logistics/part-number/index'], 'visible' => Yii::$app->user->can('logisticsView')],
                ['label' => '<i class="bi bi-truck"></i> Shipping', 'url' => ['/logistics/shipment/index'], 'visible' => Yii::$app->user->can('logisticsView')],
                ['label' => '<i class="bi bi-buildings"></i> Warehouses', 'url' => ['/logistics/warehouse/index'], 'visible' => Yii::$app->user->can('logisticsView')],
            ];
        }
    }

}
