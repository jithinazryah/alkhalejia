<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\Ships;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AppointmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Voyage Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="appointment-index">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                </div>
                <div class="panel-body">
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= Html::a('<i class="fa-th-list"></i><span> Create Voyage Details</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
//                            'id',
//                            'vessel',
                            [
                                'attribute' => 'vessel',
                                'format' => 'raw',
                                'filter' => Html::activeDropDownList($searchModel, 'vessel', ArrayHelper::map(Ships::find()->all(), 'id', 'name'), ['class' => 'form-control', 'id' => 'name', 'prompt' => '']),
                                'value' => function ($data) {
                                    return Ships::findOne($data->vessel)->name;
                                },
                            ],
                            'appointment_number',
                            'date',
                            [
                                'attribute' => 'port_of_call',
                                'format' => 'raw',
                                'filter' => Html::activeDropDownList($searchModel, 'port_of_call', ArrayHelper::map(\common\models\Ports::find()->all(), 'id', 'port_name'), ['class' => 'form-control', 'id' => 'port_name', 'prompt' => '']),
                                'value' => function ($data) {
                                    $res1 = \common\models\Ports::findOne($data->port_of_call);
                                    if (!empty($res1)) {
                                        return $res1->port_name;
                                    } else {
                                        return '';
                                    }
                                },
                            ],
                            [
                                'attribute' => 'terminal',
                                'format' => 'raw',
                                'filter' => Html::activeDropDownList($searchModel, 'terminal', ArrayHelper::map(\common\models\Terminals::find()->all(), 'id', 'terminal'), ['class' => 'form-control', 'id' => 'terminal', 'prompt' => '']),
                                'value' => function ($data) {
                                    $res2 = \common\models\Terminals::findOne($data->terminal);
                                    if (!empty($res2)) {
                                        return $res2->terminal;
                                    } else {
                                        return '';
                                    }
                                },
                            ],
                            // 'berth_number',
                            // 'material',
                            // 'quantity',
                            // 'eta',
                            // 'description:ntext',
                            // 'status',
                            // 'CB',
                            // 'UB',
                            // 'DOC',
                            // 'DOU',
                            ['class' => 'yii\grid\ActionColumn',
                                'template' => '{view}{update}{service}',
                                'buttons' => [
                                    'service' => function($url, $model, $key) {     // render your custom button
                                        return Html::a('<span class="fa fa-shield" style="padding-top: 0px;"></span>', ['/appointment/appointment/add', 'id' => $model->id], [
                                                    'title' => Yii::t('app', 'Services'),
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


