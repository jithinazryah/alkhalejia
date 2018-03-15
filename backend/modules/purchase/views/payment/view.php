<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
Use common\models\BaseUnit;

/* @var $this yii\web\View */
/* @var $model common\models\SalesInvoiceDetails */

$this->title = $model->document_no;
$this->params['breadcrumbs'][] = ['label' => 'Sales Invoice Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .appoint{
        width: 100%;
        background-color: #eeeeee;
    }
    .appoint .value{
        font-weight: bold;
        text-align: left;
    }
    .appoint .labell{
        text-align: left;
    }
    .appoint .colen{

    }
    .appoint td{
        padding: 10px;
    }
    table th{
        color:black;
    }
    table td{
        color:black;
    }
    .sales-master{
        margin-bottom: 40px;
    }
    .sales-details{
        margin-bottom: 40px;
    }
    h4{
        color: #2196F3;
    }
    table.table tr td:last-child {
        display: block;
    }
    .tbl-view th,td{
        text-align: center;
    }
</style>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

            </div>
            <div class="panel-body">
                <?= Html::a('<i class="fa-th-list"></i><span> Manage Receipt</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                <?php // Html::a('<i class="fa-print"></i><span> Print Invoice</span>', ['report', 'id' => $model->id], ['class' => 'btn btn-secondary btn-icon btn-icon-standalone', 'target' => '_blank']) ?>
                <div class="panel-body">
                    <div class="sales-master table-responsive">
                        <h4>Payment Master</h4>
                        <table class="appoint">
                            <tr>
                                <td class="labell">Transaction Type </td>
                                <td class="colen">:</td><td class="value">
                                    <?php
                                    if ($model->transaction_type == 1) {
                                        echo 'Receipt';
                                    } elseif ($model->transaction_type == 2) {
                                        echo 'Payment';
                                    }
                                    ?>
                                </td>
                                <td class="labell">Document Date </td><td class="colen">:</td><td class="value"> <?= $model->document_date ?></td>
                                <td class="labell">Document Number</td><td class="colen">:</td><td class="value"><?= $model->document_no; ?></td>
                            </tr>
                            <tr>
                                <td class="labell">Supplier</td><td class="colen">:</td><td class="value"> <?php
                                    if (isset($model->supplier)) {
                                        echo common\models\Contacts::findOne(['id' => $model->supplier])->name;
                                    }
                                    ?>
                                </td>
                                <td class="labell">Due Amount </td><td class="colen">:</td><td class="value"> <?= $model->due_amount; ?></td>
                                <td class="labell">Payment Mode</td><td class="colen">:</td><td class="value">
                                    <?php
                                    if ($model->payment_mode == 1) {
                                        echo 'Cash';
                                    } elseif ($model->payment_mode == 2) {
                                        echo 'Cheque';
                                    }
                                    ?>
                                </td>
                            </tr>

                            <tr>
                                <td class="labell">Total Amount</td><td class="colen">:</td><td class="value"> <?= $model->paid_amount; ?></td>
                                <td class="labell">Cheque Number </td><td class="colen">:</td><td class="value"> <?= $model->cheque_no; ?></td>
                                <td class="labell">Cheque Due Date </td><td class="colen">:</td><td class="value"> <?= $model->cheque_due_date; ?></td>
                            </tr>

                        </table>
                    </div>
                    <div class="sales-details">
                        <h4>Payment Details</h4>
                        <table class="table table-bordered tbl-view">
                            <tr>
                                <th>Date</th>
                                <th>Invoice No</th>
                                <th>Invoice Amount</th>
                                <th>Due Amount</th>
                                <th>Payment</th>
                            </tr>
                            <?php
                            $invoice_total = 0;
                            $due_total = 0;
                            $paid_total = 0;
                            foreach ($model_details as $model_detail) {
                                ?>
                                <tr>
                                    <td><?= $model_detail->document_date; ?></td>
                                    <td><?= $model_detail->transaction_id; ?></td>
                                    <td class="txt-align-right"><?= $model_detail->total_amount; ?></td>
                                    <td class="txt-align-right"><?= $model_detail->due_amount; ?></td>
                                    <td class="txt-align-right"><?= $model_detail->paid_amount; ?></td>
                                </tr>
                                <?php
                                $due_total += $model_detail->due_amount;
                                $paid_total += $model_detail->paid_amount;
                                $invoice_total += $model_detail->total_amount;
                            }
                            ?>
                            <tr>
                                <td colspan="2">TOTAL</td>
                                <td class="txt-align-right"><?= sprintf('%0.2f', $invoice_total); ?></td>
                                <td class="txt-align-right"><?= sprintf('%0.2f', $due_total); ?></td>
                                <td class="txt-align-right"><?= sprintf('%0.2f', $paid_total); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


