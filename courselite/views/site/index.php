<?php

use yii\helpers\Url;
use app\components\UserRole;
/* @var $this yii\web\View */

$this->title = 'CourseLite';
?>
<div class="site-index">

    <div class="jumbotron">
    <h1>Welcome to CourseLite!</h1>

    <p class="lead">Course Registration System Created to meet your needs.</p>

        <?php
            if(Yii::$app->user->isGuest){
                echo '<p><a class="btn btn-lg btn-success" href="'. Url::toRoute('/site/login') .'">Login</a> or <a class="btn btn-lg btn-success" href="'. Url::toRoute('/site/signup') .'">Sign Up</a></p>';
            }elseif(UserRole::isStudent()){
                echo '<h1>' . Yii::$app->user->identity->username . '</h1>';
                echo '<p><a class="btn btn-lg btn-success" href="'. Url::toRoute('/course') .'">Register Courses</a> or <a class="btn btn-lg btn-success" href="'. Url::toRoute('/students/view?id='. UserRole::getUserId()) .'">Update Profile</a></p>';
            }elseif(UserRole::isAdmin()){
                echo '<h1>' . Yii::$app->user->identity->username . '</h1>';
                echo '<h3>Your role is ' . Yii::$app->user->identity->role . '</h3>';
            }
        ?>
    </div>

    <?php 
        if(UserRole::isStudent()){ 
            echo '
            <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Register Courses</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Save and Submit</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Wait for Approval</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>

    </div>
            ';
        }elseif(UserRole::isAdmin()){
            echo '
            <div class="container text-center">
            <a href="'. Url::toRoute('/students') .'" class="btn btn-default">Manage Students</a>
            <a href="'. Url::toRoute('/registered-courses') .'" class="btn btn-default">Manage Student Courses</a>
            <a href="'. Url::toRoute('/courses') .'" class="btn btn-default">Manage All Courses</a>
            <a href="'. Url::toRoute('/departments') .'" class="btn btn-default">Manage All Departments</a>
            <a href="'. Url::toRoute('/faculties') .'" class="btn btn-default">Manage All Faculties</a>
            </div>
            ';
        }
    ?>
</div>
