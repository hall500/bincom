<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "faculties".
 *
 * @property int $id
 * @property string $faculty
 * @property int $credits_allowed
 *
 * @property Departments[] $departments
 */
class Faculties extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'faculties';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['faculty', 'credits_allowed'], 'required'],
            [['credits_allowed'], 'integer'],
            [['faculty'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'faculty' => 'Faculty',
            'credits_allowed' => 'Credits Allowed',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartments()
    {
        return $this->hasMany(Departments::className(), ['faculty_id' => 'id']);
    }
}
