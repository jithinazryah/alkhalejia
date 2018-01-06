<?php

namespace backend\modules\appointment\controllers;

use Yii;
use common\models\Appointment;
use common\models\AppointmentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use common\models\AppointmentDetails;

/**
 * AppointmentController implements the CRUD actions for Appointment model.
 */
class AppointmentController extends Controller {

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
         * Lists all Appointment models.
         * @return mixed
         */
        public function actionIndex() {
                $searchModel = new AppointmentSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
        }

        /**
         * Displays a single Appointment model.
         * @param integer $id
         * @return mixed
         */
        public function actionView($id) {
                return $this->render('view', [
                            'model' => $this->findModel($id),
                ]);
        }

        /**
         * Creates a new Appointment model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
        public function actionCreate() {
                $model = new Appointment();
                if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
                        $image = UploadedFile::getInstances($model, 'image');
                        $model->date = date('Y-m-d', strtotime($model->date));
                        $model->eta = date('Y-m-d h:i:s', strtotime($model->date));
                        $model->appointment_number = 'demo';
                        if ($model->save()) {
                                if (!empty($image)) {
                                        $root_path = ['appointment', $model->id];
                                        Yii::$app->UploadFile->UploadSingle($image, $model, $root_path);
                                }
                                $model = $this->findModel($model->id);
                                $appointment_number = \common\models\Ships::findOne($model->vessel)->code;
                                $model->appointment_number = $appointment_number . $model->id;
                                $model->save();


                                return $this->redirect(['add', 'id' => $model->id]);
                        }
                } else {
                        return $this->render('create', [
                                    'model' => $model,
                        ]);
                }
        }

        public function actionAdd($id, $prfrma_id = NULL) {

                if (!isset($prfrma_id)) {
                        $model = new AppointmentDetails;
                } else {
                        $model = AppointmentDetails::findOne($prfrma_id);
                }
                $estimates = AppointmentDetails::findAll(['appointment_id' => $id]);
                $appointment = Appointment::findOne($id);
                if ($model->load(Yii::$app->request->post())) {
                        $model->appointment_id = $id;
                        if ($model->save()) {
                                return $this->redirect(['add', 'id' => $id]);
                        }
                }

                return $this->render('add', [
                            'model' => $model,
                            'estimates' => $estimates,
                            'appointment' => $appointment,
                            'id' => $id,
                ]);
        }

        public function actionDeleteDetail($id) {
                AppointmentDetails::findOne($id)->delete();
                return $this->redirect(Yii::$app->request->referrer);
        }

        /**
         * Updates an existing Appointment model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id
         * @return mixed
         */
        public function actionUpdate($id) {
                $model = $this->findModel($id);

                if ($model->load(Yii::$app->request->post())) {
                        $model->date = date('Y-m-d', strtotime($model->date));
                        $model->eta = date('Y-m-d h:i:s', strtotime($model->eta));
                        $image = UploadedFile::getInstances($model, 'image');
                        if (!empty($image)) {
                                $root_path = ['appointment', $model->id];
                                Yii::$app->UploadFile->UploadSingle($image, $model, $root_path);
                        }
                        $model->save();
                        return $this->redirect(['index']);
                } else {
                        return $this->render('update', [
                                    'model' => $model,
                        ]);
                }
        }

        /**
         * Deletes an existing Appointment model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         */
        public function actionDelete($id) {
                $this->findModel($id)->delete();

                return $this->redirect(['index']);
        }

        /**
         * Finds the Appointment model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return Appointment the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id) {
                if (($model = Appointment::findOne($id)) !== null) {
                        return $model;
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.');
                }
        }

        public function actionSupplier() {

                if (Yii::$app->request->isAjax) {
                        $service_id = $_POST['service_id'];
                        if ($service_id == 1) {
                                $materials = \common\models\Materials::find()->where(['status' => 1])->all();
                                $options = '<option value="">-Materials-</option>';
                                foreach ($materials as $materials) {
                                        $options .= "<option value='" . $materials->id . "'>" . $materials->name . "</option>";
                                }
                        } else {
                                $suppliers = \common\models\Contacts::find()->where(['status' => 1])->all();
                                $options = '<option value="">-Supplier-</option>';
                                foreach ($suppliers as $supplier_data) {
                                        $options .= "<option value='" . $supplier_data->id . "'>" . $supplier_data->name . "</option>";
                                }
                        }
                        echo $options;
                }
        }

}
