<?php

namespace ser6io\yii2logistics\controllers;

use ser6io\yii2logistics\models\Shipment;
use ser6io\yii2logistics\models\ShipmentSearch;
use ser6io\yii2logistics\models\ShipmentItemSearch;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ShipmentController implements the CRUD actions for Shipment model.
 */
class ShipmentController extends Controller
{
    public function actions()
    {
        return [
            'soft-delete' => [
                'class' => 'ser6io\yii2admin\components\SoftDeleteAction',
                'modelClass' => 'ser6io\yii2logistics\models\Shipment',
            ],
            'delete' => [
                'class' => 'ser6io\yii2admin\components\DeleteAction',
                'modelClass' => 'ser6io\yii2logistics\models\Shipment',
            ],
            'restore' => [
                'class' => 'ser6io\yii2admin\components\RestoreAction',
                'modelClass' => 'ser6io\yii2logistics\models\Shipment',
            ],
        ];
    }

    /**
     * Lists all Shipment models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ShipmentSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Shipment model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $itemSearchModel = new ShipmentItemSearch();
        $itemDataProvider = $itemSearchModel->search($this->request->queryParams);

        //Filter by shipment_id
        $itemDataProvider->query->andWhere(['shipment_id' => $id]);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'itemSearchModel' => $itemSearchModel,
            'itemDataProvider' => $itemDataProvider,
        ]);
    }

    /**
     * Creates a new Shipment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Shipment();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
            $model->prepared_by = \Yii::$app->user->id;
            $model->shipped_by = \Yii::$app->user->id;
            $model->shipping_date = date('Y-m-d');
            //$model->ship_from = 1;
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Shipment model.
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

        if ($model->shipping_date)
            $model->shipping_date = date('Y-m-d', $model->shipping_date);

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Shipment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->softDelete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Shipment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Shipment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Shipment::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Sets the status of a Shipment model.
     * If status is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @param int $status Status
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionSetStatus($id, $status)
    {
        $model = $this->findModel($id);
        $model->status = $status;
        $model->save();

        return $this->redirect(['view', 'id' => $model->id]);
    }
}
