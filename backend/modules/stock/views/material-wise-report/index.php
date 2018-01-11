<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Materials;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\StockSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Material Wise Report';
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
                                    return $data->getQtyTotal($data->material_id);
                                },
                            ],
                        // 'weight_in',
                        // 'weight_out',
                        // 'total_cost',
                        // 'status',
                        // 'CB',
                        // 'UB',
                        // 'DOC',
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


