<?php

namespace ser6io\yii2logistics\controllers;

use yii\web\Controller;
//use ser6io\yii2contacts\models\Person;


/**
 * Main controller for the `Contacts` module
 */
class MainController extends Controller
{
    public $layout = 'secondary';

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
                            'actions' => ['index'],
                            'allow' => true,
                            'roles' => ['logisticsView'],
                        ],   
                    ],
                ],
            ]
        );
    }

    /**
     * Renders the index view for the Admin controller
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index', [
            //'people' => Person::find()->notDeleted()->count(),
        ]);
    }
}
