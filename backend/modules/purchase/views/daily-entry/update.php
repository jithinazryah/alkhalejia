<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\DailyEntry */

$this->title = 'Update Daily Entry: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Daily Entries', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


            </div>
            <div class="panel-body">
                <?= Html::a('<i class="fa-th-list"></i><span> Manage Daily Entry</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                <?= Html::a('<i class="fa-th-list"></i><span> Create Daily Entry</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>

                <ul class="nav nav-tabs nav-tabs-justified">
                    <li  class="active">
                        <?php
                        echo Html::a('<span class="visible-xs"><i class="fa-home"></i></span><span class="hidden-xs">Daily Entry</span>', ['daily-entry/update', 'id' => $model->id]);
                        ?>

                    </li>
                    <li>
                        <?php
                        echo Html::a('<span class="visible-xs"><i class="fa-home"></i></span><span class="hidden-xs">Daily Entry Details</span>', ['daily-entry/add', 'id' => $model->id]);
                        ?>

                    </li>

                </ul>
                <div class="panel-body"><div class="daily-entry-create">
                        <?=
                        $this->render('_form', [
                            'model' => $model,
                        ])
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
