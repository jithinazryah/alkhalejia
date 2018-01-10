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
                                $model->update();
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
                    'print' => true,
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
                    'print' => true,
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
                        $transaction_id = 'APP' . $value->id;
                        $transaction_date = date('Y-m-d');
                        $financial_year = $this->GetFinancialYear($transaction_date);
                        $service = \common\models\Services::findOne($value->service_id);
                        if ($value->service_id == 1) {
                                $supplier = \common\models\Materials::findOne($value->supplier);
                        } else {
                                $supplier = \common\models\Contacts::findOne($value->supplier);
                        }
                        Yii::$app->SetValues->Transaction($service->category, $transaction_id, $transaction_date, $financial_year, $value->supplier, $supplier->name, $supplier->code, $value->sub_total, 0, $value->sub_total, 1, 1);
                }
                $this->SaveStock($appointment);
                $appointment->status = 0;
                $appointment->save();
                return $this->redirect(Yii::$app->request->referrer);
        }

        /*
         * Get Financial year
         */

        public function GetFinancialYear($transaction_date) {
                $trans_date = date('Y-m-d', strtotime($transaction_date));
                $financial_datas = \common\models\FinancialYears::find()->all();

                foreach ($financial_datas as $value) {
                        $contractDateBegin = date('Y-m-d', strtotime($value->start_period));
                        $contractDateEnd = date('Y-m-d', strtotime($value->end_period));
                        if (($trans_date > $contractDateBegin) && ($trans_date < $contractDateEnd)) {
                                return $value->id;
                        }
                }
        }

        /*
         * Save stock
         */

        public function SaveStock($model) {
                $stock = new \common\models\Stock();
                $stock->transaction_type = 1;
                $stock->transaction_id = $model->id;
                $stock->material_id = $model->material;
                $material_code = \common\models\Materials::findOne($model->material);
                $stock->material_code = $material_code->code;
                $stock->yard_id = '';
                $stock->yard_code = '';
                $stock->material_cost = $material_code->selling_price;
                $stock->weight_out = $model->quantity;
                $stock->total_cost = $material_code->selling_price * $model->quantity;
                Yii::$app->SetValues->Attributes($stock);
                if ($stock->save()) {
                        return TRUE;
                } else {
                        return FALSE;
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

        /*
         * Ajax functions for appointment
         */

        public function actionAppointmentNumber() {
                if (Yii::$app->request->isAjax) {
                        $vessel = \common\models\Ships::findOne($_POST['vessel']);
                        $last_appointment = Appointment::find()->where(['vessel' => $_POST['vessel']])->orderBy(['id' => SORT_DESC])->one();
                        if (empty($last_appointment))
                                echo $port_data->code . '0001';
                        else {
                                $last = substr($last_appointment->appointment_number, -4);
                                $last = ltrim($last, '0');

                                echo $vessel->code . (sprintf('%04d', ++$last));
                        }
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

        public function actionRate() {
                if (Yii::$app->request->isAjax) {
                        $service_id = $_POST['service_id'];
                        $supplier_id = $_POST['supplier_id'];
                        if ($service_id == 1) {
                                $detail = \common\models\Materials::findOne($supplier_id);
                                $rate = $detail->selling_price;
                                $tax = $detail->tax;
                        } else {
                                $detail = \common\models\Services::findOne($service_id);
                                $rate = $detail->unit_rate;
                                $tax = $detail->tax;
                        }

                        $data = ['rate' => $rate, 'tax' => $tax];
                        echo json_encode($data);
                }
        }

}
