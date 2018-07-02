<?php
namespace app\models;

use yii\base\Model;
use app\models\User;

/**
 * Signup form
 */
class UpdateProfile extends Model
{
    public $firstname;
    public $lastname;
    public $gender;
    public $email;
    public $department_id;
    public $phone;
    public $matric_num;
    public $user_id;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'department_id'], 'integer'],
            [['gender'], 'string'],
            [['created', 'modified'], 'safe'],
            [['firstname', 'lastname', 'email'], 'string', 'max' => 100],
            ['email', 'email'],
            [['phone'], 'string', 'max' => 20],
            [['matric_num'], 'string', 'max' => 15],
            [['user_id'], 'exist', 'skipOnError' => false, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Departments::className(), 'targetAttribute' => ['department_id' => 'id']],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */

    public function update()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $student = new Students();
        $student->user_id = Yii::$app->user->id;
        $student->firstname = $this->firstname;
        $student->lastname = $this->lastname;
        $student->gender = $this->gender;
        $student->email = $this->email;
        $student->department_id = $this->department_id;
        $student->phone = $this->phone;
        
        return $student->save() ? $student : null;
    }
}
