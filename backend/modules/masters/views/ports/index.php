<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\components\ModalViewWidget;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PortsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ports';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ports-index">

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
                                        <?= ModalViewWidget::widget() ?>
                                        <div class="table-responsive" style="border: none">
                                                <button class="btn btn-white" id="search-option" style="float: right;">
                                                        <i class="linecons-search"></i>
                                                        <span>Search</span>
                                                </button>
                                                <?=
                                                GridView::widget([
                                                    'dataProvider' => $dataProvider,
                                                    'filterModel' => $searchModel,
                                                    'columns' => [
                                                            ['class' => 'yii\grid\SerialColumn'],
                                                        'port_name',
                                                        'code',
                                                            [
                                                            'attribute' => 'status',
                                                            'value' => function($model) {
                                                                    if ($model->status == '1')
                                                                            return 'Enabled';
                                                                    else if ($model->status == '0')
                                                                            return 'Disabled';
                                                                    else
                                                                            return '';
                                                            },
                                                            'filter' => ['1' => 'Enabled', '2' => 'Diabled'],
                                                        ],
                                                            [
                                                            'class' => 'yii\grid\ActionColumn',
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
                                                                            $url = Url::to(['delete', 'id' => $model->id]);
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
</div>

<script>
        $(document).ready(function () {
                $(".filters").slideToggle();
                $("#search-option").click(function () {
                        $(".filters").slideToggle();
                });
                $(document).on('click', '.modalButton', function () {

                        $('#modal').modal('show')
                                .find('#modalContent')
                                .load($(this).attr("value"));

                });
        });
</script>

