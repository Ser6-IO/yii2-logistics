<?php

namespace ser6io\yii2logistics;

use Yii;

/**
 * Logistics module definition class
 */
class Logistics extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'ser6io\yii2logistics\controllers';

     /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => \yii\filters\AccessControl::class,
                    'rules' => [ 
                        [
                            'actions' => ['index', 'view'],
                            'allow' => true,
                            'roles' => ['logisticsView'],
                        ],
                        [
                            'actions' => ['update', 'create', 'soft-delete', 'set-status', 'create-bulk'],
                            'allow' => true,
                            'roles' => ['logistics'],
                        ],
                        [
                            'actions' => ['restore', 'delete'],
                            'allow' => true,
                            'roles' => ['admin'],
                        ]
                    ],
                ],
                'verbs' => [
                    'class' => \yii\filters\VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

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
                ['label' => '<i class="bi bi-box-seam"></i> Logistics', 'url' => ['/logistics/main/index'], 'visible' => Yii::$app->user->can('logisticsView')],
                ['label' => '<i class="bi bi-boxes"></i> Part Numbers', 'url' => ['/logistics/part-number/index'], 'visible' => Yii::$app->user->can('logisticsView')],
                ['label' => '<i class="bi bi-truck"></i> Shipping', 'url' => ['/logistics/shipment/index'], 'visible' => Yii::$app->user->can('logisticsView')],
                ['label' => '<i class="bi bi-buildings"></i> Warehouses', 'url' => ['/logistics/warehouse/index'], 'visible' => Yii::$app->user->can('logisticsView')],
            ];
        }
    }

}
