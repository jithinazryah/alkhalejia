<?php

namespace backend\modules\stock\controllers;

use Yii;
use common\models\StockSearch;

class MaterialWiseReportController extends \yii\web\Controller {

    public function actionIndex() {
        $searchModel = new StockSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->groupBy('material_id')->all();

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

}
