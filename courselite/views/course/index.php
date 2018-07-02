<?php
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Faculties;
use app\models\Departments;
use app\models\Courses;
use yii\bootstrap\Alert;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ArrayDataProvider */

$this->title = 'Courses';
$this->params['breadcrumbs'][] = $this->title;
if(Yii::$app->session->hasFlash('save')){
    $error = ((Yii::$app->session->getFlash('save')[0]) ? 'success': 'danger');
    echo Alert::widget([
        'options' => [
            'class' => 'alert-' . $error,
        ],
        'body' => Yii::$app->session->getFlash('save')[1],
    ]);
}
if(Yii::$app->session->hasFlash('submit')){
    echo Alert::widget([
        'options' => [
            'class' => 'alert-danger',
        ],
        'body' => Yii::$app->session->getFlash('submit'),
    ]);
}
?>


<div class="courses-add">
    <h1>Add Course</h1>

    <?php $form = ActiveForm::begin(['id' => 'course-add-form']); ?>
        <?= $form->field($model, 'facultyId')->dropDownList(
            ArrayHelper::map(Faculties::find()->select(['id','faculty'])->all(), 'id', 'faculty'),
            [
                'prompt' => 'Select Faculty',
                'onchange' => '$.post("/bincom/courselite/web/course/all-departments?id=" + $(this).val(), function(data){
                    $("select#courseaddform-deptid").html(data);
                });
               '
            ]
        ) ?>
        <?= $form->field($model, 'deptId')->dropDownList(
            [],
            [
                'prompt' => 'Select Department',
                'onchange' => '$.post("/bincom/courselite/web/course/all-courses?id=" + $(this).val(), function(data){
                    $("select#courseaddform-courseid").html(data);
                });
               '
            ]
        ) ?>
        <?= $form->field($model, 'courseId')->dropDownList(
            [],
            [
                'prompt' => 'Select Course',
            ]
        ) ?>

        <div class="form-group">
            <?= Html::submitButton('Add', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>

<div class="course-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Course</th>
                <th>Department</th>
                <th>Faculty</th>
                <th>Credit</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($dataProvider as $item){ ?>
                    <tr>
                        <td><?= $item['course'] ?></td>
                        <td><?= $item['department'] ?></td>
                        <td><?= $item['faculty'] ?></td>
                        <td><?= $item['credit'] ?></td>
                        <td> <?= Html::a('<span class="glyphicon glyphicon-trash"></span>', ['/course/delete', 'id'=> $item['id']], ['class' => 'btn btn-danger']) ?></td>
                    </tr>
                <?php }
            ?>
        </tbody>
    </table>
    </div>

    <div class="form-group">
        <?= Html::a('Save', ['/course/save'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Submit', ['/course/submit'], ['class' => 'btn btn-success']) ?>
    </div>
</div>
