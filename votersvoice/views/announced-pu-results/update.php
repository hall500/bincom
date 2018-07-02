<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AnnouncedPuResults */

$this->title = 'Add results for this polling Unit Here';
$this->params['breadcrumbs'][] = ['label' => 'Announced Pu Results', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->result_id, 'url' => ['view', 'id' => $model->result_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="announced-pu-results-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_update_form', [
        'model' => $model,
    ]) ?>
            <div id="newpollingunit-result">
                <table class="table table-striped">
                <thead>
                <tr>
                <th>Party</th>
                <th>Score</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    foreach($parties_added as $party_added){
                        echo '
                        <tr><td>'.$party_added->party_abbreviation.'</td>
                        <td>'.$party_added->party_score.'</td></tr>
                        ';
                    }
                ?>
                </tbody>
                </table>
        </div>

</div>
