<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Contacts;
use yii\helpers\ArrayHelper;
use common\components\PurchaseOrderWidget;

/* @var $this yii\web\View */
/* @var $model common\models\EstimatedProforma */

$this->title = 'Add Purchase Order Details';
$this->params['breadcrumbs'][] = ['label' => 'Purchase Order Details', 'url' => ['index']];
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
                <?= PurchaseOrderWidget::widget(['id' => $order->id]) ?>
                <hr class="appoint_history" />


                <!---------------------------------------------------- Generate Print  ------------------------------------------->

                <!------------------------------------------------------------------------------------------------------------->


                <!-------------------------------------------------- Menu ----------------------------------------------------------->
                <ul class="estimat nav nav-tabs nav-tabs-justified">
                    <li>
                        <?php
                        echo Html::a('<span class="visible-xs"><i class="fa-home"></i></span><span class="hidden-xs">Purchase Order</span>', ['purchase-order-mst/update', 'id' => $order->id]);
                        ?>

                    </li>
                    <li class="active">
                        <?php
                        echo Html::a('<span class="visible-xs"><i class="fa-home"></i></span><span class="hidden-xs">Order Details</span>', ['purchase-order-mst/add', 'id' => $order->id]);
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
                                    <th data-priority="1" style="widyh:2%">#</th>
                                    <th data-priority="1" style="width:10%">MATERIAL</th>
                                    <th data-priority="1" style="width:8%">RATE</th>
                                    <th data-priority="1" style="width:5%">QUANTITY</th>
                                    <th data-priority="1" style="width:8%">TOTAL</th>
                                    <th data-priority="1" style="width:10%;">VAT</th>
                                    <th data-priority="1" style="width:5%;display: none;">VAT AMOUNT</th>
                                    <th data-priority="1" style="width:8%">SUB TOTAL</th>
                                    <th data-priority="1">DESCRIPTION</th>
                                    <th data-priority="1" style="width:5%">ACTIONS</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php
                                $epdatotal = 0;
                                $tot_subtoatl = 0;
                                foreach ($order_details as $order_detail) {
                                    $i++;
                                    ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td class="" drop_id="estimatedproforma-material_id" id="<?= $order_detail->id ?>-material_id" val="<?= $order_detail->material_id ?>"><?= $order_detail->material_id ?></td>
                                        <td class="edit_text" id="<?= $order_detail->id ?>-unit_price"  val="<?= $order_detail->unit_price ?>">
                                            <?php
                                            if ($order_detail->unit_price == '') {
                                                echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                                            } else {
                                                echo Yii::$app->SetValues->NumberFormat($order_detail->unit_price);
                                            }
                                            ?>
                                        </td>
                                        <td class="edit_text" id="<?= $order_detail->id ?>-qty" val="<?= $order_detail->qty ?>">
                                            <?php
                                            if ($order_detail->qty != '') {
                                                if (isset($order_detail->unit) && $order_detail->unit != '') {
                                                    $unit_detail = common\models\Units::findOne($order_detail->unit);
                                                    echo $order_detail->qty . ' (' . $unit_detail->unit_symbol . ')';
                                                } else {
                                                    echo $order_detail->qty;
                                                }
                                            }
                                            ?>
                                        </td>
                                        <td  id="<?= $order_detail->id ?>-total" val="<?= $order_detail->total ?>"><?php if ($order_detail->total != '') { ?> <?= $order_detail->total ?><?php } ?></td>
                                        <td  id="<?= $order_detail->id ?>-tax" val="<?= $order_detail->tax ?>">

                                            <?php
                                            $tax = \common\models\Tax::findOne($order_detail->tax);
                                            if ($order_detail->tax_amount != '') {
                                                ?> <?= $order_detail->tax_amount . ' (' . $tax->value . '%)' ?><?php } ?>
                                        </td>
                                        <td style="display:none" id="<?= $order_detail->id ?>-tax_amount" val="<?= $order_detail->tax_amount ?>"><?php if ($order_detail->tax_amount != '') { ?> <?= $order_detail->tax_amount ?><?php } ?></td>
                                        <td id="<?= $order_detail->id ?>-sub_total" val="<?= $order_detail->sub_total ?>"><?php if ($order_detail->sub_total != '') { ?> <?= $order_detail->sub_total ?><?php } ?></td>
                                        <td class="edit_text" id="<?= $order_detail->id ?>-description" val="<?= $order_detail->description ?>"><?php if ($order_detail->description != '') { ?> <span title="<?= $order_detail->description ?>"><?= substr($order_detail->description, 0, 30) . '...'; ?></span><?php } ?></td>

                                        <td>
                                            <?php
                                            if ($appointment->status != 0) {
                                                ?>
                                                <?= Html::a('<i class="fa fa-pencil"></i>', ['/appointment/appointment/add', 'id' => $id, 'prfrma_id' => $estimate->id], ['class' => '', 'tittle' => 'Edit']) ?>
                                                <?= Html::a('<i class="fa fa-remove"></i>', ['/appointment/appointment/delete-detail', 'id' => $estimate->id], ['class' => '', 'tittle' => 'Edit', 'data-confirm' => 'Are you sure you want to delete this item?']) ?>
                                            <?php } ?>
                                            <a>
                                                <?= Html::beginForm(['appointment/selected-report'], 'post', ['target' => 'print_popup', 'onSubmit' => "window.open('about:blank','print_popup','width=1200,height=600');",]) ?>
                                                <input type="hidden" name="app_id" value="<?= $order->id ?>">
                                            </a>
                                        </td>


                                        <?php
                                        $epdatotal += $order_detail->total;
                                        $tot_subtoatl += $order_detail->sub_total;
                                        $grand_epdatotal += $order_detail->total;
                                        $grand_tot_subtoatl += $order_detail->sub_total;
                                        ?>
                                    </tr>
                                    <?php
                                }
                                ?>

                                <?php
                                if ($order->status != 0) {
                                    ?>

                                    <tr class="formm">
                                        <?php $form = ActiveForm::begin(); ?>
                                        <td></td>
                                        <td><?= $form->field($model, 'material_id')->dropDownList(ArrayHelper::map(common\models\Materials::findAll(['status' => 1]), 'id', 'name'), ['prompt' => '-Material-'])->label(false); ?></td>
                                        <td><?= $form->field($model, 'unit_price')->textInput(['placeholder' => ' Rate'])->label(false) ?></td>
                                        <td><?= $form->field($model, 'qty')->textInput(['placeholder' => 'Quantity', 'value' => 1,])->label(false) ?><span id="unit-text" style="margin-left:5px"></span></td>
                                        <td><?= $form->field($model, 'total')->textInput(['placeholder' => 'Total', 'readonly' => true])->label(false) ?></td>
                                        <td><div style="border: 1px solid #9a9a9a;height: 40px;"><?= $form->field($model, 'tax')->dropDownList(ArrayHelper::map(common\models\Tax::findAll(['status' => 1]), 'id', 'taxname'), ['prompt' => '-VAT-', 'style' => 'border:none'])->label(false); ?>   <span id="tax-amount-show"></span></div></td>
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
                <?php // Pjax::end(); ?>

                <!------------------------------------------------------------------------------------------------------------->

                <?php
                if ($order->status != 0) {
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
    });
    function multiply() {
        var rate = $("#dailyentrydetails-rate").val();
        var unit = $("#dailyentrydetails-net_weight").val();
        if (rate != '' && unit != '') {
            $("#dailyentrydetails-total").val(rate * unit);
        }

    }
</script>


