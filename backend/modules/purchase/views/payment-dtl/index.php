<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PaymentDtlSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Payment Dtls';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payment-dtl-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">
                                                                                            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                                        
                                        <?=  Html::a('<i class="fa-th-list"></i><span> Create Payment Dtl</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                                                                                                                                        <?= GridView::widget([
                                                'dataProvider' => $dataProvider,
                                                'filterModel' => $searchModel,
        'columns' => [
                                                ['class' => 'yii\grid\SerialColumn'],

                                                            'id',
            'payment_mst_id',
            'transaction_id',
            'document_no',
            'document_date',
            // 'total_amount',
            // 'due_amount',
            // 'paid_amount',
            // 'reference',
            // 'status',
            // 'CB',
            // 'UB',
            // 'DOC',
            // 'DOU',

                                                ['class' => 'yii\grid\ActionColumn'],
                                                ],
                                                ]); ?>
                                                                                                                </div>
                        </div>
                </div>
        </div>
</div>


