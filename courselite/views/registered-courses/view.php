<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\RegisteredCourses */

$this->title = $model->studentName;
$this->params['breadcrumbs'][] = ['label' => 'Registered Courses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="registered-courses-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'studentName:text:Name',
            'studentDepartment:text:Department',
            'studentFaculty:text:Faculty',
            'submitted',
            'approved',
        ],
    ]) ?>

    <div class="list-group">
        <?php foreach($model->studentsCourses as $key => $course){ ?>
            <div class="list-group-item active">
                <h4 class="list-group-item-heading"><?= ($key+1) ?>. <?= $course['course'] ?></h4>  
                <p class="list-group-item-text">Department: <?= $course['department'] ?></p>
                <p class="list-group-item-text">Faculty: <?= $course['faculty'] ?></p>
        </div>
        <hr style="margin: 2px 0; opacity: 0;">
        <?php } ?>
    </div>

</div>
