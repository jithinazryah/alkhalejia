<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use common\models\Services;
use common\models\Employee;
use common\models\Appointment;
use common\models\Contacts;
use yii\helpers\ArrayHelper;
use yii\db\Expression;
use common\components\AppointmentWidget;

/* @var $this yii\web\View */
/* @var $model common\models\EstimatedProforma */

$this->title = 'Create Estimated Proforma';
$this->params['breadcrumbs'][] = ['label' => 'Estimated Proformas', 'url' => ['index']];
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
                                <?= AppointmentWidget::widget(['id' => $appointment->id]) ?>
                                <hr class="appoint_history" />


                                <!---------------------------------------------------- Generate Print  ------------------------------------------->
                                <div class="col-md-12" style="float: left;">
                                        <div class="row">

                                                <?= Html::beginForm(['appointment/report'], 'post', ['target' => 'print_popup', 'onSubmit' => "window.open('about:blank','print_popup','width=1200,height=600');"]) ?>
                                                <input type="hidden" name="app_id" value="<?= $appointment->id ?>">
                                                <?php
                                                $service_ids = common\models\AppointmentDetails::find()->select('service_id')->distinct()->where(['appointment_id' => $appointment->id])->all();
                                                if (count($service_ids) > 1) {
                                                        ?>
                                                        <div class="col-md-3">

                                                                <select name="service_ids" id="service_ids" class="form-control">
                                                                        <option value="" selected = "selected">Select Service</option>
                                                                        <?php
                                                                        foreach ($service_ids as $service_one) {

                                                                                if ($service_one != '') {
                                                                                        $data = Services::findOne(['id' => $service_one->service_id]);
                                                                                        ?>
                                                                                        <option value="<?= $service_one->service_id ?>"><?= $data->service ?></option>
                                                                                        <?php
                                                                                }
                                                                        }
                                                                        ?>
                                                                </select>
                                                        </div>
                                                        <?php
                                                } else {
                                                        foreach ($service_ids as $service_one) {
                                                                ?>
                                                                <input type="hidden" name="fda" value="<?= $service_one->service_id ?>">
                                                                <?php
                                                        }
                                                }
                                                ?>

                                                <div class="col-md-3">
                                                        <?= Html::submitButton('<i class="fa-print"></i><span>Generate Print</span>', ['class' => 'btn btn-secondary btn-icon btn-icon-standalone']) ?>
                                                        <?= Html::endForm() ?>
                                                        <?php ?>
                                                </div>
                                        </div>
                                        <?php
                                        ?>
                                </div>

                                <!------------------------------------------------------------------------------------------------------------->


                                <!-------------------------------------------------- Menu ----------------------------------------------------------->
                                <ul class="estimat nav nav-tabs nav-tabs-justified">
                                        <li>
                                                <?php
                                                echo Html::a('<span class="visible-xs"><i class="fa-home"></i></span><span class="hidden-xs">Appointment</span>', ['appointment/update', 'id' => $appointment->id]);
                                                ?>

                                        </li>
                                        <li class="active">
                                                <?php
                                                echo Html::a('<span class="visible-xs"><i class="fa-home"></i></span><span class="hidden-xs">Estimated Proforma</span>', ['appointment/add', 'id' => $appointment->id]);
                                                ?>

                                        </li>

                                </ul>

                                <!------------------------------------------------------------------------------------------------------------->


                                <!------------------------------------------- Appointment Details ------------------------------------------------------------------>
                                <div class="outterr">

                                        <div class="table-responsive" data-pattern="priority-columns" data-focus-btn-icon="fa-asterisk" data-sticky-table-header="true" data-add-display-all-btn="true" data-add-focus-btn="true">

                                                <table cellspacing="0" class="table table-small-font table-bordered table-striped">
                                                        <thead>
                                                                <tr>
                                                                        <th data-priority="1">#</th>
                                                                        <th data-priority="1">SERVICES</th>
                                                                        <th data-priority="3">SUPPLIER</th>
                                                                        <th data-priority="1">RATE</th>
                                                                        <th data-priority="1">QUANTITY</th>
                                                                        <th data-priority="1">TOTAL</th>
                                                                        <th data-priority="1">VAT</th>
                                                                        <th data-priority="1">VAT AMOUNT</th>
                                                                        <th data-priority="1">SUB TOTAL</th>
                                                                        <th data-priority="1">ACTIONS</th>
                                                                        <th data-priority="1">PRINT</th>
                                                                </tr>
                                                        </thead>

                                                        <tbody>
                                                                <?php
                                                                $i = 0;
                                                                $grand_epdatotal = 0;
                                                                $grand_tot_subtoatl = 0;
                                                                foreach ($services as $val) {
                                                                        $estimates = common\models\AppointmentDetails::findAll(['appointment_id' => $id, 'service_id' => $val->id]);
                                                                        if (count($estimates) > 0) {
                                                                                ?>
                                                                                <tr>
                                                                                        <td colspan="10"><h5 style="font-weight:bold;color: #008cbd;text-align: left;text-transform: uppercase;"><?= $val->service; ?></h5></td>
                                                                                        <td></td>
                                                                                </tr>
                                                                                <?php
                                                                                $epdatotal = 0;
                                                                                $tot_subtoatl = 0;
                                                                                foreach ($estimates as $estimate) {
                                                                                        $i++;
                                                                                        ?>
                                                                                        <tr>
                                                                                                <td><?= $i; ?></td>
                                                                                                <td class="" drop_id="estimatedproforma-service_id" id="<?= $estimate->id ?>-service_id" val="<?= $estimate->service_id ?>"><?= $estimate->service->service ?></td>
                                                                                                <?php
                                                                                                if ($estimate->supplier != '') {

                                                                                                        if (isset($estimate->service_id) && $estimate->service_id == 1) {
                                                                                                                $selected = common\models\Materials::findOne($estimate->service_id);
                                                                                                        } else {
                                                                                                                $selected = common\models\Contacts::findOne($estimate->service_id);
                                                                                                        }
                                                                                                }
                                                                                                ?>
                                                                                                <td class="" drop_id="estimatedproforma-supplier" id="<?= $estimate->id ?>-supplier" val="<?= $estimate->supplier ?>"> <?= $selected->name ?></td>
                                                                                                <td class="edit_text" id="<?= $estimate->id ?>-unit_rate"  val="<?= $estimate->unit_price ?>">
                                                                                                        <?php
                                                                                                        if ($estimate->unit_price == '') {
                                                                                                                echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                                                                                                        } else {
                                                                                                                echo Yii::$app->SetValues->NumberFormat($estimate->unit_price);
                                                                                                        }
                                                                                                        ?>
                                                                                                </td>
                                                                                                <td  id="<?= $estimate->id ?>-quantity" val="<?= $estimate->quantity ?>"><?php if ($estimate->quantity != '') { ?> <?= $estimate->quantity ?><?php } ?></td>
                                                                                                <td  id="<?= $estimate->id ?>-total" val="<?= $estimate->total ?>"><?php if ($estimate->total != '') { ?> <?= $estimate->total ?><?php } ?></td>
                                                                                                <td  id="<?= $estimate->id ?>-tax" val="<?= $estimate->tax ?>">
                                                                                                        <?php
                                                                                                        if ($estimate->tax != '') {
                                                                                                                $tax = \common\models\Tax::findOne($estimate->tax);
                                                                                                                echo $tax->tax;
                                                                                                        }
                                                                                                        ?>
                                                                                                </td>
                                                                                                <td  id="<?= $estimate->id ?>-tax_amount" val="<?= $estimate->tax_amount ?>"><?php if ($estimate->tax_amount != '') { ?> <?= $estimate->tax_amount ?><?php } ?></td>
                                                                                                <td id="<?= $estimate->id ?>-sub_total" val="<?= $estimate->sub_total ?>"><?php if ($estimate->sub_total != '') { ?> <?= $estimate->sub_total ?><?php } ?></td>

                                                                                                <td>
                                                                                                        <?php
                                                                                                        if ($appointment->status != 0) {
                                                                                                                ?>
                                                                                                                <?= Html::a('<i class="fa fa-pencil"></i>', ['/appointment/appointment/add', 'id' => $id, 'prfrma_id' => $estimate->id], ['class' => '', 'tittle' => 'Edit']) ?>
                                                                                                                <?= Html::a('<i class="fa fa-remove"></i>', ['/appointment/appointment/delete-detail', 'id' => $estimate->id], ['class' => '', 'tittle' => 'Edit', 'data-confirm' => 'Are you sure you want to delete this item?']) ?>
                                                                                                        <?php } ?>
                                                                                                </td>

                                                                                                <td>
                                                                                                        <?= Html::beginForm(['appointment/selected-report'], 'post', ['target' => 'print_popup', 'onSubmit' => "window.open('about:blank','print_popup','width=1200,height=600');"]) ?>
                                                                                                        <input type="checkbox" name="invoice_type[<?= $estimate->id ?>]" value="<?= $estimate->service_id ?>">
                                                                                                        <input type="hidden" name="app_id" value="<?= $appointment->id ?>">
                                                                                                </td>
                                                                                                <?php
                                                                                                $epdatotal += $estimate->total;
                                                                                                $tot_subtoatl += $estimate->sub_total;
                                                                                                $grand_epdatotal += $estimate->total;
                                                                                                $grand_tot_subtoatl += $estimate->sub_total;
                                                                                                ?>
                                                                                        </tr>
                                                                                <?php } ?>

                                                                                <tr>
                                                                                        <td></td>
                                                                                        <td colspan="4"> <b>SUB TOTAL</b></td>
                                                                                        <td><?php echo $epdatotal . '/-'; ?></td>
                                                                                        <td colspan=""></td>
                                                                                        <td colspan=""></td>
                                                                                        <td><?php echo $tot_subtoatl . '/-'; ?></td>
                                                                                        <td colspan=""></td>
                                                                                        <td colspan="">
                                                                                        </td>
                                                                                </tr>

                                                                                <?php
                                                                        }
                                                                }
                                                                ?>


                                                                <tr>
                                                                        <td></td>
                                                                        <td colspan="4"> <b>GRAND TOTAL</b></td>
                                                                        <td style="font-weight: bold;"><?php echo $grand_epdatotal . '/-'; ?></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td style="font-weight: bold;"><?php echo $grand_tot_subtoatl . '/-'; ?>
                                                                        <td colspan=""></td>
                                                                        <td colspan="">
                                                                                <?= Html::submitButton('<i class="fa-print"></i><span>Print</span>', ['class' => 'btn btn-secondary btn-icon btn-icon-standalone']) ?>
                                                                                <?= Html::endForm() ?>
                                                                        </td>
                                                                </tr>
                                                                <?php
                                                                if ($appointment->status != 0) {
                                                                        ?>

                                                                        <tr class="formm">
                                                                                <?php $form = ActiveForm::begin(); ?>
                                                                                <td></td>
                                                                                <td><?= $form->field($model, 'service_id')->dropDownList(ArrayHelper::map(Services::findAll(['status' => 1]), 'id', 'service'), ['prompt' => '-Service-'])->label(false); ?></td>
                                                                                <?php
                                                                                $contacts = Contacts::find()->where(['status' => 1])->all();

                                                                                if (isset($model->service_id) && $model->service_id == 1) {
                                                                                        $contacts = common\models\Materials::find()->where(['status' => 1])->all();
                                                                                }
                                                                                ?>
                                                                                <td><?= $form->field($model, 'supplier')->dropDownList(ArrayHelper::map($contacts, 'id', 'name'), ['prompt' => '-Select-'])->label(false); ?></td>
                                                                                <td><?= $form->field($model, 'unit_price')->textInput(['placeholder' => ' Rate'])->label(false) ?></td>
                                                                                <td><?= $form->field($model, 'quantity')->textInput(['placeholder' => 'Quantity'])->label(false) ?></td>
                                                                                <td><?= $form->field($model, 'total')->textInput(['placeholder' => 'Total'])->label(false) ?></td>
                                                                                <td><?= $form->field($model, 'tax')->dropDownList(ArrayHelper::map(common\models\Tax::findAll(['status' => 1]), 'id', 'tax'), ['prompt' => '-VAT-'])->label(false); ?></td>
                                                                                <td><?= $form->field($model, 'tax_amount')->textInput(['placeholder' => 'Vat Amount'])->label(false) ?></td>
                                                                                <td><?= $form->field($model, 'sub_total')->textInput(['placeholder' => 'Sub Total'])->label(false) ?></td>
                                                                                <td><?= Html::submitButton($model->isNewRecord ? 'Add' : 'Update', ['class' => 'btn btn-success']) ?>
                                                                                </td>
                                                                                <td></td>
                                                                                <?php ActiveForm::end(); ?>
                                                                        </tr>
                                                                        <tr></tr>
                                                                <?php } ?>


                                                        </tbody>

                                                </table>
                                        </div>

                                </div>

                                <!------------------------------------------------------------------------------------------------------------->

                                <?php
                                if ($appointment->status != 0) {
                                        ?>
                                        <div style="float:right;padding-top: 5px;">
                                                <?php
                                                echo Html::a('<span> Close Appointment</span>', ['appointment/close-appointment', 'id' => $appointment->id], ['class' => 'btn btn-secondary']);
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
                padding: inherit;padding: 0px 4px;
        }
        .error{
                color: #0553b1;
                padding-bottom: 5px;
                font-size: 18px;
                font-weight: bold;
        }

</style>


