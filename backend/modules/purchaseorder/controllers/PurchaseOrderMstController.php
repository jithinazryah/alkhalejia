<?php

namespace backend\modules\purchaseorder\controllers;

use Yii;
use common\models\PurchaseOrderMst;
use common\models\PurchaseOrderMstSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\PurchaseOrderDtl;
use common\models\PurchaseOrderAddition;
use yii\web\UploadedFile;

/**
 * PurchaseOrderMstController implements the CRUD actions for PurchaseOrderMst model.
 */
class PurchaseOrderMstController extends Controller {

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
     * Lists all PurchaseOrderMst models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new PurchaseOrderMstSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PurchaseOrderMst model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new PurchaseOrderMst model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new PurchaseOrderMst();

        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
            $model->date = $this->ConvertDate($model->date);
            $model->eta = $this->ConvertDate($model->eta);
            $model->payment_date = $this->ConvertDate($model->payment_date);
            $model->cheque_date = $this->ConvertDate($model->cheque_date);
            $invoice = UploadedFile::getInstance($model, 'invoice');
            $email_confirm = UploadedFile::getInstance($model, 'email_confirmation');
            $delivery_note = UploadedFile::getInstance($model, 'delivery_note');
            $other = UploadedFile::getInstance($model, 'other');
            $lco_number = $this->generateLcoNo();
            $model->reference_no = $lco_number['lco_num'];
            $model->lco_no = $lco_number['lco_value'];
            $model = $this->SetImageValues($model, $invoice, $email_confirm, $delivery_note, $other);
            if ($model->save()) {
                $this->SaveImage($model, $invoice, $email_confirm, $delivery_note, $other);
                $this->SaveAdditionalInfo($model);
                return $this->redirect(['add', 'id' => $model->id]);
            }
        } return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing PurchaseOrderMst model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $invoice_ = $model->invoice;
        $email_confirmation_ = $model->email_confirmation;
        $delivery_note_ = $model->delivery_note;
        $other_ = $model->other;
        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
            $model->date = $this->ConvertDate($model->date);
            $model->eta = $this->ConvertDate($model->eta);
            $model->payment_date = $this->ConvertDate($model->payment_date);
            $model->cheque_date = $this->ConvertDate($model->cheque_date);
            $invoice = UploadedFile::getInstance($model, 'invoice');
            $email_confirm = UploadedFile::getInstance($model, 'email_confirmation');
            $delivery_note = UploadedFile::getInstance($model, 'delivery_note');
            $other = UploadedFile::getInstance($model, 'other');
            $model = $this->SetImageUpdate($model, $invoice, $email_confirm, $delivery_note, $other, $invoice_, $email_confirmation_, $delivery_note_, $other_);
            if ($model->save()) {
                $this->SaveImage($model, $invoice, $email_confirm, $delivery_note, $other);
                $this->SaveAdditionalInfo($model);
                return $this->redirect(['update', 'id' => $model->id]);
            }
        }
        $model_additional = PurchaseOrderAddition::find()->where(['purchase_order_id' => $id])->all();
        return $this->render('update', [
                    'model' => $model,
                    'model_additional' => $model_additional,
        ]);
    }

    public function ConvertDate($data) {
        if (isset($data) && $data != '') {
            return date('Y-m-d', strtotime($data));
            ;
        } else {
            return '';
        }
    }

    /**
     * Deletes an existing PurchaseOrderMst model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PurchaseOrderMst model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PurchaseOrderMst the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = PurchaseOrderMst::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /*
     * for create additional data
     */

    public function AddAditionalCreate($create, $model) {
        $arr = [];
        $i = 0;
        foreach ($create['label'] as $val) {
            $arr[$i]['label'] = $val;
            $i++;
        }
        $i = 0;
        foreach ($create['valuee'] as $val) {
            $arr[$i]['valuee'] = $val;
            $i++;
        }
        $this->SaveAddAitional($arr, $model);
    }

    /*
     * for save add portcall data additional
     */

    public function SaveAddAitional($arr, $model) {
        foreach ($arr as $val) {
            $aditional = new PurchaseOrderAddition();
            $aditional->purchase_order_id = $model->id;
            $aditional->label = $val['label'];
            $aditional->value = $val['valuee'];
            $aditional->status = 1;
            $aditional->CB = Yii::$app->user->identity->id;
            $aditional->UB = Yii::$app->user->identity->id;
            $aditional->DOC = date('Y-m-d');
            if (!empty($aditional->label))
                $aditional->save();
        }
    }

    /*
     * for updating additional data
     */

    public function AddAditionalUpdate($update) {
        $arr = [];
        $i = 0;
        foreach ($update as $key => $val) {
            $arr[$key]['label'] = $val['label'][0];
            $arr[$key]['value'] = $val['value'][0];
            $i++;
        }
        foreach ($arr as $key => $value) {
            $aditional = PurchaseOrderAddition::findOne($key);
            $aditional->label = $value['label'];
            $aditional->value = $value['value'];
            if (!empty($aditional->label))
                $aditional->save();
        }
    }

    /*
     * for delete portcall data additional data
     */

    public function AddAditionalDelete($param) {
        $vals = rtrim($param, ',');
        $vals = explode(',', $vals);
        foreach ($vals as $val) {
            PurchaseOrderAddition::findOne($val)->delete();
        }
    }

    /*
     * for Set Image Values
     */

    public function SetImageValues($model, $invoice, $email_confirm, $delivery_note, $other) {
        if (!empty($invoice)) {
            $model->invoice = $invoice->extension;
        }
        if (!empty($email_confirm)) {
            $model->email_confirmation = $email_confirm->extension;
        }
        if (!empty($delivery_note)) {
            $model->delivery_note = $delivery_note->extension;
        }
        if (!empty($other)) {
            $model->other = $other->extension;
        }
        return $model;
    }

    /*
     * for Set Image Values
     */

    public function SaveImage($model, $invoice, $email_confirm, $delivery_note, $other) {
        if (!empty($invoice)) {
            $this->upload($model, $invoice, 'invoice');
        }
        if (!empty($email_confirm)) {
            $this->upload($model, $email_confirm, 'email_confirmation');
        }
        if (!empty($delivery_note)) {
            $this->upload($model, $delivery_note, 'delivery_note');
        }
        if (!empty($other)) {
            $this->upload($model, $other, 'other');
        }
        return;
    }

    /*
     * for Set Image Values on update
     */

    public function SetImageUpdate($model, $invoice, $email_confirm, $delivery_note, $other, $invoice_, $email_confirmation_, $delivery_note_, $other_) {
        if (empty($invoice)) {
            $model->invoice = $invoice_;
        } else {
            $model->invoice = $invoice->extension;
        }
        if (empty($email_confirm)) {
            $model->email_confirmation = $email_confirmation_;
        } else {
            $model->email_confirmation = $email_confirm->extension;
        }
        if (empty($delivery_note)) {
            $model->delivery_note = $delivery_note_;
        } else {
            $model->delivery_note = $delivery_note->extension;
        }
        if (empty($other)) {
            $model->other = $other_;
        } else {
            $model->other = $other->extension;
        }
        return $model;
    }

    /**
     * Upload Material photos.
     * @return mixed
     */
    public function Upload($model, $files, $file_name) {
        if (isset($files) && !empty($files)) {
            $path = Yii::$app->basePath . '/../uploads/purchase-order/' . $model->id;
            if (!is_dir($path)) {
                mkdir($path);
            }
            $files->saveAs($path . '/' . $file_name . '.' . $files->extension);
        }
        return TRUE;
    }

    /**
     * Save Additional Information
     * @return mixed
     */
    public function SaveAdditionalInfo($model) {
        if (isset($_POST['create']) && $_POST['create'] != '') {
            $this->AddAditionalCreate($_POST['create'], $model);
        }

        if (isset($_POST['updatee']) && $_POST['updatee'] != '') {
            $this->AddAditionalUpdate($_POST['updatee']);
        }
        if (isset($_POST['delete_port_vals']) && $_POST['delete_port_vals'] != '') {
            $this->AddAditionalDelete($_POST['delete_port_vals']);
        }
        return TRUE;
    }

    /**
     * To get supplier address
     */
    public function actionSupplierAddress() {
        if (Yii::$app->request->isAjax) {
            $address = '';
            $id = $_POST['id'];
            $supplier = \common\models\Contacts::find()->where(['id' => $id])->one();
            if (!empty($supplier)) {
                if (isset($supplier->address) && $supplier->address != '') {
                    $address = $supplier->address;
                }
            }
            echo $address;
        }
    }

    /*
     * Add Purchase order details
     */

    public function actionAdd($id, $prfrma_id = NULL) {

        if (!isset($prfrma_id)) {
            $model = new PurchaseOrderDtl();
        } else {
            $model = PurchaseOrderDtl::findOne($prfrma_id);
        }
        $order_details = PurchaseOrderDtl::findAll(['purchase_order_mst_id' => $id]);
        $order = PurchaseOrderMst::findOne($id);
        if ($model->load(Yii::$app->request->post())) {
            $model->purchase_order_mst_id = $id;

            $model->status = 1;
            $model->CB = Yii::$app->user->identity->id;
            $model->UB = Yii::$app->user->identity->id;
            $model->DOC = date('Y-m-d');
            $transaction = Yii::$app->db->beginTransaction();
            if (!isset($prfrma_id)) {
                if ($model->save() && $this->Addtransaction($model)) {
                    $transaction->commit();
                } else {
                    $transaction->rollBack();
                }
            } else {
                if ($model->save() && $this->Updatetransaction($model)) {
                    $transaction->commit();
                } else {
                    $transaction->rollBack();
                }
            }
            return $this->redirect(['add', 'id' => $id]);
        }

        return $this->render('add', [
                    'model' => $model,
                    'order_details' => $order_details,
                    'order' => $order,
                    'id' => $id,
        ]);
    }

    /*
     * Add purchase order entry into transaction
     */

    public function Addtransaction($model) {
        $master = PurchaseOrderMst::find()->where(['id' => $model->purchase_order_mst_id])->one();
        $flag = 0;
        $financial_year = '';
        $supplier = \common\models\Contacts::findOne($master->attenssion);
        if (Yii::$app->SetValues->Transaction(1, $model->id, date('Y-m-d', strtotime($master->date)), $financial_year, $master->attenssion, $supplier->name, $supplier->code, 0, $model->total, $model->total, 1, 3)) {
            $flag = 1;
        }
        if ($flag == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /*
     * Update purchase order entry into transaction
     */

    public function Updatetransaction($model) {
        $master = PurchaseOrderMst::find()->where(['id' => $model->purchase_order_mst_id])->one();
        $flag = 0;
        $financial_year = '';
        $supplier = \common\models\Contacts::findOne($master->attenssion);
        if (Yii::$app->SetValues->TransactionUpdate(1, $model->id, date('Y-m-d', strtotime($master->date)), $financial_year, $master->attenssion, $supplier->name, $supplier->code, 0, $model->total, $model->total, 1, 3)) {
            $flag = 1;
        }
        if ($flag == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /*
     * Generate report based on service
     */

    public function actionPurchaseOrder($id) {
        $order = PurchaseOrderMst::find()->where(['id' => $id])->one();
        $order_details = PurchaseOrderDtl::find()->where(['purchase_order_mst_id' => $id])->all();
        $order_additional = PurchaseOrderAddition::find()->where(['purchase_order_id' => $id])->all();
        echo $this->renderPartial('purchase_order', [
            'order' => $order,
            'order_details' => $order_details,
            'order_additional' => $order_additional,
            'print' => true,
        ]);

        exit;
    }

    /*
     * Generate report based on service
     */

    public function actionWordExport($id) {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=purchase_order.doc");
        $order = PurchaseOrderMst::find()->where(['id' => $id])->one();
        $order_details = PurchaseOrderDtl::find()->where(['purchase_order_mst_id' => $id])->all();
        $order_additional = PurchaseOrderAddition::find()->where(['purchase_order_id' => $id])->all();
        $text = $this->renderPartial('purchase_order_word', [
            'order' => $order,
            'order_details' => $order_details,
            'order_additional' => $order_additional,
            'print' => true,
        ]);
        echo $text;
        exit;
    }

    /*
     * Generate report based on service
     */

    public function actionPurchaseCover($id) {
        $order = PurchaseOrderMst::find()->where(['id' => $id])->one();
        $order_details = PurchaseOrderDtl::find()->where(['purchase_order_mst_id' => $id])->all();
        echo $this->renderPartial('purchase_cover', [
            'order' => $order,
            'order_details' => $order_details,
            'print' => true,
        ]);

        exit;
    }

    /*
     * Delete order details in purchase order
     */

    public function actionDeleteDetail($id) {
        PurchaseOrderDtl::findOne($id)->delete();
        return $this->redirect(Yii::$app->request->referrer);
    }

    /*
     * Generate LCO Number
     */

    public function generateLcoNo() {
        $loc_no = '';
        $loc_val = '';
        $last_purchase_order = PurchaseOrderMst::find()->where(['<>', 'lco_no', ''])->orderBy(['id' => SORT_DESC])->one();
        if (empty($last_purchase_order)) {
            $loc_no = 'AKA/PO/0110/' . date('Y');
            $loc_val = 110;
        } else {
            $last = ++$last_purchase_order->lco_no;
            $loc_no = 'AKA/PO/' . (sprintf('%04d', $last)) . '/' . date('Y');
            $loc_val = $last;
        }
        $loc_data = array("lco_num" => $loc_no, "lco_value" => $loc_val);
        return $loc_data;
    }

    /*
     * Add supplier from purchase order form
     */

    public function actionAddSupplier() {
        $model = new \common\models\Contacts();

        if (Yii::$app->request->post()) {
            $model->service = Yii::$app->request->post()['contacts_service'];
            $model->name = Yii::$app->request->post()['contacts_name'];
            $model->code = Yii::$app->request->post()['contacts_code'];
            $model->tax_id = Yii::$app->request->post()['contacts_tax_id'];
            $model->type = Yii::$app->request->post()['contacts_type'];
            $model->phone = Yii::$app->request->post()['contacts_phone'];
            $model->email = Yii::$app->request->post()['contacts_email'];
            $model->city = Yii::$app->request->post()['contacts_city'];
            $model->status = Yii::$app->request->post()['contacts_status'];
            $model->address = Yii::$app->request->post()['contacts_address'];
            $model->description = Yii::$app->request->post()['contacts_description'];
            Yii::$app->SetValues->Attributes($model);
            if ($model->validate() && $model->save()) {
                echo json_encode(array("con" => "1", 'id' => $model->id, 'name' => $model->name)); //Success
                exit;
            } else {
                $array = $model->getErrors();
                $error = isset($array['name']['0']) ? $array['name']['0'] : 'Internal error';
                echo json_encode(array("con" => "2", 'error' => $error));
                exit;
            }
        }
        return $this->renderAjax('form_supplier', [
                    'model' => $model,
        ]);
    }

    /*
     * This functio remove uploaded path
     */

    public function actionRemove($path, $id, $type) {
        echo $type;
        $model = PurchaseOrderMst::findOne($id);
        if (!empty($model)) {
            if ($type == 1) {
                $model->invoice = '';
            } elseif ($type == 2) {
                $model->email_confirmation = '';
            } elseif ($type == 3) {
                $model->delivery_note = '';
            } elseif ($type == 4) {
                $model->other = '';
            } else {
                return $this->redirect(Yii::$app->request->referrer);
            }
            if ($model->update()) {
                unlink($path);
//                if (Yii::$app->session['post']['id'] == 1) {
//                    unlink($path);
//                }
            }
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

}
