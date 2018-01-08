<?php

namespace backend\modules\purchase\controllers;

use Yii;
use common\models\DailyEntry;
use common\models\DailyEntrySearch;
use common\models\DailyEntryDetails;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Stock;
use yii\web\UploadedFile;

/**
 * DailyEntryController implements the CRUD actions for DailyEntry model.
 */
class DailyEntryController extends Controller {

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
     * Lists all DailyEntry models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new DailyEntrySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DailyEntry model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /*     * SavePurchaseDetails
     * Creates a new DailyEntry model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function actionCreate() {
        $model = new DailyEntry();
        $model_details = new DailyEntryDetails();

        if ($model->load(Yii::$app->request->post())) {
            $data = Yii::$app->request->post();
//            echo '<pre>';print_r($_POST['DailyEntryDetails']);exit;
            $arr = $this->SavePurchaseDetails($model_details, $data);
            $files = UploadedFile::getInstance($model, 'image');
            $model->received_date = date("Y-m-d h:i", strtotime($model->received_date));
            $transaction = Yii::$app->db->beginTransaction();
            try {
                if (Yii::$app->SetValues->Attributes($model) && $model->save() && $this->Upload($model, $files) && $this->Savedetails($model, $arr, $transaction)
                ) {
//                    $transaction->commit();
                    Yii::$app->session->setFlash('success', "New invoice create successfully.");
                    return $this->redirect(['index']);
                } else {
                    $transaction->rollBack();
                }
            } catch (Exception $e) {
                $transaction->rollBack();
            }
//            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                        'model' => $model,
                        'model_details' => $model_details,
            ]);
        }
    }

    /**
     * Updates an existing DailyEntry model.
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

    public function Savedetails($model, $arr, $transaction) {
//        echo '<pre>';        print_r($arr);exit;
        foreach ($arr as $val) {
            $total = 0;
            $amount_paid = 0;
            $model_details = new DailyEntryDetails();
            $model_details->attributes = $model->attributes;
            $model_details->daily_entry_id = $model->id;
            if (isset($val['ticket_no']) && $val['truck_no'] != '') {
                $model_details->ticket_no = $val['truck_no'];
            }
            if (isset($val['truck_no']) && $val['truck_no'] != '') {
                $model_details->truck_number = $val['truck_no'];
            }
            if (isset($val['net_weight']) && $val['net_weight'] != '') {
                $model_details->net_weight = $val['net_weight'];
            }
            if (isset($val['rate']) && $val['rate'] != '') {
                $model_details->rate = $val['rate'];
            }
            if (isset($val['transport_amount']) && $val['transport_amount'] != '') {
                $model_details->transport_amount = $val['transport_amount'];
            }
            if (isset($val['total']) && $val['total'] != '') {
                $model_details->total = $val['total'];
                $total = $model_details->total;
            }
            if (isset($val['description']) && $val['description'] != '') {
                $model_details->description = $val['description'];
            }
//            $transaction = Yii::$app->db->beginTransaction();
//            try {
            if (Yii::$app->SetValues->Attributes($model_details) && $model_details->save() && $this->SaveStock($model_details, $model)
            ) {
                $transaction->commit();
            } else {
                    $transaction->rollBack();
            }
//            } catch (Exception $e) {
//                $transaction->rollBack();
//            }
        }
        return TRUE;
    }

    public function Upload($daily_entry, $files) {
        if (isset($files) && !empty($files)) {
            $files->saveAs(Yii::$app->basePath . '/../uploads/daily-entry/' . $daily_entry->id . '.' . $files->extension);
        }
        return TRUE;
    }

    public function SaveStock($daily_entry, $model) {

        $model = new Stock();
        $model->transaction_type = 2;
        $model->transaction_id = $daily_entry->id;
        $model->material_id = $model->material;
        $material_code = \common\models\Materials::findOne($model->material)->code;
        $model->material_code = $material_code;
        $model->yard_id = $model->yard_id;
        $yard_code = \common\models\Yard::findOne($model->yard_id)->code;
        $model->yard_code = $yard_code;
        $model->material_cost = $daily_entry->rate;
        $model->weight_in = $daily_entry->net_weight;
        $model->total_cost = $daily_entry->total;
        Yii::$app->SetValues->Attributes($model);
        if ($model->save()) {

            return TRUE;
        } else {

            return FALSE;
        }
    }

    /**
     * Deletes an existing DailyEntry model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the DailyEntry model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DailyEntry the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = DailyEntry::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Append one row to the document add form
     */
    public function actionAttachment() {
        if (Yii::$app->request->isAjax) {
            $srl = Yii::$app->request->post()['srl'];
            $data = $this->renderPartial('_form_add_attachment', ['srl' => $srl]);
            echo $data;
        }
    }

    /*
     * to upload multiple documents
     *  */

    public function SavePurchaseDetails($model, $data) {
//        echo '<pre>';        print_r($_POST['DailyEntryDetails']);exit;

        $arrs = [];
        if (isset($_POST['DailyEntryDetails']) && $_POST['DailyEntryDetails'] != '') {


            $i = 0;
            foreach ($_POST['DailyEntryDetails']['ticket_no'] as $val) {
                $arrs[$i]['ticket_no'] = $val;
                $i++;
            }
            $i = 0;
            foreach ($_POST['DailyEntryDetails']['truck_number'] as $val) {
                $arrs[$i]['truck_no'] = $val;
                $i++;
            }
            $i = 0;
            foreach ($_POST['DailyEntryDetails']['net_weight'] as $val) {
                $arrs[$i]['net_weight'] = $val;
                $i++;
            }

            $i = 0;
            foreach ($_POST['DailyEntryDetails']['rate'] as $val) {
                $arrs[$i]['rate'] = $val;
                $i++;
            }
            $i = 0;
            foreach ($_POST['DailyEntryDetails']['transport_amount'] as $val) {
                $arrs[$i]['transport_amount'] = $val;
                $i++;
            }
            $i = 0;
            foreach ($_POST['DailyEntryDetails']['total'] as $val) {
                $arrs[$i]['total'] = $val;
                $i++;
            }
            $i = 0;
            foreach ($_POST['DailyEntryDetails']['description'] as $val) {
                $arrs[$i]['description'] = $val;
                $i++;
            }
        }
        return $arrs;
    }

}
