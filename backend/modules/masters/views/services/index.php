<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ServicesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Services';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="services-index">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                </div>
                <div class="panel-body">
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= Html::a('<i class="fa-th-list"></i><span> Create Services</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            [
                                'attribute' => 'category',
                                'value' => 'category0.category',
                                'filter' => kartik\select2\Select2::widget([
                                    'model' => $searchModel,
                                    'attribute' => 'category',
                                    'data' => common\models\TransactionCategory::Category(),
                                    'options' => ['placeholder' => ' '],
                                    'pluginOptions' => [
                                        'allowClear' => true,
                                    ],
                                ])
                            ],
                            'service',
                            //'supplier_option',
                            [
                                'attribute' => 'supplier_option',
                                'value' => function($model) {
                                    if ($model->supplier_option == '1')
                                        return 'Yes';
                                    else if ($model->supplier_option == '0')
                                        return 'No';
                                    else
                                        return '';
                                },
                                'filter' => ['1' => 'Yes', '2' => 'No'],
                            ],
                            // 'unit',
                            // 'unit_rate',
                            // 'tax',
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


