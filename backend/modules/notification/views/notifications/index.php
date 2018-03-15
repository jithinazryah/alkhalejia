<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\NotificationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Notifications';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notifications-index">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                </div>
                <div class="panel-body">
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                    <?php Pjax::begin(); ?>
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
//                            'id',
//                            'notification_type',
//                            'table_id',
//                            'content:ntext',
                            'message:ntext',
                            [
                                'attribute' => 'status',
                                'format' => 'raw',
                                'value' => function ($data) {
                                    if (isset($data->status) && $data->status != '') {
                                        if ($data->status == 1) {
                                            return 'Open';
                                        } elseif ($data->status == 2) {
                                            return 'Closed';
                                        } elseif ($data->status == 3) {
                                            return 'Pending';
                                        }
                                    } else {
                                        return '';
                                    }
                                },
                                'filter' => ['1' => 'Open', '2' => 'Closed', '3' => 'Pending'],
                            ],
                            // 'sort_order',
                            // 'expiry_date',
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'contentOptions' => ['style' => 'width:100px;'],
                                'header' => 'Actions',
                                'template' => '{closed}',
                                'buttons' => [
                                    'closed' => function ($url, $model) {
                                        if ($model->status != 2) {
                                            return Html::a('<input type="checkbox" checked="" class="iswitch iswitch-red">', $url, [
                                                        'title' => Yii::t('app', 'Closed'),
                                                        'class' => '',
                                                        'style' => 'padding: 4px 10px;border-radius: 5px;',
                                            ]);
                                        }
                                    },
                                ],
                                'urlCreator' => function ($action, $model) {
                                    if ($action === 'closed') {
                                        $url = Url::to(['closed', 'id' => $model->id]);
                                        return $url;
                                    }
                                }
                            ],
                        ],
                    ]);
                    ?>
                    <script>
                        $(document).ready(function () {
                            $(".filters").slideToggle();
                            $("#search-option").click(function () {
                                $(".filters").slideToggle();
                            });
                        });
                    </script>
                    <?php Pjax::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>


