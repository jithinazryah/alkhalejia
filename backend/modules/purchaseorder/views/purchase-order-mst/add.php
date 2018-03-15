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

                <div class="row" style="margin-left: 0px;">
                    <div style="float:left;padding-top: 5px;">
                        <?php
                        echo Html::a('<i class="fa-print"></i><span>Purchase Order</span>', ['purchase-order-mst/purchase-order', 'id' => $order->id], ['class' => 'btn btn-secondary btn-icon btn-icon-standalone', 'target' => '_blank']);
                        ?>
                    </div>
                    <div style="float:left;padding-top: 5px;padding-left: 25px;">
                        <?php
                        echo Html::a('<i class="fa-print"></i><span>Invoice Cover</span>', ['purchase-order-mst/purchase-cover', 'id' => $order->id], ['class' => 'btn btn-secondary btn-icon btn-icon-standalone', 'target' => '_blank']);
                        ?>
                    </div>
                    <div style="float:left;padding-top: 5px;padding-left: 25px;">
                        <?php
                        echo Html::a('<i class="fa fa-file-word-o"></i><span>Export to Word</span>', ['purchase-order-mst/word-export', 'id' => $order->id], ['class' => 'btn btn-secondary btn-icon btn-icon-standalone', 'target' => '_blank']);
                        ?>
                    </div>
                </div>
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
                                    <th data-priority="1" style="width:2%">#</th>
                                    <th data-priority="1">DESCRIPTION</th>
                                    <th data-priority="1" style="width:10%">RATE</th>
                                    <th data-priority="1" style="width:10%">QUANTITY</th>
                                    <th data-priority="1" style="width:10%">UNIT</th>
                                    <th data-priority="1" style="width:10%">TOTAL</th>
                                    <th data-priority="1" style="width:5%">ACTIONS</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php
                                $qty_tot = 0;
                                $tot_amount = 0;
                                foreach ($order_details as $order_detail) {
                                    $i++;
                                    ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td class="edit_text" id="<?= $order_detail->id ?>-description" val="<?= $order_detail->description ?>"><?php if ($order_detail->description != '') { ?> <span title="<?= $order_detail->description ?>"><?= substr($order_detail->description, 0, 200) . '...'; ?></span><?php } ?></td>
                                        <td class="edit_text txt-align-right" id="<?= $order_detail->id ?>-rate" val="<?= $order_detail->rate ?>"><?php if ($order_detail->rate != '') { ?> <?= $order_detail->rate ?><?php } ?></td>
                                        <td class="edit_text txt-align-right" id="<?= $order_detail->id ?>-qty" val="<?= $order_detail->qty ?>">
                                            <?php
                                            echo $order_detail->qty;
                                            ?>
                                        </td>
                                        <td  class="txt-align-right" id="<?= $order_detail->id ?>-unit" val="<?= $order_detail->unit ?>"><?php if ($order_detail->unit != '') { ?> <?= common\models\Units::findOne($order_detail->unit)->unit_symbol ?><?php } ?></td>
                                        <td  class="txt-align-right" id="<?= $order_detail->id ?>-total" val="<?= $order_detail->total ?>"><?php if ($order_detail->total != '') { ?> <?= $order_detail->total ?><?php } ?></td>
                                        <td>
                                            <?php // Html::a('<i class="fa fa-pencil"></i>', ['/purchaseorder/purchase-order-mst/add', 'id' => $id, 'prfrma_id' => $order_detail->id], ['class' => '', 'tittle' => 'Edit']) ?>
                                            <?php // Html::a('<i class="fa fa-remove"></i>', ['/purchaseorder/purchase-order-mst/delete-detail', 'id' => $order_detail->id], ['class' => '', 'tittle' => 'Edit', 'data-confirm' => 'Are you sure you want to delete this item?']) ?>
                                        </td>


                                        <?php
                                        $qty_tot += $order_detail->qty;
                                        $tot_amount += $order_detail->total;
                                        ?>
                                    </tr>
                                    <?php
                                }
                                ?>


                                <tr class="formm">
                                    <?php $form = ActiveForm::begin(); ?>
                                    <td></td>
                                    <td><?= $form->field($model, 'description')->textarea(['placeholder' => 'Description'])->label(false) ?></td>
                                    <td><?= $form->field($model, 'rate')->textInput(['placeholder' => 'Rate'])->label(false) ?><span id="unit-text" style="margin-left:5px"></span></td>
                                    <td><?= $form->field($model, 'qty')->textInput(['type' => 'number', 'placeholder' => 'Quantity', 'value' => 1,])->label(false) ?><span id="unit-text" style="margin-left:5px"></span></td>
                                    <td><?= $form->field($model, 'unit')->dropDownList(ArrayHelper::map(common\models\Units::findAll(['status' => 1]), 'id', 'unit_symbol'), ['prompt' => '-Unit-',])->label(false); ?></td>
                                    <td><?= $form->field($model, 'total')->textInput(['placeholder' => 'Total', 'readonly' => TRUE])->label(false) ?></td>
                                    <td><?= Html::submitButton($model->isNewRecord ? 'Add' : 'Update', ['class' => 'btn btn-success']) ?>
                                    </td>

                                    <?php ActiveForm::end(); ?>
                                </tr>
                                <tr></tr>

                            </tbody>

                        </table>

                    </div>

                </div>
                <?php // Pjax::end(); ?>

                <!------------------------------------------------------------------------------------------------------------->

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
    $(document).ready(function () {
        $(document).on('keyup mouseup', '#purchaseorderdtl-qty', function () {
            multiply();
        });
        $(document).on('keyup mouseup', '#purchaseorderdtl-rate', function () {
            multiply();
        });
    });
    function multiply() {
        var rate = $("#purchaseorderdtl-rate").val();
        var unit = $("#purchaseorderdtl-qty").val();
        if (rate != '' && unit != '') {
            $("#purchaseorderdtl-total").val(rate * unit);
        }

    }
</script>


