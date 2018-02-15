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
                                $date = date('d-m-Y', strtotime($model->DOC));
                            } else {
                                $date = date('d-m-Y');
                            }
                            ?>

                            <?=
                            $form->field($model, 'DOC')->widget(DatePicker::className(), [
                                'options' => ['class' => 'form-control'],
                                'value' => $date,
                                'pluginOptions' => [
                                    'autoclose' => true,
                                    'format' => 'dd-mm-yyyy',
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
                        $contacts = \common\models\Contacts::find()->where(['status' => 1, 'type' => 2, 'service' => 1])->all();
                        ?>
                        <h4 style="color: #1c5382;margin-bottom: 15px;">Report <?= date('d-m-Y', strtotime($model->DOC)) ?> :</h4>
                        <table class='table-responsive table table-small-font table-bordered table-striped'>
                            <tr>
                                <th>Crusher</th>
                                <?php
                                foreach ($model->material_id as $value) {
                                    $material_detail = Materials::findOne($value);
                                    ?>
                                    <th><?= $material_detail->name ?></th>
                                <?php } ?>
                                <th>Total</th>
                            </tr>
                            <?php
                            $c = 0;
                            foreach ($contacts as $crusher) {
                                $crusher_detail = \common\models\Contacts::findOne($crusher->id);

                                $total_material_entry_count = 0;
                                foreach ($model->material_id as $material_trip) {
                                    $materials_entry = DailyEntry::find()->where(['material' => $material_trip, 'supplier' => $crusher->id, 'DOC' => $model->DOC, 'status' => 1])->all();

                                    $materials_entry_count = 0;
                                    foreach ($materials_entry as $materials_entry_per) {
                                        $materials_entry_count = DailyEntryDetails::find()->where(['daily_entry_id' => $materials_entry_per->id])->count();
                                    }
                                    $total_material_entry_count += $materials_entry_count;
                                }
                                if ($total_material_entry_count > 0) {
                                    $c++;
                                    ?>


                                    <tr>
                                        <td colspan="3"><h5 style="font-weight:bold;color: #008cbd;text-align: left;text-transform: uppercase;"><?= $crusher_detail->name ?></h5></td>
                                    </tr>



                                    <tr>
                                        <td>Trips</td>
                                        <?php
                                        $total_mat_count_net = 0;
                                        foreach ($model->material_id as $material_trip) {
                                            $materials_entry = DailyEntry::find()->where(['material' => $material_trip, 'supplier' => $crusher->id, 'DOC' => $model->DOC, 'status' => 1])->all();
                                            $materials_entry_count = 0;
                                            $total_mat_count = 0;
                                            $j = 0;
                                            foreach ($materials_entry as $materials_entry_per) {
                                                $j++;

                                                $materials_entry_count = DailyEntryDetails::find()->where(['daily_entry_id' => $materials_entry_per->id])->count();
                                                $total_mat_count += $materials_entry_count;
                                            }
                                            $total_mat_count_net += $total_mat_count;
                                            ?>
                                            <td><?= $total_mat_count ?></td>
                                            <?php
                                        }
                                        ?>
                                        <td><?= $total_mat_count_net ?></td>
                                    </tr>

                                    <tr>
                                        <td>Net Weight</td>
                                        <?php
                                        $total_materials_entry_weight_net = 0;
                                        foreach ($model->material_id as $material_weight) {
                                            $total_materials_entry_weight = 0;
                                            $materials_entry_weight = DailyEntry::find()->where(['material' => $material_weight, 'supplier' => $crusher->id, 'DOC' => $model->DOC])->all();
                                            $materials_weight_count = 0;
                                            foreach ($materials_entry_weight as $materials_weight_per) {
                                                $materials_weight_count = DailyEntryDetails::find()->where(['daily_entry_id' => $materials_weight_per->id])->sum('net_weight');
                                                $total_materials_entry_weight += $materials_weight_count;
                                            }
                                            $total_materials_entry_weight_net += $total_materials_entry_weight;
                                            ?>
                                            <td><?= Yii::$app->SetValues->NumberFormat($total_materials_entry_weight); ?></td>

                                        <?php } ?>
                                        <td><?= Yii::$app->SetValues->NumberFormat($total_materials_entry_weight_net); ?></td>
                                    </tr>


                                    <?php
                                }
                            }
                            ?>


                            <?php
                            $previous_date = date('Y-m-d', strtotime($model->DOC . "-1 days"));
                            ?>
                            <tr>
                                <td><?= date('d-m-Y', strtotime($previous_date)) ?></td>
                                <?php
                                $previous_stock = 0;
                                $total_previous_stock_net = 0;
                                foreach ($model->material_id as $material_previous) {
                                    $total_previous_stock = 0;
                                    $previous_stock = \common\models\Stock::find()->where(['transaction_type' => 3])->andWhere(['material_id' => $material_previous])->andWhere(['<>', 'DOC', $model->DOC])->sum('quantity_in');

                                    $total_previous_stock += $previous_stock;
                                    $total_previous_stock_net += $total_previous_stock;
                                    ?>

                                    <td><?= Yii::$app->SetValues->NumberFormat($total_previous_stock); ?></td>
                                <?php } ?>
                                <td><?= Yii::$app->SetValues->NumberFormat($total_previous_stock_net); ?></td>
                            </tr>


                            <tr>
                                <td><?= date('d-m-Y', strtotime($model->DOC)) ?></td>
                                <?php
                                $stock = 0;
                                $total_stock_net = 0;
                                foreach ($model->material_id as $material_stock) {
                                    $total_stock = 0;
                                    $stock = \common\models\Stock::find()->where(['transaction_type' => 3])->andWhere(['material_id' => $material_stock])->sum('quantity_in');
                                    $total_stock += $stock;
                                    $total_stock_net += $total_stock;
                                    ?>

                                    <td><?= Yii::$app->SetValues->NumberFormat($total_stock); ?></td>
                                <?php } ?>
                                <td><?= Yii::$app->SetValues->NumberFormat($total_stock_net); ?></td>

                            </tr>

                            <tr>
                                <td>Export</td>
                                <?php
                                $material_exported = 0;
                                $total_material_exported_net = 0;
                                foreach ($model->material_id as $material_exported) {
                                    $total_material_exported = 0;
                                    $material_exported = common\models\MaterialUse::find()->where(['sell_date' => $model->DOC])->andWhere(['material_id' => $material_exported])->sum('quantity');
                                    $total_material_exported += $material_exported;
                                    $total_material_exported_net += $total_material_exported;
                                    ?>
                                    <td><?= Yii::$app->SetValues->NumberFormat($total_material_exported); ?></td>
                                <?php } ?>
                                <td><?= Yii::$app->SetValues->NumberFormat($total_material_exported_net); ?></td>
                            </tr>

                            <tr style="font-weight: bold">
                                <td>Total Net</td>
                                <?php
                                $total_net_material_exported = 0;
                                $total__net_material_stock = 0;
                                $net_material_exported = 0;
                                $net_material_stock = 0;
                                foreach ($model->material_id as $material_net) {
                                    $net_material_exported = common\models\MaterialUse::find()->where(['sell_date' => $model->DOC])->andWhere(['material_id' => $material_net])->sum('quantity');
                                    $total_net_material_exported += $net_material_exported;
                                    $net_material_stock = \common\models\Stock::find()->where(['transaction_type' => 3])->andWhere(['material_id' => $material_net])->sum('quantity_in');
                                    $total__net_material_stock += $net_material_stock;
                                    ?>
                                    <td><?= Yii::$app->SetValues->NumberFormat($net_material_stock - $net_material_exported); ?></td>
                                <?php } ?>
                                <td><?= Yii::$app->SetValues->NumberFormat($total__net_material_stock - $total_net_material_exported); ?></td>
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