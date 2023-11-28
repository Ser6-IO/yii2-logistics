<?php

namespace ser6io\yii2logistics\controllers;

use ser6io\yii2logistics\models\PartNumber;
use ser6io\yii2logistics\models\PartNumberSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * PartNumberController implements the CRUD actions for PartNumber model.
 */
class PartNumberController extends Controller
{
    public function actions()
    {
        return [
            'soft-delete' => [
                'class' => 'ser6io\yii2admin\components\SoftDeleteAction',
                'modelClass' => 'ser6io\yii2logistics\models\PartNumber',
            ],
            'delete' => [
                'class' => 'ser6io\yii2admin\components\DeleteAction',
                'modelClass' => 'ser6io\yii2logistics\models\PartNumber',
            ],
            'restore' => [
                'class' => 'ser6io\yii2admin\components\RestoreAction',
                'modelClass' => 'ser6io\yii2logistics\models\PartNumber',
            ],
        ];
    }

    /**
     * Lists all PartNumber models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PartNumberSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PartNumber model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new PartNumber model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new PartNumber();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PartNumber model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the PartNumber model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return PartNumber the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PartNumber::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
