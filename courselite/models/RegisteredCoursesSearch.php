<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RegisteredCourses;

/**
 * RegisteredCoursesSearch represents the model behind the search form of `app\models\RegisteredCourses`.
 */
class RegisteredCoursesSearch extends RegisteredCourses
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'student_id'], 'integer'],
            [['courses', 'submitted', 'approved'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = RegisteredCourses::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'student_id' => $this->student_id,
        ]);

        $query->andFilterWhere(['like', 'courses', $this->courses])
            ->andFilterWhere(['like', 'submitted', $this->submitted])
            ->andFilterWhere(['like', 'approved', $this->approved]);

        return $dataProvider;
    }
}
