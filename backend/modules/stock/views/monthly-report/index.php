<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Materials;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel common\models\StockSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Monthly  Report';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stock-index">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                </div>
                <div class="panel-body">
                    <div class="row" style="margin-left: 0px;border-bottom: 2px solid rgba(39, 41, 42, 0.46);">


                        <div class="col-md-4">
                            <?php
                            $form = ActiveForm::begin([
                                        'action' => ['index'],
                                        'method' => 'get',
                            ]);
                            ?>
                            
                            <?=
                            $form->field($searchModel, 'DOC')->widget(DatePicker::className(), [
                                //'language' => 'ru',
//                                    'dateFormat' => 'yyyy-MM-dd',
                                'options' => ['class' => 'form-control'],
                                'pluginOptions' => ['startView' =>
                                    'year', 'minViewMode' => 'months','format' => 'yyyy-mm']
                                
                            ])->label('Date');
                            ?>

                        </div>
                        <div class="col-md-4" style="margin-top: 31px;">
                            <div class="form-group">
                                <?= Html::submitButton('Search', ['class' => 'btn btn-success']) ?>
                                <?php // Html::resetButton('Reset', ['class' => 'btn btn-default', 'style' => 'background-color: #e6e6e6;'])   ?>
                            </div>
                        </div>
                        <?php ActiveForm::end(); ?>



                    </div>
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            [
                                'attribute' => 'material_id',
                                'label' => 'Material Name',
                                'value' => 'material.name',
                                'filter' => ArrayHelper::map(Materials::find()->asArray()->all(), 'id', 'name'),
                            ],
//                            'material_code',
                            [
                                'attribute' => 'quantity_in',
                                'header' => 'Quantity',
                                'filter' => '',
                                'value' => function ($data) {
                                    return $data->monthlyQtyTotal($data->material_id, $data->DOC);
                                },
                            ],
                            // 'weight_in',
                            // 'weight_out',
                            // 'total_cost',
                            // 'status',
                            // 'CB',
                            // 'UB',
                            [
                                'attribute' => 'DOC',
                                'header' => 'Date',
                                'filter' => '',
                                'value' => function ($data) {
                                    return date('Y-M', strtotime($data->DOC));
                                },
                            ],
//                            'DOC',
                        // 'DOU',
//                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


