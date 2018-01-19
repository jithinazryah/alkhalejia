<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\EstimatedProforma */

$this->title = 'Payment';
$this->params['breadcrumbs'][] = ['label' => ' Pre-Funding', 'url' => ['index']];
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
                <h2  class="appoint-title panel-title"><?= Html::encode($this->title) . '</b>' ?></h2>
            </div>
            <?php //Pjax::begin();        ?>
            <div class="panel-body">
                <?= Html::a('<i class="fa-th-list"></i><span> Manage Payment</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                <div class="modal fade" id="modal-6">
                    <div class="modal-dialog" id="modal-pop-up">

                    </div>
                </div>
                <?php
                $form = ActiveForm::begin();
                ?>
                <div class="panel-body">
                    <?php if (Yii::$app->session->hasFlash('error')): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= Yii::$app->session->getFlash('error') ?>
                        </div>
                    <?php endif; ?>
                    <?php if (Yii::$app->session->hasFlash('success')): ?>
                        <div class="alert alert-success" role="alert">
                            <?= Yii::$app->session->getFlash('success') ?>
                        </div>
                    <?php endif; ?>

                    <div class="sales-invoice-master-create">
                        <div class="sales-invoice-master-form form-inline">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <span><label class="control-label control-label1" for="paymentmst-bp_code">Transaction Category</label></span>
                                        </div>
                                        <div class="col-md-8">
                                            <?= $form->field($model_master, 'transaction_category')->dropDownList($transaction_categories, ['prompt' => '-Choose Supplier-', 'class' => 'form-control'])->label(FALSE) ?>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <span><label class="control-label control-label1" for="paymentmst-bp_code">Supplier</label></span>
                                        </div>
                                        <div class="col-md-8">
                                            <?= $form->field($model_master, 'supplier')->dropDownList(['prompt' => '-Choose Supplier-'])->label(FALSE) ?>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <span><label class="control-label control-label1" for="paymentmst-bp_code">Amount</label></span>
                                        </div>
                                        <div class="col-md-8">
                                            <?= $form->field($model_master, 'paid_amount')->textInput(['maxlength' => true])->label(FALSE) ?>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <span><label class="control-label control-label1" for="paymentmst-bp_code">Payment Mode</label></span>
                                        </div>
                                        <div class="col-md-8">
                                            <?= $form->field($model_master, 'payment_mode')->dropDownList(['1' => 'Cash', '2' => 'Cheque'], ['prompt' => 'Select Payment'])->label(FALSE) ?>
                                        </div>
                                    </div>
                                    <div class="col-md-12" id="chequ-no-div">
                                        <div class="col-md-4">
                                            <span><label class="control-label control-label1" for="paymentmst-bp_code">Cheque No</label></span>
                                        </div>
                                        <div class="col-md-8">
                                            <?= $form->field($model_master, 'cheque_no')->textInput(['maxlength' => true])->label(FALSE) ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2" style="top: 123px;">
                                    <input type="checkbox" id="checkbox-payall" name="pay-all" value="" class="checkbox-payall" tabindex="-1">Pay Full<br>
                                    <input type="checkbox" id="auto-allocation" name="auto-allocation" value="" class="auto-allocation" tabindex="-1">Auto Allocation
                                    <input type="hidden" id="paymentmst-paid_amount-balance" class="form-control" name="PaymentMstbalance" aria-required="true" aria-invalid="false" value="0">
                                </div>
                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <span><label class="control-label control-label1" for="paymentmst-bp_code">Date</label></span>
                                            </div>
                                            <div class="col-md-8">
                                                <?php
                                                $model_master->document_date = date('d-M-Y');
                                                ?>
                                                <?=
                                                $form->field($model_master, 'document_date')->widget(DatePicker::classname(), [
                                                    'type' => DatePicker::TYPE_INPUT,
                                                    'pluginOptions' => [
                                                        'autoclose' => true,
                                                        'format' => 'dd-M-yyyy'
                                                    ]
                                                ])->label(FALSE);
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <span><label class="control-label control-label1" for="paymentmst-bp_code">Payment No</label></span>
                                            </div>
                                            <div class="col-md-8">
                                                <?php
                                                $last = \common\models\PaymentMst::find()->orderBy(['id' => SORT_DESC])->one();
                                                $docu_no = $last->id + 1;
                                                $model_master->document_no = 'PAY-' . $docu_no;
                                                ?>
                                                <?= $form->field($model_master, 'document_no')->textInput(['maxlength' => true, 'readonly' => 'true'])->label(FALSE) ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <span><label class="control-label control-label1" for="paymentmst-bp_code">Due Amount</label></span>
                                            </div>
                                            <div class="col-md-8">
                                                <?= $form->field($model_master, 'due_amount')->textInput(['maxlength' => true, 'readonly' => 'true'])->label(FALSE) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="">
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <span><label class="control-label control-label1" for="paymentmst-bp_code">Reference</label></span>
                                            </div>
                                            <div class="col-md-8">
                                                <?= $form->field($model_master, 'reference')->textInput(['maxlength' => true])->label(FALSE) ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12" id="chequ-due-div">
                                            <div class="col-md-4">
                                                <span><label class="control-label control-label1" for="paymentmst-bp_code">Cheque Due Date</label></span>
                                            </div>
                                            <div class="col-md-8">
                                                <?=
                                                $form->field($model_master, 'cheque_due_date')->widget(DatePicker::classname(), [
                                                    'type' => DatePicker::TYPE_INPUT,
                                                    'pluginOptions' => [
                                                        'autoclose' => true,
                                                        'format' => 'dd-M-yyyy'
                                                    ]
                                                ])->label(FALSE);
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="billing-hr">
                <div class="row">
                    <div class='col-md-12 col-sm-12 col-xs-12 add-receipt-details'>

                    </div>
                </div>
                <div class="row">
                    <div style="float:right;">
                        <?= Html::submitButton('Save', ['class' => 'btn btn-secondary', 'name' => 'save', 'value' => 'save', 'style' => 'padding: 7px 25px 7px 25px;margin-top: 18px;']) ?>
                        <?= Html::a('Discard', ['add'], ['class' => 'btn btn-gray btn-reset']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>



            </div>
            <?php //Pjax::end();                                       ?>
        </div>
    </div>
</div>
<style>
    .filter{
        background-color: #b9c7a7;
    }
</style>
<script type="text/javascript">
    jQuery(document).ready(function ($)
    {
        $("#chequ-no-div").hide();
        $("#chequ-due-div").hide();
        $(document).on('change', '#paymentmst-payment_mode', function (e) {
            if ($(this).val() == 2) {
                $("#chequ-no-div").show();
                $("#chequ-due-div").show();
            } else {
                $("#chequ-no-div").hide();
                $("#chequ-due-div").hide();
            }
        });
        $(document).on('change', '#paymentmst-supplier', function (e) {
            $('#paymentmst-paid_amount').val('');
            $('#auto-allocation').attr('checked', false);
            $('#checkbox-payall').attr('checked', false);
            loadpayment();
        });

        $(document).on('change', '#checkbox-payall', function (e) {
            $('#auto-allocation').attr('checked', false);
            var first_row = $('#bill-receipt > tbody > tr:first').attr('id');
            var last_row = $('#bill-receipt > tbody > tr:last').attr('id');
            var num = 0;
            if ($(this).is(":checked")) {
                for (i = first_row; i <= last_row; i++) {
                    var row_balance = $('#balance_' + i).text();
                    $('#payed_amount-' + i).val(row_balance);
                }
            } else {
                for (i = first_row; i <= last_row; i++) {
                    $('#payed_amount-' + i).val(num.toFixed(2));
                }
            }
            calculateTotal();
        });
        $(document).on('change', '#auto-allocation', function (e) {
//        $("#checkbox-payall").trigger("change");
            var first_row = $('#bill-receipt > tbody > tr:first').attr('id');
            var last_row = $('#bill-receipt > tbody > tr:last').attr('id');
            var num = 0;
            if ($('#checkbox-payall').is(":checked")) {
                for (i = first_row; i <= last_row; i++) {
                    $('#payed_amount-' + i).val(num.toFixed(2));
                }
                calculateTotal();
            }
            if ($(this).is(":checked")) {
                $('#checkbox-payall').attr('checked', false);
                var auto_payment = $('#paymentmst-paid_amount').val();
                if (auto_payment > 0) {
                    for (i = first_row; i <= last_row; i++) {
                        var auto_payment_balance = $('#paymentmst-paid_amount-balance').val();
                        var row_balance = $('#balance_' + i).text();
                        if (parseFloat(auto_payment_balance) > parseFloat(row_balance)) {
                            $('#payed_amount-' + i).val(row_balance);
                            $('#paymentmst-paid_amount-balance').val(auto_payment_balance - row_balance);
                        } else if (auto_payment_balance > 0) {
                            $('#payed_amount-' + i).val(auto_payment_balance);
                            $('#paymentmst-paid_amount-balance').val(0);
                        } else {
                            $('#payed_amount-' + i).val(0);
                        }
                    }
                } else {
//                alert('Enter Valid Amount');
                    if ($("#paymentmst-paid_amount").next(".validation").length == 0) // only add if not added
                    {
                        $("#paymentmst-paid_amount").after("<p class='validation' style='color:red;margin-left: 4px;font-size: 10px;'>Enter valid amount before auto allocation.</p>");
                    }
                    $('#auto-allocation').attr('checked', false);
                }
            } else {
                for (i = first_row; i <= last_row; i++) {
                    $('#payed_amount-' + i).val(num.toFixed(2));
                }
            }
            calculateTotal();
        });
        $(document).on('blur', '#paymentmst-paid_amount', function (e) {
            alert($(this).val());
            $('#paymentmst-paid_amount-balance').val($(this).val());
            $('.payed_amount').val('');
            $('.amount_paid_total').val('');
            $('#checkbox-payall').attr('checked', false);
            $('#auto-allocation').attr('checked', false);
//        calculateTotal();
        });
        $(document).on('keyup', '#paymentmst-paid_amount', function (e) {
            if ($(this).val() > 0) {
                if ($("#paymentmst-paid_amount").next(".validation").length != 0) // only add if not added
                {
                    $("#paymentmst-paid_amountt").next(".validation").remove();
                }
            }
        });
        $(document).on('keyup', '.payed_amount', function (e) {
            $('#checkbox-payall').attr('checked', false);
            $('#auto-allocation').attr('checked', false);
            calculateTotal();
        });

        $(document).on('change', '#paymentmst-transaction_category', function (e) {
            var idd = $('#paymentmst-transaction_category').val();
            $.ajax({
                type: 'POST',
                cache: false,
                async: false,
                data: {id: idd},
                url: '<?= Yii::$app->homeUrl ?>purchase/payment/select-supplier',
                success: function (data) {
                    $("#paymentmst-supplier").html(data);
                }
            });
        });

    });
    function loadpayment() {
        var idd = $('#paymentmst-supplier').val();
        $.ajax({
            type: 'POST',
            cache: false,
            async: false,
            data: {id: idd},
            url: '<?= Yii::$app->homeUrl ?>purchase/payment/select-payments',
            success: function (data) {
                $(".add-receipt-details").html(data);
                $('#paymentmst-due_amount').val($('.due_amount_total').val());
            }
        });
    }
    function calculateTotal() {
        var first_row = $('#bill-receipt > tbody > tr:first').attr('id');
        var last_row = $('#bill-receipt > tbody > tr:last').attr('id');
        var amount_paid_total = 0;
        for (i = first_row; i <= last_row; i++) {

            var paid = parseFloat($('#payed_amount-' + i).val());
            if (!paid) {
                paid = 0;
            }
            amount_paid_total += paid;
        }
        $('.amount_paid_total').val(addZeroes(amount_paid_total));
        $('#paymentmst-paid_amount').val(addZeroes(amount_paid_total));
        var due_amount_tot = $('.due_amount_total').val();
        if (!due_amount_tot) {
            due_amount_tot = 0;
        }
        var balance = parseFloat(due_amount_tot) - parseFloat(amount_paid_total);
        $('#paymentmst-due_amount').val(addZeroes(balance));
    }
    function addZeroes(num) {
        var num = Number(num);
        if (String(num).split(".").length < 2 || String(num).split(".")[1].length <= 2) {
            num = num.toFixed(2);
        }
        return num;
    }
</script>
