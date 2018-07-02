<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RegisteredCourses */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="registered-courses-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'submitted')->dropDownList([ 1 => 'Submitted', 0 => 'Not Submitted', ], ['prompt' => 'Edit User Submission']) ?>

    <?= $form->field($model, 'approved')->dropDownList([ 1 => 'Approved', 0 => 'Not Approved', ], ['prompt' => 'Approve User Submission']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
