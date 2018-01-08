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

        /*
         * Add services to appointment
         */

        public function actionAdd($id, $prfrma_id = NULL) {

                if (!isset($prfrma_id)) {
                        $model = new AppointmentDetails;
                } else {
                        $model = AppointmentDetails::findOne($prfrma_id);
                }
                $estimates = AppointmentDetails::findAll(['appointment_id' => $id]);
                $services = \common\models\Services::find()->where(['status' => 1])->all();
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
                            'services' => $services,
                            'id' => $id,
                ]);
        }

        /*
         * Delete service in appointment
         */

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

        /*
         * Generate report of multiple entrys (same service)
         */

        public function actionSelectedReport() {
                $appointment_id = $_POST['app_id'];
                $appointment = Appointment::findOne($appointment_id);

                if (!empty($_POST['invoice_type'])) {
                        $est_id = array();
                        $invoice = array();
                        foreach ($_POST['invoice_type'] as $key => $value) {
                                $est_id[] = $key;
                                $invoice[] = $value;
                        }
                        if ($invoice[0] == '') {
                                $error = 'Invoice type field cannot be blank';
                                return $this->renderPartial('error', [
                                            'error' => $error,
                                ]);
                        }
                        if (count(array_unique($invoice)) === 1) {
                                $appointment_details = AppointmentDetails::findAll(['appointment_id' => $appointment_id, 'id' => $est_id]);

                                $this->GenerateReport($appointment_details, $appointment, $invoice, $est_id);
                        } else {
                                $error = 'Choose Same Service';
                                return $this->renderPartial('error', [
                                            'error' => $error,
                                ]);
                        }
                }
                exit;
        }

        /*
         * This function will generate report
         */

        protected function GenerateReport($appointment_details, $appointment, $invoice, $est_id) {

//                Yii::$app->session->set('fda', $this->renderPartial('fda_report', [
//                            'appointment' => $appointment,
//                            'appointment_details' => $appointment_details,
//                            'invoice' => $invoice,
//                            'est_id' => $est_id,
//                            'save' => false,
//                            'print' => true,
//                ]));
//                echo $this->renderPartial('fda_report', [
//                    'appointment' => $appointment,
//                    'appointment_details' => $close_estimates,
//                    'invoice' => $invoice,
//                    'est_id' => $est_id,
//                    'save' => true,
//                    'print' => false,
//                ]);
                echo $this->renderPartial('report', [
                    'appointment' => $appointment,
                    'appointment_details' => $appointment_details,
                ]);

                exit;
        }

        /*
         * Generate report based on service
         */

        public function actionReport() {
                empty(Yii::$app->session['fda-report']);
                $app = $_POST['app_id'];
                $service_ids = $_POST['service_ids'];
                $appointment = Appointment::findOne($app);
                $appointment_details = AppointmentDetails::findAll(['service_id' => $service_ids, 'appointment_id' => $app]);

                echo $this->renderPartial('report', [
                    'appointment' => $appointment,
                    'appointment_details' => $appointment_details,
                ]);

                exit;
        }

        /*
         * Close Appointment
         */

        public function actionCloseAppointment($id) {
                $appointment = $this->findModel($id);
                $appointment_details = AppointmentDetails::find()->where(['appointment_id' => $id])->all();
                $i = 0;
                foreach ($appointment_details as $value) {
                        $i++;
                        // $transaction_id = 'APP' . $i;
                        $transaction_date = date('Y-m-d');
                        $financial_year = '';
                        $service = \common\models\Services::findOne($value->service_id);
                        if ($value->service == 1) {
                                $supplier = \common\models\Materials::findOne($value->supplier);
                        } else {
                                $supplier = \common\models\Contacts::findOne($value->supplier);
                        }
                        Yii::$app->SetValues->Transaction($service->category, $value->id, $transaction_date, $financial_year, $value->supplier, $supplier->name, $supplier->code, $value->sub_total, 0, $value->sub_total, 1);
                }
                $appointment->status = 0;
                $appointment->save();
                return $this->redirect(Yii::$app->request->referrer);
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

        /*
         * Ajax functions for appointment
         */

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

//        public function actionRate() {
//                if (Yii::$app->request->isAjax) {
//                        $service_id = $_POST['service_id'];
//                        $supplier_id = $_POST['supplier_id'];
//                        if ($service_id == 1) {
//
//                        } else {
//
//                        }
//                }
//        }
}
