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
