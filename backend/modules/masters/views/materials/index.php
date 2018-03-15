<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Tax;
use common\models\Units;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MaterialsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Materials';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="materials-index">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                </div>
                <div class="panel-body">
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= Html::a('<i class="fa-th-list"></i><span> Create Materials</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                    <?= \common\widgets\Alert::widget(); ?>
                    <?php Pjax::begin(['id' => 'type_id']); //id is used for jquery opertaion  ?>
                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
//                                                            'id',
                            'name',
                            'code',
                            'size',
                            [
                                'attribute' => 'tax',
                                'format' => 'raw',
                                'filter' => Html::activeDropDownList($searchModel, 'tax', ArrayHelper::map(Tax::find()->all(), 'id', 'tax'), ['class' => 'form-control', 'id' => 'tax_name', 'prompt' => '']),
                                'value' => function ($data) {
                                    if (isset($data->tax)) {
                                        return Tax::findOne($data->tax)->tax;
                                    } else {
                                        return '';
                                    }
                                },
                            ],
                            [
                                'attribute' => 'unit',
                                'format' => 'raw',
                                'filter' => Html::activeDropDownList($searchModel, 'unit', ArrayHelper::map(Units::find()->all(), 'id', 'unit_symbol'), ['class' => 'form-control', 'prompt' => '']),
                                'value' => function ($data) {
                                    if (isset($data->unit)) {
                                        return Units::findOne($data->unit)->unit_symbol;
                                    } else {
                                        return '';
                                    }
                                },
                            ],
                            [
                                'attribute' => 'purchase_price',
                                'contentOptions' => ['style' => 'text-align: right;'],
                            ],
                            [
                                'attribute' => 'selling_price',
                                'contentOptions' => ['style' => 'text-align: right;'],
                            ],
                            // 'image',
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
                    <?php Pjax::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>


