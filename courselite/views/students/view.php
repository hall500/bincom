<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\components\UserRole;

/* @var $this yii\web\View */
/* @var $model app\models\Students */

$this->title = $model->firstname . " " . $model->lastname;
$this->params['breadcrumbs'][] = ['label' => 'Students', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="students-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php
            if(UserRole::isAdmin()){
                Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]);
            }
        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'displayname:text:Name',
            'email:email',
            'gender',
            'phone',
            'matric_num',
            'department.department',
            'created',
            'modified',
        ],
    ]) ?>

</div>
