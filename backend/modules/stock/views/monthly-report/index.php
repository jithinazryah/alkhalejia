<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Materials;
use common\models\DailyEntry;
use common\models\DailyEntryDetails;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel common\models\StockSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Monthly  Report';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stock-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">
                                        <div class="row" style="margin-left: 0px;">


                                                <div class="col-md-3">
                                                        <?php
                                                        $form = ActiveForm::begin([
                                                        ]);
                                                        ?>
                                                        <?php
                                                        if (isset($model->DOC)) {
                                                                // $date = date('m-Y', strtotime($model->DOC));
                                                        } else {
                                                                $date = date('m-Y');
                                                        }
                                                        ?>

                                                        <?=
                                                        $form->field($model, 'DOC')->widget(DatePicker::className(), [
                                                            'options' => ['class' => 'form-control'],
                                                            'value' => $date,
                                                            'pluginOptions' => [
                                                                'autoclose' => true,
                                                                'format' => 'dd-mm-yyyy',
                                                                'startView' => 'year',
                                                                'minViewMode' => 'months',
                                                                'format' => 'mm-yyyy',
                                                            ]
                                                        ])->label('Date');
                                                        ?>

                                                </div>

                                                <div class="col-md-3">

                                                        <?php
                                                        $materials = Materials::findAll(['status' => 1]);
                                                        ?>
                                                        <?=
                                                        $form->field($model, 'material_id')->dropDownList(ArrayHelper::map($materials, 'id', 'name'), ['prompt' => 'Select', 'multiple' => true]);
                                                        ?>

                                                </div>

                                                <div class="col-md-4" style="margin-top: 31px;">
                                                        <div class="form-group">
                                                                <?= Html::submitButton('Search', ['class' => 'btn btn-success']) ?>
                                                        </div>
                                                </div>
                                                <?php ActiveForm::end(); ?>



                                        </div>
                                        <?php
                                        if (isset($model->material_id)) {
                                                $cc_material_cont = count($model->material_id);
                                                $cc_width = 100 / $cc_material_cont;
                                                $start_date = '01-' . $model->DOC;
                                                $month = date('m', strtotime($start_date));
                                                if ($month == '04' || $month == '06' || $month == '11' || $month = '09') {
                                                        $month_count = 30;
                                                } else if ($month == '02') {
                                                        $month_count = 28;
                                                } else {
                                                        $month_count = 31;
                                                }


                                                $start_date = date('Y-m-d', strtotime($start_date . "-1 days"));
                                                ?>

                                                <table class='table-responsive table table-small-font table-bordered table-striped'>
                                                        <tr>
                                                                <th>Date</th>
                                                                <?php
                                                                foreach ($model->material_id as $value) {
                                                                        $material_detail = Materials::findOne($value);
                                                                        ?>
                                                                        <th>Trips</th>
                                                                        <th><?= $material_detail->name ?></th>
                                                                <?php } ?>
                                                                <th style="padding: 0">
                                                                        <table class="table-responsive table table-small-font table-bordered table-striped" style="margin-bottom: 0">
                                                                                <tr>
                                                                                        <th colspan="<?= $cc_material_cont ?>" style="text-align: center">Export</th>
                                                                                </tr>
                                                                                <tr>
                                                                                        <?php
                                                                                        foreach ($model->material_id as $value) {
                                                                                                $material_detail = Materials::findOne($value);
                                                                                                ?>
                                                                                                <th style="width:<?= $cc_width ?>%"><?= $material_detail->name ?></th>
                                                                                        <?php } ?>
                                                                                </tr>
                                                                        </table>
                                                                </th>
                                                                <th>Total</th>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <!--                                                                <th>Total</th>-->
                                                        </tr>



                                                        <tr>
                                                                <th>Closing Balance</th>
                                                                <?php
                                                                $overall_total = 0;
                                                                $overall = array();
                                                                $total_mat_count_net = 0;
                                                                $total_materials_entry_weight_net = 0;

                                                                foreach ($model->material_id as $material_trip) {
                                                                        $materials_entry = DailyEntry::find()->where(['material' => $material_trip])->andWhere(['<=', 'DOC', $start_date])->all();
                                                                        $materials_entry_count = 0;
                                                                        $total_mat_count = 0;
                                                                        $materials_weight_count = 0;
                                                                        $total_materials_entry_weight = 0;

                                                                        foreach ($materials_entry as $materials_entry_per) {

                                                                                $materials_entry_count = DailyEntryDetails::find()->where(['daily_entry_id' => $materials_entry_per->id])->count();
                                                                                $total_mat_count += $materials_entry_count;
                                                                                $materials_weight_count = DailyEntryDetails::find()->where(['daily_entry_id' => $materials_entry_per->id])->sum('net_weight');
                                                                                $total_materials_entry_weight += $materials_weight_count;
                                                                        }
                                                                        $total_mat_count_net += $total_mat_count;
                                                                        $total_materials_entry_weight_net += $total_materials_entry_weight;

                                                                        $overall[$material_trip]['trip'] += $total_mat_count;
                                                                        $overall[$material_trip]['weight'] += $total_materials_entry_weight;
                                                                        ?>
                                                                        <th><?php echo $total_mat_count; ?></th>
                                                                        <th><?php echo Yii::$app->SetValues->NumberFormat($total_materials_entry_weight); ?></th>

                                                                        <?php
                                                                }
                                                                ?>

                                                                <th style="padding: 0">
                                                                        <table class="table-responsive table table-small-font table-bordered table-striped" style="margin-bottom: 0">
                                                                                <tr>
                                                                                        <?php
                                                                                        $total_materials_export_weight_net = 0;
                                                                                        foreach ($model->material_id as $prev_material_stock) {
                                                                                                $closing_export = \common\models\MaterialUse::find()->where(['material_id' => $prev_material_stock])->andWhere(['<=', 'sell_date', $start_date])->sum('quantity');
                                                                                                ?>
                                                                                                <th style="width:<?= $cc_width ?>%"><?php
                                                                                                        if ($closing_export > 0) {
                                                                                                                echo $closing_export;
                                                                                                        } else {
                                                                                                                echo '-';
                                                                                                        }
                                                                                                        $overall[$prev_material_stock]['export'] += $closing_export;
                                                                                                        $total_materials_export_weight_net += $closing_export;
                                                                                                        ?>
                                                                                                </th>
                                                                                        <?php } ?>
                                                                                </tr>
                                                                        </table>
                                                                </th>

                                                                <th><?= Yii::$app->SetValues->NumberFormat($total_materials_entry_weight_net - $total_materials_export_weight_net); ?></th>
                                                        </tr>






                                                        <?php
                                                        $overall_total += $total_materials_entry_weight_net - $total_materials_export_weight_net;

                                                        for ($i = 0; $i < $month_count; $i++) {

                                                                $start_date = date('Y-m-d', strtotime($start_date . "+1 days"));
                                                                ?>
                                                                <tr>
                                                                        <td><?= date('d-m-Y', strtotime($start_date)); ?></td>
                                                                        <?php
                                                                        $total_mat_count_net = 0;
                                                                        $total_materials_entry_weight_net = 0;

                                                                        foreach ($model->material_id as $material_trip) {
                                                                                $materials_entry = DailyEntry::find()->where(['material' => $material_trip, 'DOC' => $start_date])->all();
                                                                                $total_mat_count = 0;
                                                                                $materials_weight_count = 0;
                                                                                $total_materials_entry_weight = 0;

                                                                                foreach ($materials_entry as $materials_entry_per) {

                                                                                        $materials_entry_count = DailyEntryDetails::find()->where(['daily_entry_id' => $materials_entry_per->id])->count();
                                                                                        $total_mat_count += $materials_entry_count;
                                                                                        $materials_weight_count = DailyEntryDetails::find()->where(['daily_entry_id' => $materials_entry_per->id])->sum('net_weight');
                                                                                        $total_materials_entry_weight += $materials_weight_count;
                                                                                }
                                                                                $total_mat_count_net += $total_mat_count;
                                                                                $total_materials_entry_weight_net += $total_materials_entry_weight;

                                                                                $overall[$material_trip]['trip'] += $total_mat_count;
                                                                                $overall[$material_trip]['weight'] += $total_materials_entry_weight;
                                                                                ?>
                                                                                <td><?php
                                                                                        if ($total_mat_count > 0) {
                                                                                                echo $total_mat_count;
                                                                                        } else {
                                                                                                echo '-';
                                                                                        }
                                                                                        ?></td>
                                                                                <td><?php
                                                                                        if ($total_materials_entry_weight > 0) {
                                                                                                echo Yii::$app->SetValues->NumberFormat($total_materials_entry_weight);
                                                                                        } else {
                                                                                                echo '-';
                                                                                        }
                                                                                        ?>
                                                                                </td>
                                                                                <?php
                                                                        }
                                                                        ?>

                                                                        <th style="padding: 0">
                                                                                <table class="table-responsive table table-small-font table-bordered table-striped" style="margin-bottom: 0">
                                                                                        <tr>
                                                                                                <?php
                                                                                                $total_materials_export_weight_net = 0;
                                                                                                foreach ($model->material_id as $prev_material_stock) {
                                                                                                        $dat_days_use = \common\models\MaterialUse::find()->where(['material_id' => $prev_material_stock, 'sell_date' => $start_date])->sum('quantity');
                                                                                                        ?>
                                                                                                        <td style="width:<?= $cc_width ?>%"><?php
                                                                                                                if ($dat_days_use > 0) {
                                                                                                                        echo $dat_days_use;
                                                                                                                } else {
                                                                                                                        echo '-';
                                                                                                                }
                                                                                                                $overall[$prev_material_stock]['export'] += $dat_days_use;
                                                                                                                $total_materials_export_weight_net += $dat_days_use;
                                                                                                                ?>
                                                                                                        </td>
                                                                                                <?php } ?>
                                                                                        </tr>
                                                                                </table>
                                                                        </th>




                                                                        <td>
                                                                                <?php
                                                                                $overall_total += $total_materials_entry_weight_net - $total_materials_export_weight_net;
                                                                                if ($total_materials_entry_weight_net > 0) {
                                                                                        echo Yii::$app->SetValues->NumberFormat($total_materials_entry_weight_net - $total_materials_export_weight_net);
                                                                                } else {
                                                                                        echo '-';
                                                                                }
                                                                                ?>
                                                                        </td>



                                                                </tr>
                                                        <?php } ?>
                                                        <tr>
                                                                <td></td>
                                                                <?php
                                                                foreach ($model->material_id as $mate) {
                                                                        ?>
                                                                        <th><?= $overall[$mate]['trip'] ?></th>
                                                                        <th><?= Yii::$app->SetValues->NumberFormat($overall[$mate]['weight']); ?></th>
                                                                <?php } ?>

                                                                <th style="padding: 0">
                                                                        <table class="table-responsive table table-small-font table-bordered table-striped" style="margin-bottom: 0">
                                                                                <tr>
                                                                                        <?php
                                                                                        foreach ($model->material_id as $prev_material_stock) {
                                                                                                ?>
                                                                                                <th style="width:<?= $cc_width ?>%"><?= Yii::$app->SetValues->NumberFormat($overall[$prev_material_stock]['export']); ?></th>
                                                                                                <?php } ?>
                                                                                </tr>
                                                                        </table>
                                                                </th>
                                                                <td><b><?= Yii::$app->SetValues->NumberFormat($overall_total); ?></b></td>
                                                        </tr>
                                                </table>
                                        <?php } ?>
                                </div>
                        </div>
                </div>
        </div>
</div>


<script>
        $(document).ready(function () {

                $("#stock-material_id").select2({
                        //   placeholder: 'Select',
                        allowClear: true
                }).on('select2-open', function ()
                {
                        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                });
        });
</script>