<?php

namespace backend\modules\reports\controllers;

use yii;
use common\models\TransporterReport;

class TransporterReportController extends \yii\web\Controller {

    public function actionIndex() {
        $model = new TransporterReport();
        $start_date = '';
        $end_date = '';
        $transport = '';
        $numberDays = '';
        $list = array();
        if ($model->load(Yii::$app->request->post())) {
            $transport = $model->transporter;
            $dateArray = explode('-', $model->date);
            $month = $dateArray[0];
            $year = $dateArray[1];
            $numberDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $start_date = $year . '-' . $month . '-' . 1;
            $end_date = $year . '-' . $month . '-' . $numberDays;
            for ($d = 1; $d <= $numberDays; $d++) {
                $time = mktime(12, 0, 0, $month, $d, $year);
                if (date('m', $time) == $month)
                    $list[] = date('Y-m-d', $time);
            }
//            $report = \common\models\DailyEntryDetails::find()->where(['>=', 'received_date', $start_date . ' 00:00:00'])->andWhere(['<=', 'received_date', $end_date . ' 60:60:60'])->andWhere(['transport' => $transport])->all();
        }
        return $this->render('index', [
                    'model' => $model,
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    'transport' => $transport,
                    'numberDays' => $numberDays,
                    'list' => $list,
        ]);
    }

}
