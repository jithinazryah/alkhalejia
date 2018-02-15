<?php

namespace backend\modules\notification\controllers;

use Yii;
use common\models\ChequeNotification;
use common\models\ChequeNotificationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ChequeNotificationController implements the CRUD actions for ChequeNotification model.
 */
class ChequeNotificationController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all ChequeNotification models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ChequeNotificationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ChequeNotification model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ChequeNotification model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new ChequeNotification();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ChequeNotification model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ChequeNotification model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ChequeNotification model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ChequeNotification the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = ChequeNotification::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionUpdateNotification() {
        if (Yii::$app->request->isAjax) {
            $id = $_POST['id'];
            $notification = \common\models\ChequeNotification::findOne(['id' => $id]);
            $notification->status = 0;
            $notification->save();
            $notifications = \common\models\ChequeNotification::find()->where(['status' => 1])->orderBy(['id' => SORT_DESC])->limit(10)->all();
            $count = count($notifications);
            $i = 0;
            if ($count >= 10) {
                foreach ($notifications as $value) {
                    $i++;
                    if ($i == $count) {
                        $arr_variable = array('id' => $value->id, 'content' => $value->content, 'date' => $value->date, 'appointment_id' => $value->appointment_id);
                        $data['result'] = $arr_variable;
                        echo json_encode($data);
                    }
                }
            } else {
                echo 1;
                exit;
            }
        }
    }

}
