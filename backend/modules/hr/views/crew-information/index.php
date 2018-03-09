<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\Ports;
use common\models\Ships;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CrewInformationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Crew Informations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="crew-information-index">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                </div>
                <div class="panel-body">
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= Html::a('<i class="fa-th-list"></i><span> Create Crew Information</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
//                                                            'id',
                            [
                                'attribute' => 'vessel',
                                'format' => 'raw',
                                'filter' => Html::activeDropDownList($searchModel, 'vessel', ArrayHelper::map(Ships::find()->all(), 'id', 'name'), ['class' => 'form-control', 'id' => 'vessel_name', 'prompt' => '']),
                                'value' => function ($data) {
                                    return Ships::findOne($data->vessel)->name;
                                },
                            ],
                            [
                                'attribute' => 'port',
                                'format' => 'raw',
                                'filter' => Html::activeDropDownList($searchModel, 'port', ArrayHelper::map(Ports::find()->all(), 'id', 'port_name'), ['class' => 'form-control', 'id' => 'port_name', 'prompt' => '']),
                                'value' => function ($data) {
                                    return Ports::findOne($data->port)->port_name;
                                },
                            ],
                            'agent',
                            'full_name',
                            // 'rank',
                            // 'nationality',
                            // 'date_of_birth',
                            // 'place_of_birth',
                            // 'residential_address:ntext',
                            // 'phone_number',
                            // 'marital_status',
                            // 'mothers_name',
                            // 'fathers_name',
                            // 'joining_date',
                            // 'religion',
                            // 'first_language',
                            // 'photo',
                            // 'sex',
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


