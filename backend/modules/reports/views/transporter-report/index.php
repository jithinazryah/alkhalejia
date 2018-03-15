<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
Use common\models\Contacts;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AdminPostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transporter Report';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .transport-report th,td{
        text-align: center;
    }
    table.table tr td:last-child {
        display: block;
        border: 0;
    }
</style>
<div class="admin-post-index">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
                </div>
                <div class="panel-body">
                    <?php $form = ActiveForm::begin(); ?>
                    <div class="row">
                        <div class='col-md-3 col-sm-3 col-xs-12 left_padd'>
                            <?php $transports = ArrayHelper::map(Contacts::findAll(['status' => 1, 'type' => 3, 'service' => 2]), 'id', 'name'); ?>
                            <?= $form->field($model, 'transporter')->dropDownList($transports, ['prompt' => '-Choose a Transporter-']) ?>
                        </div>
                        <div class='col-md-3 col-sm-3 col-xs-12 left_padd'>
                            <?php
                            $model->date = date('m-Y');
                            ?>
                            <?=
                            $form->field($model, 'date')->widget(DatePicker::classname(), [
                                'type' => DatePicker::TYPE_INPUT,
                                'pluginOptions' => [
                                    'autoclose' => true,
                                    'format' => 'mm-yyyy'
                                ]
                            ]);
                            ?>
                        </div>
                        <div class='col-md-3 col-sm-3 col-xs-12 left_padd'>
                            <div class="form-group">
                                <?= Html::submitButton('Submit', ['class' => 'btn btn-success', 'style' => 'margin-top: 30px; height: 32px; width:100px;']) ?>
                            </div>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                    <div class="row">
                        <?php if ($start_date != '' && $end_date != '' && $transport != '') {
                            ?>
                            <table class="table table-responsive table-bordered transport-report">
                                <thead>
                                    <tr>
                                        <th colspan="10"><?= Contacts::findOne($model->transporter)->name; ?> ( <?= date('M Y', strtotime($year . $month . '-01')); ?> )</th>
                                    </tr>
                                    <tr>
                                        <th rowspan="2">Date</th>
                                        <th colspan="4">Material 1</th>
                                        <th colspan="4">Material 2</th>
                                        <th rowspan="2">Total Material</th>
                                    </tr>
                                    <tr>
                                        <th>3/4</th>
                                        <th>3/8</th>
                                        <th>3/16</th>
                                        <th>Total</th>
                                        <th>3/4</th>
                                        <th>3/8</th>
                                        <th>3/16</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($list as $value) {
                                        $reports = \common\models\DailyEntryDetails::find()->where(['>=', 'received_date', $value . ' 00:00:00'])->andWhere(['<=', 'received_date', $value . ' 60:60:60'])->andWhere(['transporter' => $transport])->all();
                                        $material_grand_tot = 0;
                                        $material1_34 = 0;
                                        $material1_38 = 0;
                                        $material1_316 = 0;
                                        $material1_tot = 0;
                                        $material2_34 = 0;
                                        $material2_38 = 0;
                                        $material2_316 = 0;
                                        $material2_tot = 0;
                                        if (!empty($reports)) {
                                            foreach ($reports as $val) {
                                                if ($val->material == 2) {
                                                    $material1_34 += $val->net_weight;
                                                    $material1_tot += $val->net_weight;
                                                }
                                                if ($val->material == 3) {
                                                    $material1_38 += $val->net_weight;
                                                    $material1_tot += $val->net_weight;
                                                }
                                            }
                                            $material_grand_tot += $material1_tot;
                                        }
                                        ?>
                                        <tr>
                                            <td><?= $value ?></td>
                                            <td><?= $material1_34 > 0 ? $material1_34 : '-' ?></td>
                                            <td><?= $material1_38 > 0 ? $material1_38 : '-' ?></td>
                                            <td><?= $material1_316 > 0 ? $material1_316 : '-' ?></td>
                                            <td><?= $material1_tot > 0 ? $material1_tot : '-' ?></td>
                                            <td><?= $material2_34 > 0 ? $material2_34 : '-' ?></td>
                                            <td><?= $material2_34 > 0 ? $material2_38 : '-' ?></td>
                                            <td><?= $material2_34 > 0 ? $material2_316 : '-' ?></td>
                                            <td><?= $material2_34 > 0 ? $material2_tot : '-' ?></td>
                                            <td><?= $material_grand_tot > 0 ? $material_grand_tot : '-' ?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        <?php }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


