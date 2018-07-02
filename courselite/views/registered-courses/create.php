<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RegisteredCourses */

$this->title = 'Create Registered Courses';
$this->params['breadcrumbs'][] = ['label' => 'Registered Courses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="registered-courses-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
