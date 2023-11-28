<?php

namespace ser6io\yii2logistics\controllers;

use Yii;
use ser6io\yii2logistics\models\ShipmentItem;
use ser6io\yii2logistics\models\ShipmentItemsBulk;
use ser6io\yii2logistics\models\ShipmentItemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ShipmentItemController implements the CRUD actions for ShipmentItem model.
 */
class ShipmentItemController extends Controller
{
    /**
     * Lists all ShipmentItem models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ShipmentItemSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates ShipmentItem(s) for a Shipment.
     * If creation is successful, the browser will be redirected to the Shipment 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreateBulk($s_id)
    {
        $model = new ShipmentItemsBulk();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) /*&& $model->save()*/) {

                $model->processItems();
    
                if (!$model->validated) {
                    Yii::$app->session->addFlash('danger', 'Error(s) uploading items:<br>' . $model->multipleErrors);
                } else {
                    Yii::$app->session->addFlash('info', "$model->count item(s) uploaded successfully.");
                }

                return $this->redirect(['shipment/view', 'id' => $s_id]);
            }
        } else {
            //$model->loadDefaultValues();
            $model->shipment_id = $s_id;
        }

        return $this->render('create-bulk', [
            'model' => $model,
        ]);
    }

    /**
     * Displays a single ShipmentItem model.
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
     * Creates a new ShipmentItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($s_id)
    {
        $model = new ShipmentItem();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
            $model->shipment_id = $s_id;
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ShipmentItem model.
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
     * Deletes an existing ShipmentItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();
        return $this->redirect(['shipment/view', 'id' => $model->shipment_id]);
    }

    /**
     * Finds the ShipmentItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return ShipmentItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ShipmentItem::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
