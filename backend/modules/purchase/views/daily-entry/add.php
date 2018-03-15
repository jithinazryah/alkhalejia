<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use common\models\Services;
use common\models\DailyEntry;
use common\models\DailyEntryDetails;
use common\models\Contacts;
use yii\helpers\ArrayHelper;
use common\components\DailyEntryWidget;

/* @var $this yii\web\View */
/* @var $model common\models\EstimatedProforma */

$this->title = 'Add Daily Entry Details';
$this->params['breadcrumbs'][] = ['label' => 'Daily Entry Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .form-group {
        margin-bottom: 0px;
    }
</style>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h2  class="appoint-title panel-title"><?= Html::encode($this->title) . ' # <b style="color: #008cbd;">' . $appointment->appointment_number . '</b>' ?></h2>

            </div>
            <?php //Pjax::begin();     ?>
            <div class="panel-body">
                <?= DailyEntryWidget::widget(['id' => $daily_entry->id]) ?>
                <hr class="appoint_history" />


                <!---------------------------------------------------- Generate Print  ------------------------------------------->

                <!------------------------------------------------------------------------------------------------------------->


                <!-------------------------------------------------- Menu ----------------------------------------------------------->
                <ul class="estimat nav nav-tabs nav-tabs-justified">
                    <li>
                        <?php
                        echo Html::a('<span class="visible-xs"><i class="fa-home"></i></span><span class="hidden-xs">Daily Entry</span>', ['daily-entry/update', 'id' => $daily_entry->id]);
                        ?>

                    </li>
                    <li class="active">
                        <?php
                        echo Html::a('<span class="visible-xs"><i class="fa-home"></i></span><span class="hidden-xs">Daily Entry Details</span>', ['daily-entry/add', 'id' => $daily_entry->id]);
                        ?>

                    </li>

                </ul>

                <!------------------------------------------------------------------------------------------------------------->


                <!------------------------------------------- Daily Entry Details ------------------------------------------------------------------>
                <?php
