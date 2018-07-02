<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\States;
use app\models\Party;

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
                $("select#newpollingunit-lga_id").html(data);
            });
            '
        ]
    )->label('States') ?>

    <?= $form->field($model, 'lga_id')->dropDownList(
        [],
        [
            'prompt' => 'Select a State',
            'onchange' => '$.post("/bincom/votersvoice/web/announced-pu-results/all-wards?id=" + $(this).val(), function(data){
                $("select#newpollingunit-ward_id").html(data);
            });
            '
        ]
    )->label('Local Governments') ?>

    <?php echo $form->field($model, 'ward_id')->dropDownList(
        [],
        [
            'prompt' => 'Select a Local Government',
        ]
    )->label('Wards'); ?>

    <?= $form->field($model, 'polling_unit_name')->textInput(['placeholder' => 'Enter Polling Unit Name']) ?>

    <?= $form->field($model, 'polling_unit_number')->textInput(['placeholder' => 'Enter Polling Unit Number']) ?>

    <div class="row">
    <div class="col-md-6">
    <?= $form->field($model, 'lat')->textInput(['placeholder' => 'Enter Latitude of Polling Unit']) ?>
    </div>
    <div class="col-md-6">
    <?= $form->field($model, 'long')->textInput(['placeholder' => 'Enter Longitude of Polling Unit']) ?>
    </div>
    </div>

    <?= $form->field($model, 'partyid')->dropDownList(
        ArrayHelper::map(Party::find()->all(), 'partyid', 'partyname'),
            [
                'prompt' => 'Choose a Party',
            ]
        )->label('Party') ?>

    <?= $form->field($model, 'party_score')->textInput(['placeholder' => 'Enter Party Score']) ?>

    <div class="form-group">
        <?php echo Html::submitButton('Add', ['class' => 'btn btn-success']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
