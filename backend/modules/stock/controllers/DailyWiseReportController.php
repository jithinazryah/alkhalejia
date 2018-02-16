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

}
