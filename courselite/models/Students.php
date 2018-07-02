<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "students".
 *
 * @property int $id
 * @property int $user_id
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string $gender male=Male, female=Female
 * @property string $phone
 * @property string $matric_num
 * @property int $department_id
 * @property string $created
 * @property string $modified
 *
 * @property RegisteredCourses[] $registeredCourses
 * @property User $user
 * @property Departments $department
 */
class Students extends \yii\db\ActiveRecord
{
    public $faculty;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'students';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'department_id'], 'integer'],
            [['gender'], 'string'],
            [['created', 'modified'], 'safe'],
            [['firstname', 'lastname', 'email'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 20],
            [['matric_num'], 'string', 'max' => 15],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'user_id' => 'User ID',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'email' => 'Email',
            'gender' => 'Gender',
            'phone' => 'Phone',
            'matric_num' => 'Matric Num',
            'department_id' => 'Department ID',
            'created' => 'Created',
            'modified' => 'Modified',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegisteredCourses()
    {
        return $this->hasMany(RegisteredCourses::className(), ['student_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Departments::className(), ['id' => 'department_id']);
        //return $this->find()->where(['id' => 'department_id'])->one();
        //return "";
    }

    public function getDisplayname(){
        return $this->firstname . " " . $this->lastname;
    }
}
