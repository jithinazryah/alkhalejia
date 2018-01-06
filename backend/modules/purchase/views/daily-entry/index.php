<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\DailyEntrySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daily Entries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="daily-entry-index">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                </div>
                <div class="panel-body">
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= Html::a('<i class="fa-th-list"></i><span> Create Daily Entry</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
//                            'id',
                            'received_date',
                            [
                                'attribute' => 'material',
                                'format' => 'raw',
                                'filter' => Html::activeDropDownList($searchModel, 'material', ArrayHelper::map(\common\models\Materials::find()->all(), 'id', 'name'), ['class' => 'form-control', 'id' => 'name', 'prompt' => '']),
                                'value' => 'material0.name',
                            ],
                            [
                                'attribute' => 'supplier',
                                'format' => 'raw',
                                'filter' => Html::activeDropDownList($searchModel, 'supplier', ArrayHelper::map(\common\models\Contacts::find()->where(['type' => '2'])->all(), 'id', 'name'), ['class' => 'form-control', 'id' => 'name', 'prompt' => '']),
                                'value' => 'supplier0.name',
                            ],
                            [
                                'attribute' => 'yard_id',
                                'format' => 'raw',
                                'filter' => Html::activeDropDownList($searchModel, 'yard_id', ArrayHelper::map(\common\models\Yard::find()->all(), 'id', 'name'), ['class' => 'form-control', 'id' => 'name', 'prompt' => '']),
                                'value' => function ($data) {
                                    return \common\models\Yard::findOne($data->yard_id)->name;
                                },
                            ],
                            // 'payment_status',
//                            'yard_id',
                            // 'ticket_no',
                            // 'truck_number',
                            // 'gross_weight',
                            // 'tare_weight',
                            // 'net_weight',
                            // 'rate',
                            // 'total',
                            // 'description:ntext',
                            // 'status',
                            // 'CB',
                            // 'UB',
                            // 'DOC',
                            // 'DOU',
                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


