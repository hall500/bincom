<?php

namespace app\components;

use Yii;
use yii\base\Component;

class CourseList extends Component
{
    public $sessionKey = 'courses';

    private $_courses = [];

    private $creditTotal = 0;

    public function add($id, $dept_id, $credit)
    {
        $this->loadItems();
        if (!array_key_exists($id, $this->_courses)) {
            $this->_courses[$id] = [
                'id' => $id,
                'dept_id' => $dept_id,
                'credit' => $credit,
            ];
            $this->creditTotal += $credit;

            $this->saveItems();
        }
    }

    public function remove($id)
    {
        $this->loadItems();
        $this->_courses = array_diff_key($this->_courses, [$id => []]);
        $this->saveItems();
    }

    public function clear()
    {
        $this->_courses = [];
        $this->saveItems();
    }

    public function setItems($id, $courses = [])
    {
        $this->_courses[$id] = $courses;
        $this->saveItems();
    }

    public function getItems()
    {
        $this->loadItems();
        return $this->_courses;
    }

    public function getCreditTotal(){
      return $this->creditTotal;
    }

    private function loadItems()
    {
        $this->_courses = Yii::$app->session->get($this->sessionKey, []);
    }

    private function saveItems()
    {
        Yii::$app->session->set($this->sessionKey, $this->_courses);
    }

    public function justLoggedIn(){
        if(Yii::$app->session->has('count')){
            $count = Yii::$app->session->get('count') + 1;
            Yii::$app->session->set('count', $count);
        }else{
            Yii::$app->session->set('count', 1);
        }
        return Yii::$app->session->get('count');
    }
}