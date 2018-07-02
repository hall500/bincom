<?php

namespace app\controllers;

use app\components\CourseList;
use app\components\UserRole;
use app\models\CourseAddForm;
use Yii;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use app\models\Courses;
use app\models\Departments;
use app\models\RegisteredCourses;
use app\models\Students;

class CourseController extends Controller
{
    /**
     * @var CourseList
     */
    private $courses;

    public function __construct($id, $module, CourseList $courses, $config = [])
    {
        $this->courses = $courses;
        parent::__construct($id, $module, $config);
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','create','view','update','delete','logout'],
                'rules' => [
                    [
                        'actions' => ['index','create','view','update','delete','logout'],
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

    public function actionIndex() 
    {
        $saved_courses = RegisteredCourses::find()->where(['student_id' => UserRole::getUserId()])->one();

        if(!UserRole::isStudent()){
            return $this->goHome();
        }

        $saved_courses = RegisteredCourses::find()->where(['student_id' => UserRole::getUserId()])->one();
        if($saved_courses->submitted === '1'){
            return $this->redirect(['done']);
        }

        if($this->courses->justLoggedIn() == 1){
            if($saved_courses){
                $saved_courses =  json_decode($saved_courses->courses);
                $this->courses->clear();
                foreach($saved_courses as $key => $course){
                    $this->courses->setItems($key, (array) $course);
                }
            }else{
                $this->courses->clear();
            }
        }
    
        $model = new CourseAddForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $credit = Courses::findOne($model->courseId)->credit;

            if(($this->courses->getCreditTotal() + $credit) <= 50){
                $this->courses->add($model->courseId, $model->deptId, $credit);
            }else{
                return $this->redirect(['index']);
            }
        }

        return $this->render('index', [
            'model' => $model,
            'dataProvider' => $this->displayData(),
        ]);

        return $this->goHome();
    }

    public function actionSave(){
        if(!UserRole::isStudent()){
            return $this->goHome();
        }
        $model = RegisteredCourses::find()->where(['student_id' => UserRole::getUserId()])->one();

        if($model){
            $model->courses = json_encode($this->courses->getItems());
        }else{
            $model = new RegisteredCourses();
            $model->student_id = UserRole::getUserId();
            $model->courses = json_encode($this->courses->getItems());
        }

        if($model->save()){
            Yii::$app->session->setFlash('save',['1','Data Saved Successfully']);
        }else{
            Yii::$app->session->setFlash('save',['0','Unable to save data.']);
        }
        $model = '';
        return $this->redirect(['index']); 
    }

    public function actionSubmit(){
        if(!UserRole::isStudent()){
            return $this->goHome();
        }
        $model = RegisteredCourses::find()->where(['student_id' => UserRole::getUserId()])->one();
        if($model){
            $model->submitted = '1';
        }

        if($model->save()){
            return $this->render('done');
        }
        Yii::$app->session->setFlash('submit','An Error Occured while submitting. To Contact Admin!! Call 09035306621');
        return $this->redirect(['index']);
    }

    public function actionDone(){
        if(!UserRole::isStudent()){
            return $this->goHome();
        }

        if(RegisteredCourses::find()->where(['student_id' => UserRole::getUserId()])->one()->submitted === '0'){
            return $this->redirect(['index']);
        }
        return $this->render('done');
    }

    public function actionDelete($id)
    {
        if(!UserRole::isStudent()){
            return $this->goHome();
        }
        $this->courses->remove($id);

        return $this->redirect(['index']);
    }

    public function actionAllDepartments($id){
        if(!UserRole::isUser()){
            return $this->goHome();
        }
        $countDepartments = Departments::find()->where(['faculty_id' => $id])->count();
        $departments = Departments::find()->select(['id','department','department_code'])->where(['faculty_id' => $id])->all();

        if($countDepartments > 0){
            foreach($departments as $department){
                echo "<option value='{$department->id}'>{$department->department} {$department->department_code}</option>";
            }
        }else{
            echo "<option>-</option>";
        }
    }

    public function actionAllCourses($id){
        if(!UserRole::isUser()){
            return $this->goHome();
        }
        $countCourses = Courses::find()->where(['department_id' => $id])->count();
        $courses = Courses::find()->select(['id','course','course_code'])->where(['department_id' => $id])->all();

        if($countCourses > 0){
            foreach($courses as $course){
                echo "<option value='{$course->id}'>{$course->course} {$course->course_code}</option>";
            }
        }else{
            echo "<option>-</option>";
        }
    }

    private function displayData(){

        //Obtain courses from user session and get all course Ids
        $itemIds = ArrayHelper::getColumn($this->courses->getItems(),'id');

        //Retrieve data from database using provided Ids
        return (new \yii\db\Query())->select(['courses.id','courses.course','departments.department','faculties.faculty','courses.credit'])->from('departments')->join('JOIN','courses','courses.department_id = departments.id')->join('JOIN','faculties','departments.faculty_id = faculties.id')->where(['courses.id'=>$itemIds])->createCommand()->queryAll();
    }
}