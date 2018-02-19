<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\Ships;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PurchaseOrderMstSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Purchase Order';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="purchase-order-mst-index">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                </div>
                <div class="panel-body">
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= Html::a('<i class="fa-th-list"></i><span>Add</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
//                                                            'id',
                            'date',
                            [
                                'attribute' => 'vessel',
                                'format' => 'raw',
                                'filter' => Html::activeDropDownList($searchModel, 'vessel', ArrayHelper::map(Ships::find()->all(), 'id', 'name'), ['class' => 'form-control', 'id' => 'name', 'prompt' => '']),
                                'value' => function ($data) {
                                    return Ships::findOne($data->vessel)->name;
                                },
                            ],
                            'reference_no',
                            'appointment_no',
                            'invoice_no',
                            'attenssion',
                            // 'address:ntext',
                            // 'invoice',
                            // 'email_confirmation:email',
                            // 'delivery_note',
                            // 'eta',
                            // 'port',
                            // 'payment_terms',
                            // 'agent_details',
                            // 'status',
                            // 'CB',
                            // 'UB',
                            // 'DOC',
                            // 'DOU',
                            ['class' => 'yii\grid\ActionColumn',
                                'template' => '{view}{update}{service}',
                                'buttons' => [
                                    'service' => function($url, $model, $key) {     // render your custom button
                                        return Html::a('<span class="fa fa-shield" style="padding-top: 0px;"></span>', ['/purchaseorder/purchase-order-mst/add', 'id' => $model->id], [
                                                    'title' => Yii::t('app', 'Order Details'),
                                                    'class' => 'actions',
                                        ]);
                                    },
                                ]
                            ],
                        ],
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


