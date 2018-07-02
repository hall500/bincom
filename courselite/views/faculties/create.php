<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Faculties */

$this->title = 'Create Faculties';
$this->params['breadcrumbs'][] = ['label' => 'Faculties', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faculties-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
