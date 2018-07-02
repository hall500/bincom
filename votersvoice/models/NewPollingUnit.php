<?php

namespace app\models;

use yii\base\Model;

class NewPollingUnit extends Model
{
    public $state_id;
    public $lga_id;
    public $ward_id;
    public $polling_unit_name;
    public $polling_unit_number;
    public $lat;
    public $long;
    public $partyid;
    public $party_score;

    public function rules()
    {
        return [
            [['state_id','lga_id', 'ward_id','polling_unit_name', 'polling_unit_number','lat','long','partyid','party_score'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'state_id' => 'State',
            'lga_id' => 'LGA',
            'ward_id' => 'Ward',
            'polling_unit_name' => 'Polling Unit',
            'polling_unit_number' => 'Unit Number',
            'lat' => 'Latitude',
            'long' => 'Longitude',
            'partyid' => 'Party',
            'party_score' => 'Score'
        ];
    }
}