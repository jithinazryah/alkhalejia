<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use common\components\ModalViewWidget;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UnitsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Units';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="units-index">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                </div>
                <div class="panel-body">
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= Html::button('<i class="fa-th-list"></i><span> Create New</span>', ['value' => Url::to('create'), 'class' => 'btn btn-warning  btn-icon btn-icon-standalone modalButton']) ?>
                    <?= \common\widgets\Alert::widget(); ?>
                    <?php
                    echo ModalViewWidget::widget();
                    ?>
                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
//                            'id',
                            'unit_name',
                            'unit_symbol',
                            [
                                'attribute' => 'status',
                                'filter' => ['1' => 'Enable', '0' => 'Disable'],
                                'value' => function($data) {
                                    return $data->status == 1 ? 'Enable' : 'Disable';
                                }
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
//                                    'contentOptions' => ['style' => 'width:100px;'],
                                'header' => 'Actions',
                                'template' => '{update}{delete}',
                                'buttons' => [
                                    'update' => function ($url, $model) {
                                        return Html::button('<i class="fa fa-pencil"></i>', ['value' => Url::to(['update', 'id' => $model->id]), 'class' => 'modalButton edit-btn']);
                                    },
                                    'delete' => function ($url, $model) {
                                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                                    'title' => Yii::t('app', 'delete'),
                                                    'class' => '',
                                                    'data' => [
                                                        'confirm' => 'Are you sure you want to delete this item?',
                                                    ],
                                        ]);
                                    },
                                ],
                                'urlCreator' => function ($action, $model) {
                                    if ($action === 'delete') {
                                        $url = Url::to(['del', 'id' => $model->id]);
                                        return $url;
                                    }
                                }
                            ],
                        ],
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).on('click', '.modalButton', function () {
        $('#modal').modal('show')
                .find('#modalContent')
                .load($(this).attr("value"));

    });
</script>


