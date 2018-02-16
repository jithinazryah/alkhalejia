<?php

namespace backend\modules\stock\controllers;

use Yii;
use common\models\StockSearch;

class MonthlyReportController extends \yii\web\Controller {

        public function actionIndex() {
                $model = new \common\models\Stock();
                $model->setScenario('daily-wise');
                if ($model->load(Yii::$app->request->post())) {
                        //  $model->DOC = date('Y-m', strtotime($_POST['Stock']['DOC']));
                }
                return $this->render('index', ['model' => $model]);
        }

}
