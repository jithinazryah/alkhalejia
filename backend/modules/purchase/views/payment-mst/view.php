<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\PaymentMst */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Payment Msts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
        <div class="col-md-12">

                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                        </div>
                        <div class="panel-body">
                                <?=  Html::a('<i class="fa-th-list"></i><span> Manage Payment Mst</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                <div class="panel-body"><div class="payment-mst-view">
                                                <p>
                                                        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                                                        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                                                        'class' => 'btn btn-danger',
                                                        'data' => [
                                                        'confirm' => 'Are you sure you want to delete this item?',
                                                        'method' => 'post',
                                                        ],
                                                        ]) ?>
                                                </p>

                                                <?= DetailView::widget([
                                                'model' => $model,
                                                'attributes' => [
                                                            'id',
            'transaction_type',
            'document_no',
            'document_date',
            'supplier',
            'due_amount',
            'paid_amount',
            'payment_mode',
            'cheque_no',
            'cheque_due_date',
            'reference',
            'status',
            'CB',
            'UB',
            'DOC',
            'DOU',
                                                ],
                                                ]) ?>
</div>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>


