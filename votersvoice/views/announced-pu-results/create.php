<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AnnouncedPuResults */

$this->title = 'Create Announced Pu Results';
$this->params['breadcrumbs'][] = ['label' => 'Announced Pu Results', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="announced-pu-results-create">

    <div class="row">
        <div class="col-sm-4">
        <?= $this->render('_create_form', [
            'model' => $model,
        ]) ?>
        </div>
        <div class="col-sm-8">
            <h1>Add Results for this Polling Unit Here</h1>
            <div id="newpollingunit-result">
            </div>
        </div>
    </div>
    

</div>
