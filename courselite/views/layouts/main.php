<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\components\UserRole;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'CourseLite',//Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

    $items = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'About', 'url' => ['/site/about']],
        ['label' => 'Contact', 'url' => ['/site/contact']],
    ];

    if(UserRole::isStudent()){
        $items[] = ['label' => 'Courses', 'url' => ['/course']];
        $items[] = ['label' => 'Profile', 'url' => ['/students/view?id='. UserRole::getUserId()]];
    }

    if(UserRole::isAdmin()){
        $items[] = [
            'label' => 'Students',
            'items' => [
                ['label' => 'Manage Students', 'url' => ['/students']],
                 ['label' => 'Manage Registered Courses', 'url' => ['/registered-courses']],
            ],
        ];

        $items[] = [
            'label' => 'School',
            'items' => [
                ['label' => 'Manage Courses', 'url' => ['/courses']],
                ['label' => 'Manage Departments', 'url' => ['/departments']],
                ['label' => 'Manage Faculties', 'url' => ['/faculties']],
            ],
        ];
    }

    if (Yii::$app->user->isGuest) {
        $items[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $items[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $items[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $items,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; CourseLite <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
