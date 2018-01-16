<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\Materials;
use common\models\Contacts;

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
                                'filter' => Html::activeDropDownList($searchModel, 'material', ArrayHelper::map(Materials::find()->all(), 'id', 'name'), ['class' => 'form-control', 'id' => 'name', 'prompt' => '']),
                                'value' => function ($data) {
                                    return Materials::findOne($data->material)->name;
                                },
                            ],
                            [
                                'attribute' => 'supplier',
                                'format' => 'raw',
                                'filter' => Html::activeDropDownList($searchModel, 'supplier', ArrayHelper::map(Contacts::findAll(['status' => 1, 'type' => 2]), 'id', 'name'), ['class' => 'form-control', 'id' => 'name', 'prompt' => '']),
                                'value' => function ($data) {
                                    return Contacts::findOne($data->supplier)->name;
                                },
                            ],
                            [
                                'attribute' => 'transport',
                                'format' => 'raw',
                                'filter' => Html::activeDropDownList($searchModel, 'transport', ArrayHelper::map(Contacts::findAll(['status' => 1, 'type' => 3]), 'id', 'name'), ['class' => 'form-control', 'id' => 'name', 'prompt' => '']),
                                'value' => function ($data) {
                                    return Contacts::findOne($data->transport)->name;
                                },
                            ],
                            [
                                'attribute' => 'ticket',
                                // 'value' => 'dailyEntryDetails.ticket',
                                'value' => function($model, $key, $index, $column) {
                                    $ticket_number = $model->dailyEntryDetails;
                                    foreach ($ticket_number as $ticket_no) {
                                        $tickt_no[] = $ticket_no['ticket_no'];
                                    }
                                    if (!empty($tickt_no)) {
                                        return implode(",", $tickt_no);
                                    }
                                },
//                                'filter' => [1 => 'Yes', 0 => 'No'],
                            ],
//                            'transport',
                            // 'payment_status',
                            // 'yard_id',
                            // 'status',
                            // 'CB',
                            // 'UB',
                            // 'DOC',
                            // 'DOU',
                            ['class' => 'yii\grid\ActionColumn',
                                'template' => '{update}'],
                        ],
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


