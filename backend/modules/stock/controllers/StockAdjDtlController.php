<?php

namespace backend\modules\stock\controllers;

use Yii;
use common\models\StockAdjDtl;
use common\models\StockAdjDtlSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\StockAdjMstSearch;
use common\models\StockAdjMst;
use common\models\Materials;

/**
 * StockAdjDtlController implements the CRUD actions for StockAdjDtl model.
 */
class StockAdjDtlController extends Controller {

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
     * Lists all StockAdjDtl models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new StockAdjMstSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single StockAdjDtl model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $model = StockAdjMst::findOne(['id' => $id]);
        $model_details = StockAdjDtl::find()->where(['master_id' => $id])->all();
        return $this->render('view', [
                    'model' => $model,
                    'model_details' => $model_details,
        ]);
    }

    /**
     * Creates a new StockAdjDtl model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new StockAdjDtl();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing StockAdjDtl model.
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
     * Deletes an existing StockAdjDtl model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the StockAdjDtl model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StockAdjDtl the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = StockAdjDtl::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Creates a new StockAdjDtl model and StockAdjMst Model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionAdd() {
        $model = new StockAdjDtl();
        $model_stock_master = new StockAdjMst();
        if ($model_stock_master->load(Yii::$app->request->post())) {
            $data = Yii::$app->request->post();
            if (isset($_POST['save-approve'])) {
                $flag = 1;
            } else {
                $flag = 0;
            }
            $model_stock_master = $this->SaveStockMaster($model_stock_master, $data, $flag);
            $arr = $this->SaveStockDetails($model_stock_master, $data, $flag);
            $transaction = Yii::$app->db->beginTransaction();
            try {
                if ($model_stock_master->save() && $this->AddStockDetails($arr, $model_stock_master, $flag)) {
                    $transaction->commit();
                } else {
                    $transaction->rollBack();
                }
            } catch (Exception $e) {
                $transaction->rollBack();
            }
            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->render('add', [
                    'model' => $model,
                    'model_stock_master' => $model_stock_master,
        ]);
    }

    /**
     * Set values into StockAdjMst object.
     * @return $model_stock_master
     */
    public function SaveStockMaster($model_stock_master, $data, $flag) {
        $model_stock_master->document_date = date("Y-m-d H:i:s", strtotime(str_replace('/', '-', $model_stock_master->document_date)));
        if ($flag == 1) {
            $model_stock_master->status = 1;
        } else {
            $model_stock_master->status = 0;
        }
        Yii::$app->SetValues->Attributes($model_stock_master);
        return $model_stock_master;
    }

    public function SaveStockDetails($model_stock_master, $data, $flag) {
        $arr = [];
        $i = 0;
        foreach ($data['StockAdjDtlItemId'] as $val) {
            $arr[$i]['StockAdjDtlItemId'] = $val;
            $i++;
        }
        $i = 0;
        foreach ($data['StockAdjDtlQty'] as $val) {
            $arr[$i]['StockAdjDtlQty'] = $val;
            $i++;
        }
        $i = 0;
        foreach ($data['StockAdjDtlItenCost'] as $val) {
            $arr[$i]['StockAdjDtlItenCost'] = $val;
            $i++;
        }
        $i = 0;
        foreach ($data['StockAdjDtlTotal'] as $val) {
            $arr[$i]['StockAdjDtlTotal'] = $val;
            $i++;
        }
        return $arr;
    }

    public function AddStockDetails($arr, $model_stock_master, $flag) {
        $flagg = 0;
        $j = 0;
        foreach ($arr as $val) {
            $j++;
            $aditional = new StockAdjDtl();
            $item_datas = \common\models\Materials::find()->where(['id' => $val['StockAdjDtlItemId']])->one();
            if (!empty($item_datas)) {
                $aditional->master_id = $model_stock_master->id;
                $aditional->transaction = $model_stock_master->transaction;
                $aditional->document_date = $model_stock_master->document_date;
                $aditional->material_id = $item_datas->id;
                $aditional->material_code = $item_datas->code;
                $aditional->material_name = $item_datas->name;
                $aditional->rate = $val['StockAdjDtlItenCost'];
                $aditional->qty = $val['StockAdjDtlQty'];
                $aditional->total_cost = $val['StockAdjDtlTotal'];
                if ($flag == 1) {
                    $aditional->status = 1;
                } else {
                    $aditional->status = 0;
                }
                $aditional->CB = Yii::$app->user->identity->id;
                $aditional->UB = Yii::$app->user->identity->id;
                $aditional->DOC = date('Y-m-d');
                if ($aditional->save()) {
                    if ($flag == 1) {
                        if ($this->AddStockRegister($aditional, $j)) {
                            $flagg = 1;
                        } else {
                            $flagg = 0;
                        }
                    } else {
                        $flagg = 1;
                    }
                }
            }
        }
        if ($flagg == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function AddStockRegister($aditional, $j) {
        $flag = 0;
        $stock = new \common\models\Stock();
        if ($aditional->transaction == 1) {
            $transaction = 7;
        } elseif ($aditional->transaction == 2) {
            $transaction = 5;
        } elseif ($aditional->transaction == 3) {
            $transaction = 6;
        }
        $stock->transaction_type = $transaction;
        $stock->transaction_id = $aditional->id;
        $stock->material_id = $aditional->material_id;
        $stock->material_code = $aditional->material_code;
        $stock->material_cost = $aditional->rate;
        if ($aditional->transaction == 3) {
            $stock->quantity_out = $aditional->qty;
        } else {
            $stock->quantity_in = $aditional->qty;
        }
        $stock->total_cost = $aditional->total_cost;
        $stock->status = 1;
        $stock->CB = Yii::$app->user->identity->id;
        $stock->UB = Yii::$app->user->identity->id;
        $stock->DOC = date('Y-m-d');
        if ($stock->save()) {
            $flag = 1;
//            if ($this->AddTransaction($aditional, $stock)) {
//                $flag = 1;
//            } else {
//                $flag = 0;
//            }
        } else {
            $flag = 0;
        }
        if ($flag == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function AddTransaction($aditional, $stock) {
        $model = new \common\models\Transaction;
        $model->transaction_category = 1;
        $model->transaction_id = $aditional->id;
        $model->type = 3;
        $model->transaction_date = $aditional->document_date;
        $model->financial_year = 1;
        if ($aditional->transaction == 3) {
            $stock->quantity_out = $aditional->qty;
        } else {
            $stock->quantity_in = $aditional->qty;
        }
        $model->debit_amount = $aditional->total_cost;
        $model->balance_amount = $aditional->total_cost;
        $model->status = $aditional->status;
        $model->CB = Yii::$app->user->identity->id;
        $model->DOC = date('Y-m-d');
        if ($model->save()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function actionApprove($id) {
        $model = StockAdjMst::findOne(['id' => $id]);
        $model_details = StockAdjDtl::findAll(['master_id' => $id]);
        $k = 0;
        foreach ($model_details as $value) {
            $k++;
            $this->AddStockRegister($value, $k);
            $value->status = 1;
            $value->save();
        }
        $model->status = 1;
        $model->save();
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionGetItems() {
        if (Yii::$app->request->isAjax) {
            $item_id = $_POST['item_id'];
            $next_row_id = $_POST['next_row_id'];
            $transaction = $_POST['transaction'];
            $next = $next_row_id + 1;
            $items = \common\models\Materials::find()->where(['status' => 1])->all();
            if ($item_id == '') {
                echo '0';
                exit;
            } else {
                $item_datas = \common\models\Materials::find()->where(['id' => $item_id])->one();
                if (empty($item_datas)) {
                    echo '0';
                    exit;
                } else {
                    $in_stock = \common\models\Stock::find()->where(['material_id' => $item_datas->id])->sum('quantity_in');
                    $out_stock = \common\models\Stock::find()->where(['material_id' => $item_datas->id])->sum('quantity_out');
                    $existing_stock = $in_stock - $out_stock;
                    if ($transaction == 3) {
                        if ($existing_stock > 0) {
                            $flag = 0;
                        } else {
                            $flag = 1;
                        }
                    } else {
                        $flag = 0;
                    }
                    if ($flag == 0) {
                        $next_row = $this->renderPartial('next_row', [
                            'next' => $next,
                            'items' => $items,
                        ]);
                        $arr_variable = array('next_row_html' => $next_row, 'next' => $next, 'item_rate' => $item_datas->selling_price, 'existing_stock' => $existing_stock);
                        $data['result'] = $arr_variable;
                        echo json_encode($data);
                    } else {
                        echo '1';
                        exit;
                    }
                }
            }
        }
    }

    public function actionAddAnotherRow() {
        if (Yii::$app->request->isAjax) {
            $next_row_id = $_POST['next_row_id'];
            $next = $next_row_id + 1;
            $items = \common\models\Materials::findAll(['status' => 1]);
            $next_row = $this->renderPartial('next_row', [
                'next' => $next,
                'items' => $items,
            ]);
            $new_row = array('next_row_html' => $next_row);
            $data['result'] = $new_row;
            echo json_encode($data);
        }
    }

}
