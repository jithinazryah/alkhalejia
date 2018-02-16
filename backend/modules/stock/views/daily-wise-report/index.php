<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Materials;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use yii\widgets\ActiveForm;
use common\models\DailyEntry;
use common\models\DailyEntryDetails;

/* @var $this yii\web\View */
/* @var $searchModel common\models\StockSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daily  Report';
$this->params['breadcrumbs'][] = $this->title;

$file = "demo.xls";
$test = "<table  ><tr><td>Cell 1</td><td>Cell 2</td></tr></table>";
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file");
echo $test;
