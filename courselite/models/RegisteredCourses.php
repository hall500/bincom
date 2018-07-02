<?php

namespace app\models;

use Yii;
use app\models\Departments;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "registered_courses".
 *
 * @property int $id
 * @property int $student_id
 * @property string $courses
 * @property string $submitted 1=Submitted, 0=NotSubmited
 * @property string $approved 1=Approved, 0=NotApproved
 *
 * @property Students $student
 */
class RegisteredCourses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'registered_courses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['student_id'], 'required'],
            [['student_id'], 'integer'],
            [['courses', 'submitted', 'approved'], 'string'],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => Students::className(), 'targetAttribute' => ['student_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'student_id' => 'Student ID',
            'courses' => 'Courses',
            'submitted' => 'Submitted',
            'approved' => 'Approved',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Students::className(), ['id' => 'student_id']);
    }

    public function getStudentDetails(){
        $student = RegisteredCourses::find()->joinWith('student')->where(['students.id' => $this->student_id])->one();
        return $student;
        //return $student->student->firstname . " " . $student->student->lastname;
    }

    public function getStudentName(){
        return $this->getStudentDetails()->student->firstname . " " . $this->getStudentDetails()->student->lastname;
    }

    public function getStudentFacultyId(){
        return Departments::find()->where(['id' => $this->getStudentDetails()->student->department_id])->one()->faculty_id;
    }

    public function getStudentDepartment(){
        //return $this->getStudentDetails()->student->department_id;
        return Departments::find()->where(['id' => $this->getStudentDetails()->student->department_id])->one()->department;
    }

    public function getStudentFaculty(){
        //return $this->getStudentDetails()->student->department_id;
        return Faculties::find()->where(['id' => $this->getStudentFacultyId()])->one()->faculty;
    }

    public function getStudentsCourses(){
        $saved_courses =  json_decode($this->courses);
        foreach($saved_courses as $key => $course){
            $courses[$key] = $course;
        }
        $itemIds = ArrayHelper::getColumn($courses,'id');
        $allcourses = (new \yii\db\Query())->select(['courses.id','courses.course','departments.department','faculties.faculty','courses.credit'])->from('departments')->join('JOIN','courses','courses.department_id = departments.id')->join('JOIN','faculties','departments.faculty_id = faculties.id')->where(['courses.id'=>$itemIds])->createCommand()->queryAll();

        $text = "";
        /* foreach($allcourses as $key => $course){
            $text .= $course['course'] . ", " . $course['department'] . ", " .  $course['faculty'] . " <br> ";
        }
        return $text; */
        return $allcourses;

        //return (array) json_decode($this->courses);
    }
}
