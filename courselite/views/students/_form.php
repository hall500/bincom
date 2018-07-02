<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Faculties;
use app\models\Departments;

/* @var $this yii\web\View */
/* @var $model app\models\Students */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="students-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->hiddenInput()->label('') ?>

    <?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gender')->dropDownList([ 'male' => 'Male', 'female' => 'Female', ], ['prompt' => 'Select Gender']) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'matric_num')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'faculty')->dropDownList(
            ArrayHelper::map(Faculties::find()->select(['id','faculty'])->all(), 'id', 'faculty'),
            [
                'prompt' => 'Select Faculty',
                'onchange' => '$.post("/bincom/courselite/web/course/all-departments?id=" + $(this).val(), function(data){
                    $("select#students-department_id").html(data);
                });
               '
            ]
        ) ?>
        
        <?= $form->field($model, 'department_id')->dropDownList(
            [],
            [
                'prompt' => 'Select Department',
            ]
        )->label('Department') ?>

    <?= $form->field($model, 'modified')->hiddenInput(['value' => date('Y-m-d H:i:s', time())])->label('') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
