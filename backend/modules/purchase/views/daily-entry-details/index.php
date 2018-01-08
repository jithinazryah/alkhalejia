<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\DailyEntryDetailsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daily Entry Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="daily-entry-details-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">
                                                                                            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                                        
                                        <?=  Html::a('<i class="fa-th-list"></i><span> Create Daily Entry Details</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                                                                                                                                        <?= GridView::widget([
                                                'dataProvider' => $dataProvider,
                                                'filterModel' => $searchModel,
        'columns' => [
                                                ['class' => 'yii\grid\SerialColumn'],

                                                            'id',
            'daily_entry_id',
            'ticket_no',
            'truck_number',
            'gross_weight',
            // 'tare_weight',
            // 'net_weight',
            // 'rate',
            // 'total',
            // 'description:ntext',
            // 'transport_amount',
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


