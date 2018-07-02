<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "courses".
 *
 * @property int $id
 * @property string $course
 * @property int $credit
 * @property int $department_id
 * @property string $course_code
 *
 * @property Departments $department
 */
class Courses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'courses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['course', 'credit', 'department_id', 'course_code'], 'required'],
            [['credit', 'department_id'], 'integer'],
            [['course'], 'string', 'max' => 100],
            [['course_code'], 'string', 'max' => 6],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Departments::className(), 'targetAttribute' => ['department_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'course' => 'Course',
            'credit' => 'Credit',
            'department_id' => 'Department ID',
            'course_code' => 'Course Code',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Departments::className(), ['id' => 'department_id']);
    }

    public function getDept(){
        return Departments::find()->joinWith('department')->where(['departments.id' => $this->department_id])->one()->faculty->faculty;
    }
}
