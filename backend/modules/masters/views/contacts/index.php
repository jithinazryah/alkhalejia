<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ContactsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contacts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contacts-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">


                                        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



                                        <?= Html::a('<i class="fa-th-list"></i><span> Create Contacts</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                        <?= \common\widgets\Alert::widget(); ?>
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
                                                        'name',
                                                        'code',
                                                        'tax_id',
                                                            [
                                                            'attribute' => 'type',
                                                            'value' => 'type0.type',
                                                            'filter' => kartik\select2\Select2::widget([
                                                                'model' => $searchModel,
                                                                'attribute' => 'type',
                                                                'data' => common\models\ContactType::Types(),
                                                                'options' => ['placeholder' => ' '],
                                                                'pluginOptions' => [
                                                                    'allowClear' => true,
                                                                ],
                                                            ])
                                                        ],
                                                            [
                                                            'attribute' => 'category',
                                                            'value' => 'category0.category_name',
                                                            'filter' => kartik\select2\Select2::widget([
                                                                'model' => $searchModel,
                                                                'attribute' => 'category',
                                                                'data' => common\models\SupplierCategory::Category(),
                                                                'options' => ['placeholder' => ' '],
                                                                'pluginOptions' => [
                                                                    'allowClear' => true,
                                                                ],
                                                            ])
                                                        ],
                                                        'phone',
//                                                        'email:email',
                                                        // 'address:ntext',
                                                        // 'city',
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
</div>

<script>
        $(document).ready(function () {
                $(".filters").slideToggle();
                $("#search-option").click(function () {
                        $(".filters").slideToggle();
                });
        });
</script>

