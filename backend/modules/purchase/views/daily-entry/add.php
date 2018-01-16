<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use common\models\Services;
use common\models\DailyEntry;
use common\models\DailyEntryDetails;
use common\models\Contacts;
use yii\helpers\ArrayHelper;
use yii\db\Expression;
use common\components\DailyEntryWidget;

/* @var $this yii\web\View */
/* @var $model common\models\EstimatedProforma */

$this->title = 'Add Daily Entry Details';
$this->params['breadcrumbs'][] = ['label' => 'Daily Entry Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

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
                Pjax::begin(['id' => 'some_pjax_id']);
                ?>
                <div class="outterr">

                    <div class="table-responsive" data-pattern="priority-columns" data-focus-btn-icon="fa-asterisk" data-sticky-table-header="true" data-add-display-all-btn="true" data-add-focus-btn="true">

                        <table cellspacing="0" class="table table-small-font table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th data-priority="1">#</th>
                                    <th data-priority="1" style="width:10%">TICKET NO</th>
                                    <th data-priority="3" style="width:10%">TRUCK NO</th>
                                    <th data-priority="1" style="width:8%">NET WEIGHT</th>
                                    <th data-priority="1" style="width:10%">RATE</th>
                                    <th data-priority="1" style="width:8%">TOTAL</th>
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
                                        <td><?= $estimate->net_weight; ?></td>
                                        <td><?= $estimate->rate; ?></td>
                                        <td><?= $estimate->total; ?></td>
                                        <td><?= $estimate->transport_amount; ?></td>
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
                                <?php
                                if ($daily_entry->status != 0) {
                                    ?>

                                    <tr class="formm">
                                        <?php $form = ActiveForm::begin(); ?>
                                        <td></td>
                                        <td><?= $form->field($model, 'ticket_no')->textInput(['placeholder' => ' Ticket No'])->label(false) ?></td>
                                        <td><?= $form->field($model, 'truck_number')->textInput(['placeholder' => ' Truck No'])->label(false) ?></td>
                                        <td><?= $form->field($model, 'net_weight')->textInput(['placeholder' => ' Net Weight'])->label(false) ?></td>
                                        <td><?= $form->field($model, 'rate')->textInput(['placeholder' => ' Rate'])->label(false) ?></td>
                                        <td><?= $form->field($model, 'total')->textInput(['placeholder' => ' Total'])->label(false) ?></td>
                                        <td><?= $form->field($model, 'transport_amount')->textInput(['placeholder' => ' Transporter Amount'])->label(false) ?></td>
                                        <td><?= $form->field($model, 'description')->textInput(['placeholder' => ' Description'])->label(false) ?></td>
                                        <td><?= Html::submitButton($model->isNewRecord ? 'Add' : 'Update', ['class' => 'btn btn-success']) ?>
                                        </td>

                                        <?php ActiveForm::end(); ?>
                                    </tr>
                                    <tr></tr>
                                <?php } ?>


                            </tbody>

                        </table>
                    </div>

                </div>
                <?php Pjax::end(); ?>

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
    }

</style>


