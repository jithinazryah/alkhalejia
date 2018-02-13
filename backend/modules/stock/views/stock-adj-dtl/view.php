<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
Use common\models\BaseUnit;

/* @var $this yii\web\View */
/* @var $model common\models\SalesInvoiceDetails */

$this->title = 'Stock Adjustment';
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
                    <div class="sales-details">
                        <table class="table table-bordered">
                            <tr>
                                <th>Date</th>
                                <th>Transaction Type</th>
                                <th>Material Code</th>
                                <th>Material Name</th>
                                <th>Rate</th>
                                <th>Qty</th>
                                <th>Total</th>
                            </tr>
                            <?php
                            $qty_total = 0;
                            $amount_total = 0;
                            foreach ($model_details as $model_detail) {
                                ?>
                                <tr>
                                    <td><?= $model_detail->document_date; ?></td>
                                    <td>
                                        <?php
                                        if ($model_detail->transaction == 1) {
                                            echo 'Opening';
                                        } elseif ($model_detail->transaction == 2) {
                                            echo 'Addition';
                                        } elseif ($model_detail->transaction == 3) {
                                            echo 'Deduction';
                                        }
                                        ?>
                                    </td>
                                    <td><?= $model_detail->material_code; ?></td>
                                    <td><?= $model_detail->material_name; ?></td>
                                    <td><?= $model_detail->rate; ?></td>
                                    <td><?= $model_detail->qty; ?></td>
                                    <td><?= $model_detail->total_cost; ?></td>
                                </tr>
                                <?php
                                $qty_total += $model_detail->qty;
                                $amount_total += $model_detail->total_cost;
                            }
                            ?>
                            <tr>
                                <td colspan="5">TOTAL</td>
                                <td><?= sprintf('%0.2f', $qty_total); ?></td>
                                <td><?= sprintf('%0.2f', $amount_total); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


