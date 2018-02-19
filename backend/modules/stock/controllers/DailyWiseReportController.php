<?php

namespace backend\modules\stock\controllers;

use Yii;
use common\models\StockSearch;

class DailyWiseReportController extends \yii\web\Controller {

    public function actionIndex() {

        $model = new \common\models\Stock();

        $model->setScenario('daily-wise');
        if ($model->load(Yii::$app->request->post())) {
            $model->DOC = date('Y-m-d', strtotime($model->DOC));
        }
        return $this->render('report', ['model' => $model,
        ]);
    }

    public function actionDaily() {
        $model = new \common\models\Stock();
        if ($model->load(Yii::$app->request->post())) {
            $model->DOC = date('Y-m-d', strtotime($model->DOC));
        }
        return $this->render('report', ['model' => $model]);
    }

    public function actionExports() {
        $test = '';
        if (Yii::$app->request->post()) {
            $data = Yii::$app->request->post();
            $test = $this->renderPartial('report_xls', ['data' => $data]);
        }
        $file = "daily-report.xls";
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=$file");
        echo $test;
    }

}
