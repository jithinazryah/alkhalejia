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
                <div class="panel-body"><div class="daily-entry-create">
                        <?=
                        $this->render('_form', [
                            'model' => $model,
                            'model_details' => $model_details,
                        ])
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
