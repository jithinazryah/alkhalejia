<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Contacts;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PaymentMstSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Payment';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payment-mst-index">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                </div>
                <div class="panel-body">
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= Html::a('<i class="fa-th-list"></i><span> New Payment</span>', ['add'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
//                            'id',
//                            'transaction_type',
                            [
                                'attribute' => 'transaction_type',
                                'filter' => [1 => 'Receipt', 2 => 'Payment'],
                                'value' => function ($model) {
                                    return $model->transaction_type == 1 ? 'Receipt' : 'Payment';
                                },
                                'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt' => 'All'],
                            ],
                            'document_no',
                            'document_date',
                            [
                                'attribute' => 'supplier',
                                'format' => 'raw',
                                'filter' => Html::activeDropDownList($searchModel, 'supplier', ArrayHelper::map(Contacts::findAll(['status' => 1, 'type' => 2, 'service' => 1]), 'id', 'name'), ['class' => 'form-control', 'id' => 'name', 'prompt' => 'All']),
                                'value' => function ($data) {
                                    return Contacts::findOne($data->supplier)->name;
                                },
                            ],
                            // 'due_amount',
                            // 'paid_amount',
                            // 'payment_mode',
                            // 'cheque_no',
                            // 'cheque_due_date',
                            // 'reference',
                            // 'status',
                            // 'CB',
                            // 'UB',
                            // 'DOC',
                            // 'DOU',
                            ['class' => 'yii\grid\ActionColumn',
                                'template' => '{view}',
                            ],
                        ],
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


