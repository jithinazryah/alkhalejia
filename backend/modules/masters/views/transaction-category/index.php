<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\components\ModalViewWidget;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TransactionCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transaction Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaction-category-index">

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
                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
//                            'id',
                            'category',
                            'description:ntext',
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
                                'template' => '{update}',
                                'buttons' => [
                                    'update' => function ($url, $model) {
                                        return Html::button('<i class="fa fa-pencil"></i>', ['value' => Url::to(['update', 'id' => $model->id]), 'class' => 'modalButton edit-btn']);
                                    },
                                ],
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


