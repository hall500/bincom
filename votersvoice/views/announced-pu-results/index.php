<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Poll Results';
$this->params['breadcrumbs'][] = $this->title;
if(Yii::$app->session->hasFlash('poll_added')){
    echo '<div class="alert alert-success">'.Yii::$app->session->getFlash('poll_added').'</div>';
}
?>

<div class="row">
  <div class="col-sm-4 announced-pu-results-create">
    <h1>Select a Polling Unit</h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
  </div>
  <div class="col-sm-8">
  <?php $form = ActiveForm::begin(); ?>
  <?= $form->field($model, 'polling_unit_uniqueid')->dropDownList(
        [],
        [
            'prompt' => 'Select a Ward',
            'onchange' => '$.post("'. Url::toRoute('/announced-pu-results/poll-results?id=') .'" + $(this).val(), function(data){
                $("div#announced-pu-results-table").html(data);
            });
            '
        ]
    )->label('Polling Unit') ?>
    <?php ActiveForm::end(); ?>
  <!-- div#announced-pu-results-table -->
    <div class="announced-pu-results-index">
        <div id="announced-pu-results-table">
        </div>
    </div>
  </div>
</div>