//                Pjax::begin(['id' => 'some_pjax_id']);
                ?>
                <div class="outterr">

                    <div class="table-responsive" data-pattern="priority-columns" data-focus-btn-icon="fa-asterisk" data-sticky-table-header="true" data-add-display-all-btn="true" data-add-focus-btn="true">

                        <table cellspacing="0" class="table table-small-font table-bordered table-striped" id="daily-entry-table">
                            <thead>
                                <tr>
                                    <th data-priority="1" style="width:2%">#</th>
                                    <th data-priority="1" style="width:10%">TICKET NO</th>
                                    <th data-priority="3" style="width:10%">TRUCK NO</th>
                                    <th data-priority="1" style="width:8%">NET WEIGHT</th>
                                    <th data-priority="1" style="width:10%">RATE</th>
                                    <th data-priority="1" style="width:13%">VAT</th>
                                    <th data-priority="1" style="width:5%;display: none;">VAT AMOUNT</th>
                                    <th data-priority="1" style="width:10%">TOTAL</th>
                                    <th data-priority="1" style="width:10%">PER TON</th>
                                    <th data-priority="1" style="width:10%;">TRANSPORTER AMOUNT</th>
                                    <th data-priority="1">DESCRIPTION</th>
                                    <th data-priority="1" style="width:5%">ACTIONS</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php
                                $epdatotal = 0;
                                $tot_subtoatl = 0;
                                foreach ($estimates as $estimate) {
                                    $i++;
                                    ?>

                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $estimate->ticket_no; ?></td>
                                        <td><?= $estimate->truck_number; ?></td>
                                        <td class="edit_daily txt-align-right" id="<?= $estimate->id ?>-net_weight" val="<?= $estimate->net_weight; ?>"><?= Yii::$app->SetValues->NumberFormat($estimate->net_weight); ?></td>
                                        <td class="edit_daily txt-align-right" id="<?= $estimate->id ?>-rate" val="<?= $estimate->rate ?>"><?= $estimate->rate; ?></td>
                                        <td  class="txt-align-right" id="<?= $estimate->id ?>-tax" val="<?= $estimate->tax_id ?>">

                                            <?php
                                            $tax = \common\models\Tax::findOne($estimate->tax_id);
                                            if ($estimate->tax_amount != '') {
                                                ?> <?= $estimate->tax_amount . ' (' . $tax->value . '%)' ?><?php } ?>
                                        </td>
                                        <td style="display:none" id="<?= $estimate->id ?>-tax_amount" val="<?= $estimate->tax_amount ?>"><?php if ($estimate->tax_amount != '') { ?> <?= $estimate->tax_amount ?><?php } ?></td>
                                        <td class="txt-align-right"><?= $estimate->total; ?></td>
                                        <td class="txt-align-right"><?= $estimate->per_ton; ?></td>
                                        <td class="edit_daily txt-align-right" id="<?= $estimate->id ?>-transport_amount" val="<?= $estimate->transport_amount ?>"><?= $estimate->transport_amount; ?></td>
                                        <td><?= $estimate->description; ?></td>
                                        <td>
                                            <?php
                                            if ($daily_entry->status != 0) {
                                                ?>
                                                <?= Html::a('<i class="fa fa-pencil"></i>', ['/purchase/daily-entry/add', 'id' => $id, 'prfrma_id' => $estimate->id], ['class' => '', 'tittle' => 'Edit']) ?>
                                                <?php // Html::a('<i class="fa fa-remove"></i>', ['/purchase/daily-entry/delete-detail', 'id' => $estimate->id], ['class' => '', 'tittle' => 'Edit', 'data-confirm' => 'Are you sure you want to delete this item?']) ?>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>



                                <tr class="formm">
                                    <?php $form = ActiveForm::begin(); ?>
                                    <td></td>
                                    <td><?= $form->field($model, 'ticket_no', ['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1', 'placeholder' => ' Ticket No', 'required' => TRUE]])->label(false) ?></td>
                                    <td><?= $form->field($model, 'truck_number', ['inputOptions' => ['class' => 'form-control', 'tabindex' => '2', 'placeholder' => ' Truck No', 'required' => TRUE]])->label(false) ?></td>
                                    <td><?= $form->field($model, 'net_weight', ['inputOptions' => ['class' => 'form-control', 'tabindex' => '3', 'placeholder' => ' Net Weight', 'required' => TRUE]])->label(false) ?></td>
                                    <td><?= $form->field($model, 'rate', ['inputOptions' => ['class' => 'form-control', 'tabindex' => '4', 'placeholder' => ' Rate', 'required' => TRUE]])->label(false) ?></td>
                                    <td>
                                        <div class="row" id="daily-tax">
                                            <div class="col-md-6" style="padding: 0px;"><?= $form->field($model, 'tax_id')->dropDownList(ArrayHelper::map(common\models\Tax::find(['status' => 1])->orderBy(['id' => SORT_DESC])->all(), 'id', 'taxname'), ['style' => 'border:none'])->label(false); ?></div>
                                            <div class="col-md-6" style="padding-top: 9px;"><span id="tax-amount-show"></span></div>
                                        </div>
                                    </td>
                                    <td style="display:none"><?= $form->field($model, 'tax_amount')->textInput(['placeholder' => 'Vat Amount', 'readonly' => true])->label(false) ?></td>
                                    <td><?= $form->field($model, 'total', ['inputOptions' => ['class' => 'form-control', 'tabindex' => '', 'placeholder' => ' Total', 'required' => TRUE, 'readonly' => TRUE]])->label(false) ?></td>
                                    <td><?= $form->field($model, 'per_ton', ['inputOptions' => ['class' => 'form-control', 'tabindex' => '5', 'placeholder' => ' Per Ton', 'required' => TRUE]])->label(false) ?></td>
                                    <td><?= $form->field($model, 'transport_amount', ['inputOptions' => ['class' => 'form-control', 'tabindex' => '-1', 'placeholder' => ' Transporter Amount', 'required' => TRUE, 'readonly' => TRUE]])->label(false) ?></td>
                                    <td><?= $form->field($model, 'description', ['inputOptions' => ['class' => 'form-control', 'tabindex' => '6', 'placeholder' => ' Description']])->label(false) ?></td>
                                    <td><?= Html::submitButton($model->isNewRecord ? 'Add' : 'Update', ['class' => 'btn btn-success']) ?>
                                    </td>

                                    <?php ActiveForm::end(); ?>
                                </tr>
                                <tr></tr>



                            </tbody>

                        </table>

                    </div>

                </div>
                <?php // Pjax::end();   ?>

                <!------------------------------------------------------------------------------------------------------------->

                <?php
                if ($appointment->status != 0) {
                    ?>
                    <div style="float:right;padding-top: 5px;">
                        <?php
                        echo Html::a('<span> Confirm and Close</span>', ['appointment/close-appointment', 'id' => $appointment->id], ['class' => 'btn btn-secondary']);
                        ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>



<style>
    .filter{
        background-color: #b9c7a7;
    }
    table.table tr td:last-child a {
        padding: inherit;padding: 4px 4px;
    }
    .error{
        color: #0553b1;
        padding-bottom: 5px;
        font-size: 18px;
        font-weight: bold;
    }.field-appointmentdetails-tax{
        width:65%!important;
        display: inline-block;
    }.field-appointmentdetails-quantity{
        width:70%!important;
        display: inline-block;
    } .formm td{
        padding: 5px !important;
    }

</style>
<script>
    $("document").ready(function () {

        /*
         * Double click enter function
         * */

        $('#dailyentrydetails-net_weight').on('keyup', function () {
            var net_weight = $('#dailyentrydetails-net_weight').val();
            var rate = $('#dailyentrydetails-rate').val();
            if (net_weight === undefined || net_weight === null) {
                // do something
            }
        });

    });
</script>
<script>
    $(document).ready(function () {
        $("#dailyentrydetails-net_weight").keyup(function () {
            multiply();
        });
        $("#dailyentrydetails-rate").keyup(function () {
            multiply();
        });
        $("#dailyentrydetails-per_ton").keyup(function () {
            CalculateTransporter();
        });
        $("#dailyentrydetails-net_weight").keyup(function () {
            CalculateTransporter();
        });
    });
    function CalculateTransporter() {
        var per_ton = $("#dailyentrydetails-per_ton").val();
        var weight = $("#dailyentrydetails-net_weight").val();
        if (weight != '' && per_ton != '') {
            $("#dailyentrydetails-transport_amount").val(per_ton * weight);
        }

    }
    function multiply() {
        var rate = $("#dailyentrydetails-rate").val();
        var unit = $("#dailyentrydetails-net_weight").val();
        if (rate != '' && unit != '') {
            $("#dailyentrydetails-total").val(rate * unit);
        }

    }
</script>


