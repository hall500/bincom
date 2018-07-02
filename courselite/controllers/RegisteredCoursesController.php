<?php

namespace app\controllers;

use Yii;
use app\models\RegisteredCourses;
use app\models\RegisteredCoursesSearch;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\components\UserRole;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RegisteredCoursesController implements the CRUD actions for RegisteredCourses model.
 */
class RegisteredCoursesController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['get'],
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all RegisteredCourses models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(UserRole::isAdmin()){
            $searchModel = new RegisteredCoursesSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
        return $this->goHome();
    }

    /**
     * Displays a single RegisteredCourses model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->onlyAdmin();
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new RegisteredCourses model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        return $this->goHome();
    }

    /**
     * Updates an existing RegisteredCourses model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $this->onlyAdmin();
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing RegisteredCourses model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->onlyAdmin();
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function onlyAdmin(){
        if(!UserRole::isAdmin()){
            return $this->goHome();
        }
    }


    /**
     * Finds the RegisteredCourses model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RegisteredCourses the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RegisteredCourses::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
