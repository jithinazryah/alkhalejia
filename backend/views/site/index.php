<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\Ships;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AdminUsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<div class="dashboard">
    <div class="row">
        <div class="col-md-12">
            <h3>Dashboard</h3>
        </div>
    </div>
</div>

<div class="appointment-index">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-body">
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'rowOptions' => function ($model, $key, $index, $grid) {
                            $url = 'http://' . Yii::$app->getRequest()->serverName . Yii::$app->homeUrl . 'appointment/appointment/view?id=' . $model->id;
                            return ['data-id' => $model->id, 'onclick' => "window.location.href='{$url}'", 'onmouseover' => "this.style.backgroundColor='rgba(167, 167, 167, 0.52)';this.style.cursor='pointer'", 'onmouseout' => "this.style.backgroundColor=''"];
                        },
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
                            'port_of_call',
                            'terminal',
                        ],
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


