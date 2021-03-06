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

$this->title = 'Create Service';
$this->params['breadcrumbs'][] = ['label' => 'Estimated Proformas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    #invoice_format-div{
        display: none;
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
                <?= AppointmentWidget::widget(['id' => $appointment->id]) ?>
                <hr class="appoint_history" />


                <!---------------------------------------------------- Generate Print  ------------------------------------------->
                <div class="col-md-12" style="float: left;">
                    <div class="row">

                        <?= Html::beginForm(['appointment/report'], 'post', ['target' => 'print_popup', 'onSubmit' => "window.open('about:blank','print_popup','width=1200,height=600');"]) ?>
                        <input type="hidden" name="app_id" value="<?= $appointment->id ?>">
                        <?php
                        $service_ids = common\models\AppointmentDetails::find()->select('service_id')->distinct()->where(['appointment_id' => $appointment->id])->all();
                        if (count($service_ids) >= 1) {
                            ?>
                            <div class="col-md-3">

                                <select name="service_ids" id="service_ids" class="form-control" required>
                                    <option value="" selected = "selected">Select Service</option>
                                    <?php
                                    foreach ($service_ids as $service_one) {

                                        if ($service_one != '') {
                                            $data = \common\models\TransactionCategory::findOne(['id' => $service_one->service_id]);
                                            ?>
                                            <option value="<?= $service_one->service_id ?>"><?= $data->category ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-3" id="invoice_format-div">

                                <select name="invoice_formats" id="invoice_formats" class="form-control">
                                    <option value="1" selected = "selected">English</option>
                                    <option value="2">Arabic</option>
                                </select>
                            </div>
                            <?php
                        } else {
                            foreach ($service_ids as $service_one) {
                                ?>
                                <input type="hidden" name="service_ids" value="<?= $service_one->service_id ?>">
                                <?php
                            }
                        }
                        ?>

                        <div class="col-md-3">
                            <?= Html::submitButton('<i class="fa-print"></i><span>Generate Invoice</span>', ['class' => 'btn btn-secondary btn-icon btn-icon-standalone']) ?>
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
                        echo Html::a('<span class="visible-xs"><i class="fa-home"></i></span><span class="hidden-xs">Voyage Details</span>', ['appointment/update', 'id' => $appointment->id]);
                        ?>

                    </li>
                    <li class="active">
                        <?php
                        echo Html::a('<span class="visible-xs"><i class="fa-home"></i></span><span class="hidden-xs">Services</span>', ['appointment/add', 'id' => $appointment->id]);
                        ?>

                    </li>

                </ul>

                <!------------------------------------------------------------------------------------------------------------->


                <!------------------------------------------- Appointment Details ------------------------------------------------------------------>
                <?php
//                                Pjax::begin(['id' => 'some_pjax_id']);
                ?>
                <div class="outterr">

                    <div class="table-responsive" data-pattern="priority-columns" data-focus-btn-icon="fa-asterisk" data-sticky-table-header="true" data-add-display-all-btn="true" data-add-focus-btn="true">

                        <table cellspacing="0" class="table table-small-font table-bordered table-striped" id="appointment-table">
                            <thead>
                                <tr>
                                    <th data-priority="1" style="width:2%">#</th>
                                    <th data-priority="1" style="width:10%">SERVICES</th>
                                    <th data-priority="3" style="width:10%">SUPPLIER</th>
                                    <th data-priority="1" style="width:8%">RATE</th>
                                    <th data-priority="1" style="width:5%">QUANTITY</th>
                                    <th data-priority="1" style="width:8%">TOTAL</th>
                                    <th data-priority="1" style="width:10%;">VAT</th>
                                    <th data-priority="1" style="width:5%;display: none;">VAT AMOUNT</th>
                                    <th data-priority="1" style="width:8%">SUB TOTAL</th>
                                    <th data-priority="1">COMMENT</th>
                                    <th data-priority="1" style="width:5%">ACTIONS</th>
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
                                            <td colspan="9"><h5 style="font-weight:bold;color: #008cbd;text-align: left;text-transform: uppercase;"><?= $val->category; ?></h5></td>
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
                                                <td class="" drop_id="estimatedproforma-service_id" id="<?= $estimate->id ?>-service_id" val="<?= $estimate->service_id ?>"><?= $val->category ?></td>
                                                <?php
                                                if ($estimate->supplier != '') {

                                                    if (isset($estimate->service_id) && $estimate->service_id == 16) {
                                                        $selected = common\models\Materials::findOne($estimate->supplier);
                                                    } else {
                                                        $selected = common\models\Contacts::findOne($estimate->supplier);
                                                    }
                                                }
                                                ?>
                                                <td class="" drop_id="estimatedproforma-supplier" id="<?= $estimate->id ?>-supplier" val="<?= $estimate->supplier ?>"> <?= $selected->name ?></td>
                                                <td class="edit_text txt-align-right" id="<?= $estimate->id ?>-unit_price"  val="<?= $estimate->unit_price ?>">
                                                    <?php
                                                    if ($estimate->unit_price == '') {
                                                        echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                                                    } else {
                                                        echo Yii::$app->SetValues->NumberFormat($estimate->unit_price);
                                                    }
                                                    ?>
                                                </td>
                                                <td class="edit_text txt-align-right" id="<?= $estimate->id ?>-quantity" val="<?= $estimate->quantity ?>">
                                                    <?php
                                                    if ($estimate->quantity != '') {
                                                        if (isset($estimate->unit) && $estimate->unit != '') {
                                                            $unit_detail = common\models\Units::findOne($estimate->unit);
                                                            echo $estimate->quantity . ' (' . $unit_detail->unit_symbol . ')';
                                                        } else {
                                                            echo $estimate->quantity;
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td  class="txt-align-right" id="<?= $estimate->id ?>-total" val="<?= $estimate->total ?>"><?php if ($estimate->total != '') { ?> <?= $estimate->total ?><?php } ?></td>
                                                <td  class="txt-align-right" id="<?= $estimate->id ?>-tax" val="<?= $estimate->tax ?>">

                                                    <?php
                                                    $tax = \common\models\Tax::findOne($estimate->tax);
                                                    if ($estimate->tax_amount != '') {
                                                        ?> <?= $estimate->tax_amount . ' (' . $tax->value . '%)' ?><?php } ?>
                                                </td>
                                                <td style="display:none" id="<?= $estimate->id ?>-tax_amount" val="<?= $estimate->tax_amount ?>"><?php if ($estimate->tax_amount != '') { ?> <?= $estimate->tax_amount ?><?php } ?></td>
                                                <td class="txt-align-right" id="<?= $estimate->id ?>-sub_total" val="<?= $estimate->sub_total ?>"><?php if ($estimate->sub_total != '') { ?> <?= $estimate->sub_total ?><?php } ?></td>
                                                <td class="edit_text" id="<?= $estimate->id ?>-description" val="<?= $estimate->description ?>"><?php if ($estimate->description != '') { ?> <span title="<?= $estimate->description ?>"><?= substr($estimate->description, 0, 30) . '...'; ?></span><?php } ?></td>

                                                <td>
                                                    <?php
                                                    if ($appointment->status != 0) {
                                                        ?>
                                                        <?= Html::a('<i class="fa fa-pencil"></i>', ['/appointment/appointment/add', 'id' => $id, 'prfrma_id' => $estimate->id], ['class' => '', 'tittle' => 'Edit']) ?>
                                                        <?= Html::a('<i class="fa fa-remove"></i>', ['/appointment/appointment/delete-detail', 'id' => $estimate->id], ['class' => '', 'tittle' => 'Edit', 'data-confirm' => 'Are you sure you want to delete this item?']) ?>
                                                    <?php } ?>
                                                    <a>
                                                        <?= Html::beginForm(['appointment/selected-report'], 'post', ['target' => 'print_popup', 'onSubmit' => "window.open('about:blank','print_popup','width=1200,height=600');",]) ?>
                                                        <input type="checkbox" name="invoice_type[<?= $estimate->id ?>]" value="<?= $estimate->service_id ?>">
                                                        <input type="hidden" name="app_id" value="<?= $appointment->id ?>">
                                                    </a>
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
                                            <td class="txt-align-right"><?php echo Yii::$app->SetValues->NumberFormat($epdatotal) . '/-'; ?></td>
                                            <td colspan=""></td>
                                            <td colspan="" style="display:none"></td>
                                            <td class="txt-align-right"><?php echo Yii::$app->SetValues->NumberFormat($tot_subtoatl) . '/-'; ?></td>
                                            <td colspan=""></td>
                                            <td colspan=""></td>

                                        </tr>

                                        <?php
                                    }
                                }
                                ?>


                                <tr>
                                    <td></td>
                                    <td colspan="4"> <b>GRAND TOTAL</b></td>
                                    <td class="txt-align-right" style="font-weight: bold;"><?php echo Yii::$app->SetValues->NumberFormat($grand_epdatotal) . '/-'; ?></td>
                                    <td></td>
                                    <td style="display:none"></td>
                                    <td class="txt-align-right" style="font-weight: bold;"><?php echo Yii::$app->SetValues->NumberFormat($grand_tot_subtoatl) . '/-'; ?>
                                    <td colspan=""></td>
                                    <td colspan="">
                                        <?= Html::submitButton('<i class="fa-print"></i><span></span>', ['class' => 'btn btn-secondary',]) ?>
                                        <?= Html::endForm() ?>
                                    </td>

                                </tr>
                                <?php
                                if ($appointment->status != 0) {
                                    ?>

                                    <tr class="formm">
                                        <?php $form = ActiveForm::begin(); ?>
                                        <td></td>
                                        <td><?= $form->field($model, 'service_id')->dropDownList(ArrayHelper::map(common\models\TransactionCategory::find()->where(['status' => 1])->andWhere(['<>', 'id', 1])->orderBy(['sort_order' => SORT_ASC])->all(), 'id', 'category'), ['prompt' => '-Service-'])->label(false); ?></td>
                                        <?php
                                        $contacts = Contacts::find()->where(['status' => 1])->all();
                                        if (isset($model->service_id) && $model->service_id == 1) {
                                            $contacts = common\models\Materials::find()->where(['status' => 1])->all();
                                        }
                                        ?>
                                        <td><?= $form->field($model, 'supplier')->dropDownList(ArrayHelper::map($contacts, 'id', 'name'), ['prompt' => '-Select-'])->label(false); ?></td>
                                        <td><?= $form->field($model, 'unit_price')->textInput(['placeholder' => ' Rate'])->label(false) ?></td>
                                        <td><?= $form->field($model, 'quantity')->textInput(['placeholder' => 'Quantity', 'value' => 1,])->label(false) ?><span id="unit-text" style="margin-left:5px"></span></td>
                                        <td><?= $form->field($model, 'total')->textInput(['placeholder' => 'Total', 'readonly' => true])->label(false) ?></td>
                                        <td><div style="border: 1px solid #9a9a9a;height: 47px;"><?= $form->field($model, 'tax')->dropDownList(ArrayHelper::map(common\models\Tax::findAll(['status' => 1]), 'id', 'taxname'), ['prompt' => '-VAT-', 'style' => 'border:none'])->label(false); ?>   <span id="tax-amount-show"></span></div></td>
                                        <td style="display:none"><?= $form->field($model, 'tax_amount')->textInput(['placeholder' => 'Vat Amount', 'readonly' => true])->label(false) ?></td>
                                        <td><?= $form->field($model, 'sub_total')->textInput(['placeholder' => 'Sub Total', 'readonly' => true])->label(false) ?></td>
                                        <td><?= $form->field($model, 'description')->textarea(['placeholder' => 'Comment'])->label(false) ?></td>
                                        <?= $form->field($model, 'unit')->hiddenInput()->label(false) ?>
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
                <?php // Pjax::end();  ?>

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
    }.formm td{
        padding: 5px !important;
    }

</style>
<script>
    $(document).ready(function () {
        $(document).on('change', '#service_ids', function (e) {
            var data = $(this).val();
            if (data == 16) {
                $('#invoice_format-div').css('display', 'block');
            }
        });
    });
</script>


