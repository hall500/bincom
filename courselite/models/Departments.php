<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "departments".
 *
 * @property int $id
 * @property string $department
 * @property int $faculty_id
 * @property string $department_code
 *
 * @property Courses[] $courses
 * @property Faculties $faculty
 * @property Students[] $students
 */
class Departments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'departments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['department', 'faculty_id', 'department_code'], 'required'],
            [['faculty_id'], 'integer'],
            [['department'], 'string', 'max' => 100],
            [['department_code'], 'string', 'max' => 3],
            [['faculty_id'], 'exist', 'skipOnError' => true, 'targetClass' => Faculties::className(), 'targetAttribute' => ['faculty_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'department' => 'Department',
            'faculty_id' => 'Faculty ID',
            'department_code' => 'Department Code',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourses()
    {
        return $this->hasMany(Courses::className(), ['department_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaculty()
    {
        return $this->hasOne(Faculties::className(), ['id' => 'faculty_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudents()
    {
        return $this->hasMany(Students::className(), ['department_id' => 'id']);
    }

    public function getFacultyValue(){
        return Departments::find()->joinWith('faculty')->where(['faculties.id' => $this->faculty_id])->one()->faculty->faculty;
    }
}
