<?php

namespace app\controllers;

use Yii;
use app\models\AnnouncedPuResults;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\LGA;
use app\models\Ward;
use app\models\PollingUnit;
use app\models\Party;
use yii\helpers\ArrayHelper;
use app\models\NewPollingUnit;
use app\models\NewPollParty;
use yii\helpers\Url;
/**
 * AnnouncedPuResultsController implements the CRUD actions for AnnouncedPuResults model.
 */
class AnnouncedPuResultsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all AnnouncedPuResults models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new AnnouncedPuResults();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->result_id]);
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    /**
     * Displays a single AnnouncedPuResults model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView()
    {
        $model = new AnnouncedPuResults();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->result_id]);
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new AnnouncedPuResults model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new NewPollingUnit();

        if ($model->load(Yii::$app->request->post())) {
            $newunit = new PollingUnit();
            $newunit->ward_id = $model->ward_id;
            $newunit->lga_id = $model->lga_id;
            $polval = PollingUnit::find()->where(['lga_id' => $model->lga_id, 'ward_id' => $model->ward_id])->max('polling_unit_id');
            $newunit->polling_unit_id = ($polval) ? $polval + 1 : 1;
            $newunit->polling_unit_number = $model->polling_unit_number;
            $newunit->polling_unit_name = $model->polling_unit_name;
            $newunit->polling_unit_description = $model->polling_unit_name;
            $newunit->lat = $model->lat;
            $newunit->long = $model->long;
            $newunit->date_entered = date('D, M Y H:i:s');
            //$newunit->user_ip_address = $_SERVER['REMOTE_HOST'];
            if($newunit->validate()){
                $newunit->save();
                Yii::$app->session->setFlash('poll_added','New Polling Unit Added Successfully');
                return $this->redirect('index');
            }
            print_r('Cannot validate Input');
            die();
            //return $this->redirect(['view', 'id' => $model->result_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing AnnouncedPuResults model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $parties_added = AnnouncedPuResults::find(['party_abbreviation','party_score'])->where(['polling_unit_uniqueid' => $id])->all();

        $model = new NewPollParty();

        if ($model->load(Yii::$app->request->post())) {
            $newresult = new AnnouncedPuResults();
            if($newresult->savePuResult($model, $id)){
                $newresult->save();
                return $this->redirect(['update', 'id' => $newresult->polling_unit_uniqueid]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'parties_added' => $parties_added,
        ]);
    }

    /**
     * Deletes an existing AnnouncedPuResults model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AnnouncedPuResults model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AnnouncedPuResults the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AnnouncedPuResults::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionAllLgas($id){
        $countLgas = LGA::find()->where(['state_id' => $id])->count();
        $lgas = LGA::find()->select(['uniqueid','lga_id','lga_name'])->where(['state_id' => $id])->all();

        if($countLgas > 0){
            echo "<option value=''disabled selected>Choose a Local Government</option>";
            foreach($lgas as $lga){
                echo "<option value='{$lga->lga_id}'>{$lga->lga_name}</option>";
            }
        }else{
            echo "<option>-</option>";
        }
    }

    public function actionAllWards($id){
        $countwards = Ward::find()->where(['lga_id' => $id])->count();
        $wards = Ward::find()->select(['uniqueid','ward_id','ward_name'])->where(['lga_id' => $id])->all();

        if($countwards > 0){
            echo "<option value=''disabled selected>Choose a Ward</option>";
            foreach($wards as $ward){
                echo "<option value='{$ward->ward_id}'>{$ward->ward_name}</option>";
            }
        }else{
            echo "<option>-</option>";
        }
    }

    public function actionAllPollingunits($id, $lga_id){
        $countpollingunits = PollingUnit::find()->where(['ward_id' => $id, 'lga_id' => $lga_id])->count();
        $pollingunits = PollingUnit::find()->select(['uniqueid','polling_unit_id','polling_unit_number', 'polling_unit_name'])->where(['ward_id' => $id, 'lga_id' => $lga_id])->all();

        if($countpollingunits > 0){
            echo "<option value=''disabled selected>Choose Polling Unit</option>";
            foreach($pollingunits as $pollingunit){
                echo "<option value='{$pollingunit->uniqueid}'>{$pollingunit->polling_unit_number} - {$pollingunit->polling_unit_name}</option>";
            }
        }else{
            echo "<option>No polling unit available</option>";
        }
    }

    public function actionPollResults($id){
        $countpollingres = AnnouncedPuResults::find()->where(['polling_unit_uniqueid' => $id])->count();
        $pollingres = AnnouncedPuResults::find()->select(['party_abbreviation','party_score'])->where(['polling_unit_uniqueid' => $id])->all();
        $html = '';

        if($countpollingres > 0){
            $html = '
                <h1>Polling results</h1>
                <a href="'. Url::toRoute('/announced-pu-results/update?id=' . $id) .'" class="btn btn-block btn-primary">Add Result</a>
                <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Party</th>
                        <th>Score</th>
                    </tr>
                </thead>
                <tbody>
            ';
            foreach($pollingres as $pollres){
                $html .= '
                    <tr>
                        <td>'. $pollres->party_abbreviation .'</td>
                        <td>' . $pollres->party_score .'</td>
                    </tr>';
            }
            $html .= '
                </tbody>
                </table>
            ';

            echo $html;
        }else{
            echo "<div class='jumbotron'>
                    <h1>No Results Here</h1>
                 </div>
            ";
        }
    }

    public function actionResults($id){
        $total = [];
        $parties = Party::find()->all();
        foreach($parties as $party){
            $params = [':id' => $_GET['id'], ':party' => $party->partyid];
            $results = Yii::$app->db->createCommand('SELECT `announced_pu_results`.`polling_unit_uniqueid`, `announced_pu_results`.`party_abbreviation`, `announced_pu_results`.`party_score`, `polling_unit`.`lga_id` FROM `announced_pu_results`, `polling_unit` where `polling_unit`.`lga_id`=:id AND `announced_pu_results`.`party_abbreviation` =:party', $params)
            ->queryAll();

            $scores = ArrayHelper::getColumn($results,'party_score');

            $sum = 0;
            foreach($scores as $score){
                $sum += $score;
            }

            $total[$party->partyid] = $sum;
        }

        $html = '
        <h1>Scores for ... Local Government</h1>
        <table class="table table-striped">
        <thead>
            <tr>
            <th>Party</th>
            <th>Score</th>
            </tr>
        </thead>

        <tbody>';
        
        foreach($total as $key => $value){
            $html .= '
                <tr><td>'.$key.'</td>
                <td>'.$value.'</td></tr>
            ';
        }

        $html .= '
            </tbody>
            </table>
        ';

        echo $html;
    }


}
