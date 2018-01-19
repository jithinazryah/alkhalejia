<?php

namespace backend\modules\purchase\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use common\models\PaymentMstSearch;
use common\models\PaymentMst;
use common\models\PaymentDtl;

class PaymentController extends \yii\web\Controller {

    public function actionIndex() {
        $searchModel = new PaymentMstSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['transaction_type' => 2]);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Payment.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $model = PaymentMst::findOne(['id' => $id]);
        $model_details = PaymentDtl::findAll(['payment_mst_id' => $id]);
        return $this->render('view', [
                    'model' => $model,
                    'model_details' => $model_details,
        ]);
    }

    public function actionAdd($id = NULL) {
        $transaction_categories = ArrayHelper::map(\common\models\TransactionCategory::find()->where(['<>', 'id', 16])->all(), 'id', 'category');
        $model = new PaymentDtl();
        $model_master = new PaymentMst();
        if ($model_master->load(Yii::$app->request->post())) {
            if ($model_master->paid_amount > 0) {
                $data = Yii::$app->request->post();
                $model_master = $this->SavePaymentMaster($model_master, $data);
                $arr = $this->SavePaymentDetails($model_master, $data);
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if ($model_master->save() && $this->AddPaymentDetails($arr, $model_master) && $this->AddNotification($model_master)) {
                        $transaction->commit();
                    } else {
                        $transaction->rollBack();
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
                return $this->redirect(Yii::$app->request->referrer);
            }
        }
        return $this->render('add', [
                    'model' => $model,
                    'model_master' => $model_master,
                    'transaction_categories' => $transaction_categories,
        ]);
    }

    public function SavePaymentMaster($model_master, $data) {
        $model_master->transaction_type = 2;
        $model_master->document_date = date("Y-m-d", strtotime($model_master->document_date));
        if (isset($model_master->cheque_due_date) && $model_master->cheque_due_date != '') {
            $model_master->cheque_due_date = date("Y-m-d", strtotime($model_master->cheque_due_date));
        }
        $model_master->status = 1;
        Yii::$app->SetValues->Attributes($model_master);
        return $model_master;
    }

    public function SavePaymentDetails($model_master, $data) {
        $arr = [];
        $i = 0;
        foreach ($data['sale_date'] as $val) {
            $invoice_date = date("Y-m-d H:i:s", strtotime(str_replace('/', '-', $val)));
            $arr[$i]['sale_date'] = $invoice_date;
            $i++;
        }
        $i = 0;
        foreach ($data['invoice_number'] as $val) {
            $arr[$i]['invoice_number'] = $val;
            $i++;
        }
        $i = 0;
        foreach ($data['invoice_amount'] as $val) {
            $arr[$i]['invoice_amount'] = $val;
            $i++;
        }
        $i = 0;
        foreach ($data['sale_balance'] as $val) {
            $arr[$i]['sale_balance'] = $val;
            $i++;
        }
        $i = 0;
        foreach ($data['payed_amount'] as $val) {
            $arr[$i]['payed_amount'] = $val;
            $i++;
        }
        return $arr;
    }

    public function AddPaymentDetails($arr, $model_master) {
        $flag = 0;
        $j = 0;
        foreach ($arr as $val) {
            $j++;
            $aditional = new PaymentDtl();
            $aditional->payment_mst_id = $model_master->id;
            $aditional->transaction_id = $val['invoice_number'];
            $aditional->document_date = $val['sale_date'];
            $aditional->document_no = $model_master->document_no;
            $aditional->total_amount = $val['invoice_amount'];
            $aditional->due_amount = $val['sale_balance'];
            $aditional->paid_amount = $val['payed_amount'];
            $aditional->status = 1;
            $aditional->CB = Yii::$app->user->identity->id;
            $aditional->UB = Yii::$app->user->identity->id;
            $aditional->DOC = date('Y-m-d');
            if ($aditional->save()) {
                $transaction = \common\models\Transaction::find()->where(['id' => $aditional->transaction_id])->one();
                $transaction->balance_amount = $transaction->balance_amount - $aditional->paid_amount;
                if ($transaction->save()) {
                    $flag = 1;
                }
            }
        }
        if ($flag == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function AddNotification($model_master) {
        if ($model_master->payment_mode == 2) {
            $model = new \common\models\ChequeNotification();
            $model->payment_id = $model_master->id;
            $model->cheque_no = $model_master->cheque_no;
            $model->cheque_due_date = $model_master->cheque_due_date;
            $model->cheque_amount = $model_master->paid_amount;
            $model->status = 1;
            $model->CB = Yii::$app->user->identity->id;
            $model->UB = Yii::$app->user->identity->id;
            $model->DOC = date('Y-m-d');
            $model->save();
        }
        return TRUE;
    }

    public function actionSelectPayments() {
        if (Yii::$app->request->isAjax) {
            $supplier = $_POST['id'];
            $payment_details = \common\models\Transaction::find()->where(['supplier_id' => $supplier, 'type' => 2])->andWhere(['>', 'balance_amount', 0])->all();
            if (!empty($payment_details)) {
                $data = $this->renderPartial('_form_payment', [
                    'payment_details' => $payment_details,
                ]);
            } else {
                $data = '<p style="font-size: 17px;color:red;">Due amount is not available for this account</p>';
            }
            return $data;
        }
    }

    public function actionSelectSupplier() {
        if (Yii::$app->request->isAjax) {
            $category = $_POST['id'];
            $Suppliers = \common\models\Contacts::findAll(['service' => $category, 'status' => 1]);
            $options = '<option value="">-Choose a Supplier-</option>';
            foreach ($Suppliers as $Supplier) {
                $options .= "<option value='" . $Supplier->id . "'>" . $Supplier->name . "</option>";
            }

            echo $options;
        }
    }

}
