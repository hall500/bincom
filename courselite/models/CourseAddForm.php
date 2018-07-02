<?php

namespace app\models;

use yii\base\Model;

class CourseAddForm extends Model
{
    public $facultyId;
    public $courseId;
    public $deptId;

    public function rules()
    {
        return [
            [['facultyId','courseId', 'deptId'], 'required'],
            [['courseId', 'deptId'], 'in', 'range' => ['-'], 'not' => true],
        ];
    }

    public function attributeLabels()
    {
        return [
            'facultyId' => 'Faculty',
            'courseId' => 'Courses',
            'deptId' => 'Department',
        ];
    }

    
}