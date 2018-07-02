<?php

namespace app\components;

use Yii;
use yii\base\Component;

class UserRole extends Component
{

    public function isAdmin(){
      return (!Yii::$app->user->isGuest && (Yii::$app->user->identity->role == 'admin')) ? true : false;
    }

    public function isStudent(){
      return (!Yii::$app->user->isGuest && (Yii::$app->user->identity->role == 'student')) ? true : false;
    }

    public function isUser(){
      return (!Yii::$app->user->isGuest) ? true : false;
    }

    public function getUserId(){
      return Yii::$app->user->id;
    }
}