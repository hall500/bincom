<?php

use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Welcome to Voters Voice!</h1>

        <p class="lead">Make Your Votes Count .</p>

        <p><a class="btn btn-lg btn-success" href="<?php echo Url::toRoute('/q1');?>">Get started </a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-3">
                <h2>Individual Polling Units</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. </p>

                <p><a class="btn btn-default" href="<?= Url::toRoute('/q1') ?>">View &raquo;</a></p>
            </div>
            <div class="col-lg-3">
                <h2>Results of Local Governments</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. </p>

                <p><a class="btn btn-default" href="<?= Url::to('/q2') ?>">View &raquo;</a></p>
            </div>
            <div class="col-lg-3">
                <h2>Add a New Polling Unit</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. </p>

                <p><a class="btn btn-default" href="<?= Url::toRoute('/q3') ?>">View &raquo;</a></p>
            </div>

            <div class="col-lg-3">
                <h2>Add Scores for a polling Unit</h2>

                <p>To add scores for a polling unit select the polling unit from and then click on add. </p>

            </div>
            
        </div>

    </div>
</div>
