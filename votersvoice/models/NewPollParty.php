<?php

namespace app\models;

use yii\base\Model;

class NewPollParty extends Model
{
    public $partyid;
    public $party_score;
    public $result_id;

    public function rules()
    {
        return [
            [['partyid', 'party_score'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'partyid' => 'Party',
            'party_score' => 'Score',
        ];
    }
}