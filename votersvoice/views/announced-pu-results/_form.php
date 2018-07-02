<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\States;

/* @var $this yii\web\View */
/* @var $model app\models\AnnouncedPuResults */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="announced-pu-results-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'state_id')->dropDownList(
        ArrayHelper::map(States::find()->all(), 'state_id', 'state_name'),
        [
            'prompt' => 'Choose a State',
            'onchange' => '$.post("/bincom/votersvoice/web/announced-pu-results/all-lgas?id=" + $(this).val(), function(data){
                $("select#announcedpuresults-lga_id").html(data);
            });
            '
        ]
    )->label('States') ?>

    <?= $form->field($model, 'lga_id')->dropDownList(
        [],
        [
            'prompt' => 'Select a State',
            'onchange' => '$.post("/bincom/votersvoice/web/announced-pu-results/all-wards?id=" + $(this).val(), function(data){
                $("select#announcedpuresults-ward_id").html(data);
            });
            '
        ]
    )->label('Local Governments') ?>

    <?php echo $form->field($model, 'ward_id')->dropDownList(
        [],
        [
            'prompt' => 'Select a Local Government',
            'onchange' => '$.post("/bincom/votersvoice/web/announced-pu-results/all-pollingunits?id=" + $(this).val() + "&lga_id=" + $("select#announcedpuresults-lga_id").val(), function(data){
                $("select#announcedpuresults-polling_unit_uniqueid").html(data);
            });
            '
        ]
    )->label('Wards'); ?>

    <div class="form-group">
        <?php //echo Html::submitButton('Save', ['class' => 'btn btn-success']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
