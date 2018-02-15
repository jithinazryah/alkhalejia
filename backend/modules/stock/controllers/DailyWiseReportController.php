<?php

namespace backend\modules\stock\controllers;

use Yii;
use common\models\StockSearch;

class DailyWiseReportController extends \yii\web\Controller {

    public function actionIndex() {
//                $searchModel = new StockSearch();
//                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//                $dataProvider->query->groupBy('material_id,DOC')->all();
//                if (isset($_GET['StockSearch']['DOC'])) {
//                        $date = date('Y-m-d', strtotime($_GET['StockSearch']['DOC']));
//                        $dataProvider->query->where(['DOC' => $date]);
//                }
//
//                return $this->render('index', [
//                            'searchModel' => $searchModel,
//                            'dataProvider' => $dataProvider,
//                ]);

        $model = new \common\models\Stock();
        if ($model->load(Yii::$app->request->post())) {
            $model->DOC = date('Y-m-d', strtotime($model->DOC));
        }
        return $this->render('report', ['model' => $model]);
    }

    public function actionDaily() {
        $model = new \common\models\Stock();
        if ($model->load(Yii::$app->request->post())) {
            $model->DOC = date('Y-m-d', strtotime($model->DOC));
        }
        return $this->render('report', ['model' => $model]);
    }

    public function actionExport() {

        $body = $_POST['body'];
        $this->setHeader("export.xls");
        echo $body;
    }

    public function setheader($excel_file_name) {


        header("Content-type: application/octet-stream"); //A MIME attachment with the content type "application/octet-stream" is a binary file.
        //Typically, it will be an application or a document that must be opened in an application, such as a spreadsheet or word processor.
        header("Content-Disposition: attachment; filename=$excel_file_name"); //with this extension of file name you tell what kind of file it is.
        header("Pragma: no-cache"); //Prevent Caching
        header("Expires: 0"); //Expires and 0 mean that the browser will not cache the page on your hard drive
    }

}
