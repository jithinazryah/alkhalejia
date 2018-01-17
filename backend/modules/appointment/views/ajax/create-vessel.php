<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Ships */

$this->title = 'Create Ships';
$this->params['breadcrumbs'][] = ['label' => 'Ships', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

            </div>
            <div class="panel-body">
                <div class="panel-body"><div class="ships-create">
                        <?=
                        $this->render('_form_vessel', [
                            'model' => $model,
                        ])
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

