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
            $model->date = date('Y-m-d', strtotime($model->date));
            $model->eta = date('Y-m-d', strtotime($model->date));
            $invoice = UploadedFile::getInstance($model, 'invoice');
            $email_confirm = UploadedFile::getInstance($model, 'email_confirmation');
            $delivery_note = UploadedFile::getInstance($model, 'delivery_note');
            $other = UploadedFile::getInstance($model, 'other');
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
            $model->date = date('Y-m-d', strtotime($model->date));
            $model->eta = date('Y-m-d', strtotime($model->date));
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
            if (Yii::$app->SetValues->Attributes($model) && $model->save()) {
                return $this->redirect(['add', 'id' => $id]);
            } else {
                var_dump($model->getErrors());
                echo 'sdgfd';
                exit;
            }
        }

        return $this->render('add', [
                    'model' => $model,
                    'order_details' => $order_details,
                    'order' => $order,
                    'id' => $id,
        ]);
    }

}
