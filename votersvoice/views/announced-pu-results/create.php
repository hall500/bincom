<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AnnouncedPuResults */

$this->title = 'Create New Polling Unit';
$this->params['breadcrumbs'][] = ['label' => 'Announced Pu Results', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="announced-pu-results-create">

    <div class="row">
    <div class="col-md-8 col-md-offset-2">
    <?= $this->render('_create_form', [
            'model' => $model,
        ]) ?>
    </div>
    </div>
    

</div>
