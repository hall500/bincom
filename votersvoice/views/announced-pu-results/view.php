<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\States;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Poll Results';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
  <div class="col-sm-4 announced-pu-results-create">
    <h1>Select LGA</h1>
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
            'onchange' => '$.post("/bincom/votersvoice/web/announced-pu-results/results?id=" + $(this).val(), function(data){
                $("div#announced-lga-results-table").html(data);
            });
            '
        ]
    )->label('Local Governments') ?>

    <div class="form-group">
        <?php //echo Html::submitButton('Save', ['class' => 'btn btn-success']); ?>
    </div>

    <?php ActiveForm::end(); ?>
  </div>
  <div class="col-sm-8">

  <!-- div#announced-pu-results-table -->
    <div class="announced-pu-results-index">
        <div id="announced-lga-results-table">
        </div>
    </div>
  </div>
</div>
