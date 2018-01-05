<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Ships */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ships-form form-inline">
    <?= \common\widgets\Alert::widget(); ?>
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="row">
        <div class='col-md-6 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-6 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'registration_number')->textInput(['maxlength' => true]) ?>

        </div>
    </div>
    <div class="row">
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'length')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'capacity')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'status')->dropDownList(['1' => 'Enabled', '0' => 'Disabled']) ?>

        </div>
    </div>
    <div class="row">
        <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>
            <?= $form->field($model, 'description')->textarea(['rows' => 4]) ?>

        </div>
    </div>
    <hr class="appoint_history" />
    <div class="clearfix"></div>
    <div id = "p_attach">
        <input type = "hidden" id = "delete_port_vals" name = "delete_port_vals" value = "">
        <h4 style = "color:#000;font-style: italic;">Documents</h4>
        <p style="margin-bottom: 15px;color: red;font-style: italic;">( Only pdf,txt,doc,docx,xls,xlsx,msg,zip,eml, jpg, jpeg, png files are allowed. )</p>
        <?php if (!empty($model_upload)) { ?>
            <table class="table table-hover">
                <tr>
                    <th>Document Name</th>
                    <th>Document</th>
                    <th>Expiry Date</th>
                    <th>Description</th>
                    <th></th>
                </tr>
                <?php foreach ($model_upload as $val) { ?>
                    <tr>
                        <td><?= $val->document_title ?></td>
                        <td><a href="<?= Yii::$app->homeUrl ?>uploads/employee/documents/<?= $val->id ?>/<?= $val->file ?>" target="_blank"><?= $val->file ?></a></td>
                        <td><?= $val->expiry_date ?></td>
                        <td><?= $val->description ?></td>
                        <td><?= Html::a('<i class="fa fa-trash" style="color:red;"></i>', ['attachment-delete', 'id' => $val->id], ['onClick' => 'return confirm("Are you sure you want to remove?")']) ?></td>
                    </tr>
                <?php }
                ?>
            </table>
        <?php }
        ?>

        <span>
            <div class="row">
                <div class = 'col-md-4 col-sm-12 col-xs-12 left_padd'>
                    <div class = "form-group field-staffperviousemployer-hospital_address">
                        <label class = "control-label">Document</label>
                        <input type = "file" name = "creates[file][]">

                    </div>
                </div>
                <div class='col-md-4 col-sm-12 col-xs-12 left_padd'>
                    <div class="form-group field-staffperviousemployer-designation">
                        <label class="control-label" for="">Document Title</label>
                        <input class="form-control" type = "text" name = "creates[file_name][]">
                    </div>
                </div>
                <div class='col-md-3 col-sm-12 col-xs-12 left_padd'>
                    <div class="form-group field-staffperviousemployer-designation">
                        <label class="control-label" for="">Expiry Date</label>
                        <input type="date" class="form-control" name="creates[expiry_date][]">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class='col-md-11 col-sm-12 col-xs-12 left_padd'>
                    <div class="form-group field-staffperviousemployer-designation">
                        <label class="control-label" for="">Description</label>
                        <textarea rows="3" class="form-control" name="creates[description][]"></textarea>
                    </div>
                </div>
            </div>


            <div style="clear:both"></div>
        </span>

    </div>


    <div class="row">
        <div class="col-md-12">
            <a id="addAttach" title="Add More Attachment" class="btn btn-blue btn-icon btn-icon-standalone addAttach" style="float:right;margin-right: 15px;"><i class="fa-plus"></i></a>
        </div>
    </div>
    <hr class="appoint_history" />
    <div class="row">
        <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;float:right;']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
    $("document").ready(function () {
        var scntDiv = $('#p_attach');
        var i = $('#p_attach span').size() + 1;

        $('#addAttach').on('click', function () {
            $.ajax({
                type: 'POST',
                cache: false,
                data: {},
                url: '<?= Yii::$app->homeUrl; ?>masters/ships/attachment',
                success: function (data) {
                    $(data).appendTo(scntDiv);
                    i++;
                    return false;

                }
            });


        });
        $('#p_attach').on('click', '.remAttach', function () {
            if (i > 2) {
                $(this).parents('span').remove();
                i--;
            }
            if (this.hasAttribute("val")) {
                var valu = $(this).attr('val');
                $('#delete_port_vals').val($('#delete_port_vals').val() + valu + ',');
                var value = $('#delete_port_vals').val();
            }
            return false;
        });
    });
</script>