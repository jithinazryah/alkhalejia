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
use common\models\Transaction;
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

    public function beforeAction($action) {
        if (!parent::beforeAction($action)) {
            return false;
        }
        if (Yii::$app->user->isGuest) {
            $this->redirect(['/site/index']);
            return false;
        }
        if (Yii::$app->session['post']['admin'] != 1) {
            Yii::$app->getSession()->setFlash('exception', 'You have no permission to access this page');
            $this->redirect(['/site/exception']);
            return false;
        }
        return true;
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

    /**
     * Creates a new Appointment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new DailyEntry();
        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
            $files = UploadedFile::getInstance($model, 'image');
            $model->received_date = date("Y-m-d h:i", strtotime($model->received_date));
            if (!empty($files)) {
                $model->image = $files->extension;
            }
            if ($model->save() && $this->Upload($model, $files)) {
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
            $model = new DailyEntryDetails();
        } else {
            $model = DailyEntryDetails::findOne($prfrma_id);
        }
        $daily_entry = DailyEntry::findOne($id);
        if ($model->load(Yii::$app->request->post())) {
            $model->daily_entry_id = $id;
            $transaction = Yii::$app->db->beginTransaction();
            if (!isset($prfrma_id)) {
                if (Yii::$app->SetValues->Attributes($model) && $model->save() && $this->SaveStock($model, $daily_entry) && $this->Addtransaction($model, $daily_entry)) {
                    $transaction->commit();
                } else {
                    $transaction->rollBack();
                }
            } else {
                if (Yii::$app->SetValues->Attributes($model) && $model->save() && $this->UpdateStock($model, $daily_entry) && $this->Updatetransaction($model, $daily_entry)) {
                    $transaction->commit();
                } else {
                    $transaction->rollBack();
                }
            }
            return $this->redirect(['add', 'id' => $id]);
        }
        $estimates = DailyEntryDetails::findAll(['daily_entry_id' => $id]);
        return $this->render('add', [
                    'model' => $model,
                    'estimates' => $estimates,
                    'daily_entry' => $daily_entry,
                    'id' => $id,
        ]);
    }

    /**
     * Updates an existing DailyEntry model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $image_ = $model->image;

        if ($model->load(Yii::$app->request->post())) {
            $files = UploadedFile::getInstance($model, 'image');
            $model->received_date = date("Y-m-d h:i", strtotime($model->received_date));
            if (empty($files)) {
                $model->image = $image_;
            } else {
                $model->image = $files->extension;
            }
            if ($model->save()) {
                $this->upload($model, $files);
                return $this->redirect(['update', 'id' => $model->id]);
            }
        } return $this->render('update', [
                    'model' => $model,
        ]);
    }

    public function Upload($daily_entry, $files) {
        if (isset($files) && !empty($files)) {
            $files->saveAs(Yii::$app->basePath . '/../uploads/daily-entry/' . $daily_entry->id . '.' . $files->extension);
        }
        return TRUE;
    }

    /*     * ************************************************************************ */

    public function SaveStock($daily_entry, $models) {

        $model = new Stock();
        $model->transaction_type = 3;
        $model->transaction_id = $daily_entry->id;
        $model->material_id = $models->material;
        $material_code = \common\models\Materials::findOne($models->material)->code;
        $model->material_code = $material_code;
        $model->yard_id = $models->yard_id;
        $yard_code = \common\models\Yard::findOne($models->yard_id)->code;
        $model->yard_code = $yard_code;
        $model->material_cost = $daily_entry->rate;
        $model->quantity_in = $daily_entry->net_weight;
        $model->total_cost = $daily_entry->total;
        Yii::$app->SetValues->Attributes($model);
        if ($model->save()) {

            return TRUE;
        } else {

            return FALSE;
        }
    }

    public function Addtransaction($daily_entry, $models) {
        $financial_year = '';
        $supplier = \common\models\Contacts::findOne($models->supplier);
        if (Yii::$app->SetValues->Transaction(1, $daily_entry->id, date('Y-m-d', strtotime($models->received_date)), $financial_year, $models->supplier, $supplier->name, $supplier->code, 0, $daily_entry->total, $daily_entry->total, 1, 1, 2)) {
            return TRUE;
        } else {
            return FALSE;
        }
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

    public function UpdateStock($daily_entry, $models) {

        $model = Stock::find()->where(['transaction_id' => $daily_entry->id])->one();
        $model->transaction_id = $daily_entry->id;
        $model->material_id = $models->material;
        $material_code = \common\models\Materials::findOne($models->material)->code;
        $model->material_code = $material_code;
        $model->yard_id = $models->yard_id;
        $yard_code = \common\models\Yard::findOne($models->yard_id)->code;
        $model->yard_code = $yard_code;
        $model->material_cost = $daily_entry->rate;
        $model->quantity_in = $daily_entry->net_weight;
        $model->total_cost = $daily_entry->total;
        Yii::$app->SetValues->Attributes($model);
        if ($model->save()) {

            return TRUE;
        } else {

            return FALSE;
        }
    }

    public function Updatetransaction($daily_entry, $models) {
        $financial_year = '';
        $supplier = \common\models\Contacts::findOne($models->supplier);
        if (Yii::$app->SetValues->TransactionUpdate(1, $daily_entry->id, date('Y-m-d', strtotime($models->received_date)), $financial_year, $models->supplier, $supplier->name, $supplier->code, 0, $daily_entry->total, $daily_entry->total, 1, 1, 2)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
